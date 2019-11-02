<?php

namespace App\Http\Controllers\Landing;

use App\Http\Models\Users\Detail\AdminModel;
use App\Http\Models\Users\Detail\DonaturModel;
use App\Http\Models\Users\Detail\RootModel;
use App\Http\Models\Users\Resource\UsersModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\LandingController;

class ProfileController extends LandingController
{
    public function __construct()
    {
        parent::__construct('profile');
        $this->rsc_model = new UsersModel();
        $this->dtl_model['DonaturModel'] = new DonaturModel();
        $this->dtl_model['AdminModel'] = new AdminModel();
        $this->dtl_model['RootModel'] = new RootModel();
    }

    public function index(Request $request)
    {
        $akses_users = $request->session()->get('akses_users');
        if ($akses_users == env('AKSES_ROOT')) {
            $model_name = 'root';
            $data = $this->dtl_model['RootModel']->getById($request->session()->get('id_users'))['data'];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $model_name = 'admin';
            $data = $this->dtl_model['AdminModel']->getById($request->session()->get('id_users'))['data'];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $model_name = 'donatur';
            $data = $this->dtl_model['DonaturModel']->getById($request->session()->get('id_users'))['data'];
        } else {
            $data = null;
        }
        return $this->pathView($model_name, [
            'data' => $data
        ]);
    }

    public function editUsersProfile(Request $request)
    {
        $status_rsc = $this->rsc_model->updateById($request->all()['rsc']);
        $akses_users = $request->session()->get('akses_users');
        if ($akses_users == env('AKSES_ROOT')) {
            $status_dtl = $this->dtl_model['RootModel']->updateById($request->all()['dtl']);
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $status_dtl = $this->dtl_model['AdminModel']->updateById($request->all()['dtl']);
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $status_dtl = $this->dtl_model['DonaturModel']->updateById($request->all()['dtl']);
        } else {
            $status_dtl = null;
        }

        if ($status_dtl['code'] == 200 AND $status_rsc['code'] == 200) {
            return redirect()->back()->with(['success' => $status_dtl['message']]);
        }
        if ($status_dtl['code'] == 500 OR $status_rsc['code'] == 500) {
            return redirect()->back()->with(['error' => $status_dtl['message']]);
        }
    }

    public function uploadUsersProfile(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('id_users'), 'DELETE');
        /**
         * Lalu lakukan upload data
         */
        $upload_file = $request->file('foto_users');

        $akses_users = $request->session()->get('akses_users');
        if ($akses_users == env('AKSES_ROOT')) {
            $path = $upload_file->store('users/root');
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $path = $upload_file->store('users/admin');
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $path = $upload_file->store('users/donatur');
        } else {
            $path = null;
        }
        $this->rsc_model::where('id_users', $request->post('id_users'))
            ->update([
                'foto_users' => $path
            ]);
        /**
         * function tidak memiliki return dikarenakan proses di trigger oleh Dropzone.JS
         * todo : lakukan redirect secara asyncronous menggunakan Dropzone.js
         */
        // return ?? with(['success' => 'Foto Berhasil dirubah']);
    }


}
