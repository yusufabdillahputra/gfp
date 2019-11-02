<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Donasi\Selain_Uang\DonasiFeedModel;
use App\Http\Models\Payment\Resource\PaymentModel;
use App\Http\Models\Users\Detail\AdminModel;
use App\Http\Models\Users\Detail\DonaturModel;
use App\Http\Models\Users\Detail\RootModel;
use App\Http\Models\Dompet\Resource\DompetModel;
use App\Http\Models\Transaksi\Detail\TransaksiModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class TransaksiController extends AdminController
{

    public function __construct()
    {
        parent::__construct('transaksi');
        $this->rsc_model['DompetModel'] = new DompetModel();
        $this->rsc_model['PaymentModel'] = new PaymentModel();
        $this->dtl_model['TransaksiModel'] = new TransaksiModel();
        $this->dtl_model['RootModel'] = new RootModel();
        $this->dtl_model['AdminModel'] = new AdminModel();
        $this->dtl_model['DonaturModel'] = new DonaturModel();

        $this->feed_model['DonasiFeedModel'] = new DonasiFeedModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.index')
        ]);
    }

    /**
     * Sub modul transaksi top up dompet
     */
    public function topupIndex(Request $request)
    {
        return $this->pathView('top_up.index', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.topup.index')
        ]);
    }

    public function topupDetail(Request $request)
    {
        return $this->pathView('top_up.detail', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.topup.detail'),
            'data' => $this->dtl_model['TransaksiModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function dataTableTopup()
    {
        return $this->dtl_model['TransaksiModel']->dataTableTopup();
    }

    public function updateTopup(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->updateTopup($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    /**
     * Sub modul transaksi penarikan dana dompet
     */
    public function tarikIndex(Request $request)
    {
        return $this->pathView('tarik.index', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.tarik.index')
        ]);
    }

    public function tarikDetail(Request $request)
    {
        $fetch_transaksi = $this->dtl_model['TransaksiModel']->getById(decrypt($request->get('id')))['data'];
        $akses_users = $fetch_transaksi->akses_users;
        if ($akses_users == env('AKSES_ROOT')) {
            $fetch = $this->dtl_model['RootModel']->getById($fetch_transaksi->created_by)['data'];
            $data = [
                'bank' => $fetch->bank_root,
                'rekening' => $fetch->rekening_root,
                'nm_rek' => $fetch->nm_rek_root
            ];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $fetch = $this->dtl_model['AdminModel']->getById($fetch_transaksi->created_by)['data'];
            $data = [
                'bank' => $fetch->bank_admin,
                'rekening' => $fetch->rekening_admin,
                'nm_rek' => $fetch->nm_rek_admin
            ];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $fetch = $this->dtl_model['DonaturModel']->getById($fetch_transaksi->created_by)['data'];
            $data = [
                'bank' => $fetch->bank_donatur,
                'rekening' => $fetch->rekening_donatur,
                'nm_rek' => $fetch->nm_rek_donatur
            ];
        } else {
            $data = null;
        }

        return $this->pathView('tarik.detail', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.tarik.detail'),
            'data' => $fetch_transaksi,
            'data_users' => $data
        ]);
    }

    public function dataTableTarik(Request $request)
    {
        return $this->dtl_model['TransaksiModel']->dataTableTarik();
    }

    public function updateTarik(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->updateTarik($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    /**
     * Sub modul transaksi donasi
     */
    public function donasiIndex(Request $request)
    {
        return $this->pathView('donasi.index', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.donasi.index')
        ]);
    }

    public function dataTableDonasi(Request $request)
    {
        return $this->dtl_model['TransaksiModel']->dataTableDonasi();
    }

    public function updateDonasi(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->updateDonasi($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    /**
     * Sub modul transaksi donasi
     */
    public function kebutuhanIndex(Request $request)
    {
        return $this->pathView('kebutuhan.index', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.kebutuhan.index')
        ]);
    }

    public function kebutuhanDetail(Request $request)
    {
        return $this->pathView('kebutuhan.detail', [
            'breadcrumbs' => Breadcrumbs::render('transaksi.kebutuhan.detail'),
            'data' => $this->feed_model['DonasiFeedModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function dataTableKebutuhan(Request $request)
    {
        return $this->feed_model['DonasiFeedModel']->dataTableKebutuhan();
    }

    public function updateKebutuhan(Request $request)
    {
        $status = $this->feed_model['DonasiFeedModel']->updateById($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

}
