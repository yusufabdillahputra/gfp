<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Donasi\Resource\DonasiModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class DonasiController extends AdminController
{
    public function __construct()
    {
        parent::__construct('donasi');
        $this->rsc_model['DonasiModel'] = new DonasiModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('donasi.index')
        ]);
    }

    public function dataTableDonasi()
    {
        return $this->rsc_model['DonasiModel']->dataTableQuery();
    }

    public function createDonasi(Request $request)
    {
        $status = $this->rsc_model['DonasiModel']->createData($request->all());
        $redirect = redirect(route('donasi.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function editDonasi(Request $request)
    {
        $status = $this->rsc_model['DonasiModel']->updateById($request->all());
        $redirect = redirect(route('donasi.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function deleteDonasi(Request $request)
    {
        $status = $this->rsc_model['DonasiModel']->forceDeleteById($request->post('id_donasi'));
        $redirect = redirect(route('donasi.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

}
