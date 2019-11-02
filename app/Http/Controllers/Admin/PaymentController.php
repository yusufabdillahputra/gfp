<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Payment\Resource\PaymentModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class PaymentController extends AdminController
{
    public function __construct()
    {
        parent::__construct('payment');
        $this->rsc_model['PaymentModel'] = new PaymentModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('payment.index')
        ]);
    }

    public function editForm(Request $request)
    {
        return $this->pathView('edit', [
            'breadcrumbs' => Breadcrumbs::render('payment.edit.form'),
            'data' => $this->rsc_model['PaymentModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function dataTablePayment()
    {
        return $this->rsc_model['PaymentModel']->dataTableQuery();
    }

    public function createPayment(Request $request)
    {
        $status = $this->rsc_model['PaymentModel']->createData($request->all());
        $redirect = redirect(route('payment.edit.form').'?id='.encrypt($status['data']));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function uploadLogoBank(Request $request)
    {
        /**
         * Hapus Gambar sebelumnya
         */
        $this->rsc_model['PaymentModel']->logoBank($request->post('id_payment'), 'DELETE');
        /**
         * Lalu lakukan upload data
         */
        $upload_file = $request->file('logo_bank_payment');
        $path = $upload_file->store('payment/logo');
        $this->rsc_model['PaymentModel']::where('id_payment', $request->post('id_payment'))
            ->update([
                'logo_bank_payment' => $path
            ]);
        /**
         * function tidak memiliki return dikarenakan proses di trigger oleh Dropzone.JS
         * todo : lakukan redirect secara asyncronous menggunakan Dropzone.js
         */
        // return ?? with(['success' => 'Foto Berhasil dirubah']);
    }

    public function editPayment(Request $request)
    {
        $status = $this->rsc_model['PaymentModel']->updateById($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function deletePayment(Request $request)
    {
        /**
         * Hapus Gambar sebelumnya
         */
        $this->rsc_model['PaymentModel']->logoBank($request->post('id_payment'), 'DELETE');

        $status = $this->rsc_model['PaymentModel']->forceDeleteById($request->post('id_payment'));
        $redirect = redirect(route('payment.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

}
