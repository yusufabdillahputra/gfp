<?php

namespace App\Http\Controllers\Landing;

use App\Http\Models\Payment\Resource\PaymentModel;
use App\Http\Models\Users\Detail\AdminModel;
use App\Http\Models\Users\Detail\DonaturModel;
use App\Http\Models\Users\Detail\RootModel;
use App\Http\Models\Dompet\Resource\DompetModel;
use App\Http\Models\Transaksi\Detail\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Parent\LandingController;

class DompetController extends LandingController
{
    public function __construct()
    {
        parent::__construct('dompet');
        $this->rsc_model['DompetModel'] = new DompetModel();
        $this->rsc_model['PaymentModel'] = new PaymentModel();
        $this->dtl_model['DonaturModel'] = new DonaturModel();
        $this->dtl_model['AdminModel'] = new AdminModel();
        $this->dtl_model['RootModel'] = new RootModel();
        $this->dtl_model['TransaksiModel'] = new TransaksiModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index');
    }

    /**
     * Sub modul top up dompet
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topUpIndex(Request $request)
    {
        return $this->pathView('top_up.index', [
            'data_dompet' => $this->rsc_model['DompetModel']->getById($request->session()->get('id_users'), 'BY_FOREIGN')['data']
        ]);
    }

    public function ajaxGetNamaBank(Request $request)
    {
        return $this->pathView('top_up.ajax.bank', [
            'rsc_payment' => $this->rsc_model['PaymentModel']->getByJenis($request->post('jenis_payment'))['data']
        ]);
    }

    public function ajaxGetStepPayment(Request $request)
    {
        return $this->pathView('top_up.ajax.step', [
            'data' => $this->rsc_model['PaymentModel']->getById($request->post('id_payment'), 'BY_PRIMARY')['data'],
            'jumlah_transaksi' => number_format($request->post('saldo_transaksi')+random_int(1,999),0,'.',','),
            'id_payment' => $request->post('id_payment')
        ]);
    }

    public function topUpEdit(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->insertSetData($request->all());
        $redirect = redirect(route('dompet.transaksi.detail')."?id=".encrypt($status['data']));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }



    /**
     * Sub Modul Transaksi
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transaksiIndex(Request $request)
    {
        return $this->pathView('transaksi.index', [
            'data' => $this->dtl_model['TransaksiModel']->getByCreatedBy($request->session()->get('id_users'))['data']
        ]);
    }

    public function ajaxAppendTransaksi(Request $request)
    {
        return $this->pathView('transaksi.ajax.list', [
            'data' => $this->dtl_model['TransaksiModel']->getByCreatedBy($request->session()->get('id_users'), $request->post('offset'),$request->post('limit'))['data']
        ]);
    }

    public function transaksiDetail(Request $request)
    {
        return $this->pathView('transaksi.detail', [
            'data' => $this->dtl_model['TransaksiModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    /**
     * Tidak dipakai (Request dari client | Frontend jangan pakai DT)
     *
     * @param Request $request
     * @return mixed
     */
    public function dataTableTransaksi(Request $request)
    {
        return $this->dtl_model['TransaksiModel']->dataTableQueryTransaksiLandingById($request->session()->get('id_users'));
    }

    /**
     * Sub modul Penarikan dana
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function penarikanIndex(Request $request)
    {
        $akses_users = $request->session()->get('akses_users');
        if ($akses_users == env('AKSES_ROOT')) {
            $fetch = $this->dtl_model['RootModel']->getById($request->session()->get('id_users'))['data'];
            $data = [
                'bank' => $fetch->bank_root,
                'rekening' => $fetch->rekening_root,
                'nm_rek' => $fetch->nm_rek_root
            ];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $fetch = $this->dtl_model['AdminModel']->getById($request->session()->get('id_users'))['data'];
            $data = [
                'bank' => $fetch->bank_admin,
                'rekening' => $fetch->rekening_admin,
                'nm_rek' => $fetch->nm_rek_admin
            ];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $fetch = $this->dtl_model['DonaturModel']->getById($request->session()->get('id_users'))['data'];
            $data = [
                'bank' => $fetch->bank_donatur,
                'rekening' => $fetch->rekening_donatur,
                'nm_rek' => $fetch->nm_rek_donatur
            ];
        } else {
            $data = null;
        }
        return $this->pathView('penarikan.index', [
            'data_dompet' => $this->rsc_model['DompetModel']->getById($request->session()->get('id_users'), 'BY_FOREIGN')['data'],
            'data_users' => $data
        ]);
    }

    public function createPenarikan(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->createPenarikan($request->all());
        $redirect = redirect(route('dompet.transaksi.detail')."?id=".encrypt($status['data']));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

}
