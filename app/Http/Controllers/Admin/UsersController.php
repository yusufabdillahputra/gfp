<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;
use App\Http\Models\Users\Resource\UsersModel;
use App\Http\Models\Users\Detail\DonaturModel;
use App\Http\Models\Users\Detail\AdminModel;
use App\Http\Models\Users\Detail\RootModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class UsersController extends AdminController
{
    public function __construct()
    {
        parent::__construct('users');
        $this->rsc_model = new UsersModel();
        $this->dtl_model['DonaturModel'] = new DonaturModel();
        $this->dtl_model['AdminModel'] = new AdminModel();
        $this->dtl_model['RootModel'] = new RootModel();
    }

    /**
     * Sub modul dashboard
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('users.index')
        ]);
    }

    //===============##################=============

    /**
     * Sub modul profile
     *
     * @param Request $request
     * @return void
     */
    public function profileIndex(Request $request)
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
        return $this->pathView('profile.' . $model_name, [
            'breadcrumbs' => Breadcrumbs::render('users.profile.index'),
            'data' => $data
        ]);
    }

    public function editUsersProfile(Request $request)
    {
        /**
         * Ambil data sesuai akses user
         */
        $akses_users = $request->session()->get('akses_users');
        if ($akses_users == env('AKSES_ROOT')) {
            $users = $this->dtl_model['RootModel']->getById($request->session()->get('id_users'))['data'];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $users = $this->dtl_model['AdminModel']->getById($request->session()->get('id_users'))['data'];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $users = $this->dtl_model['DonaturModel']->getById($request->session()->get('id_users'))['data'];
        } else {
            redirect(route('otentikasi.logout'));
        }

        $username = $users->username_users;
        $email = $users->email_users;
        if (($username !== $request->get('rsc')['username_users']) OR ($email !== $request->get('rsc')['email_users'])) {
            /**
             * Validasi apakah ada perubahan terhadap username dan email
             */
            $validator = Validator::make($request->all()['rsc'],
                [
                    'username_users' => 'required|unique:tbl_rsc_users',
                    'email_users' => 'required|email|unique:tbl_rsc_users'
                ],
                [
                    'username_users.unique' => "Username sudah terpakai atau sama dengan username sebelumnya",
                    'username_users.required' => "Username tidak boleh kosong",
                    'email_users.email' => "Format email anda salah",
                    'email_users.required' => "Email tidak boleh kosong",
                    'email_users.unique' => "Email sudah terpakai atau sama dengan email sebelumnya"
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        /**
         * ######### Akhir Validasi
         */

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

        $redirect = redirect(route('users.profile.index'));
        if ($status_dtl['code'] == 200 AND $status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_dtl['message']]);
        }
        if ($status_dtl['code'] == 500 OR $status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_dtl['message']]);
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

    //===============##################=============

    /**
     * Sub modul root (Super Admin)
     * Hanya untuk Back Door
     *
     * @param Request $request
     * @return void
     */
    public function rootIndex(Request $request)
    {
        return $this->pathView('root.index', [
            'breadcrumbs' => Breadcrumbs::render('users.root.index')
        ]);
    }

    public function dataTableQueryRoot()
    {
        return $this->dtl_model['RootModel']->dataTableQuery();
    }

    public function rootViewEdit(Request $request)
    {
        return $this->pathView('root.edit', [
            'breadcrumbs' => Breadcrumbs::render('users.root.edit'),
            'data' => $this->dtl_model['RootModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function createUsersRoot(Request $request)
    {
        $validator = Validator::make($request->all()['rsc'],
            [
                'username_users' => 'required|unique:tbl_rsc_users',
                'email_users' => 'required|email|unique:tbl_rsc_users'
            ],
            [
                'username_users.unique' => "Username sudah terpakai",
                'username_users.required' => "Username tidak boleh kosong",
                'email_users.email' => "Format email anda salah",
                'email_users.required' => "Email tidak boleh kosong",
                'email_users.unique' => "Email sudah terpakai"
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }

        $status_rsc = $this->rsc_model->createData($request->all()['rsc']);
        $redirect = redirect(route('users.root.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    public function editUsersRoot(Request $request)
    {
        /**
         * Ambil data sesuai akses user
         */
        $akses_users = $request->get('rsc')['akses_users'];
        if ($akses_users == env('AKSES_ROOT')) {
            $users = $this->dtl_model['RootModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $users = $this->dtl_model['AdminModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $users = $this->dtl_model['DonaturModel']->getById($request->get('rsc')['id_users'])['data'];
        } else {
            redirect(route('otentikasi.logout'));
        }

        $username = $users->username_users;
        $email = $users->email_users;
        if (($username !== $request->get('rsc')['username_users']) OR ($email !== $request->get('rsc')['email_users'])) {
            /**
             * Validasi apakah ada perubahan terhadap username dan email
             */
            $validator = Validator::make($request->all()['rsc'],
                [
                    'username_users' => 'required|unique:tbl_rsc_users',
                    'email_users' => 'required|email|unique:tbl_rsc_users'
                ],
                [
                    'username_users.unique' => "Username sudah terpakai atau sama dengan username sebelumnya",
                    'username_users.required' => "Username tidak boleh kosong",
                    'email_users.email' => "Format email anda salah",
                    'email_users.required' => "Email tidak boleh kosong",
                    'email_users.unique' => "Email sudah terpakai atau sama dengan email sebelumnya"
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        /**
         * ######### Akhir Validasi
         */


        $status_rsc = $this->rsc_model->updateById($request->all()['rsc']);
        $status_dtl = $this->dtl_model['RootModel']->updateById($request->all()['dtl']);
        $redirect = redirect(route('users.root.edit') . '?id=' . encrypt($request->all()['rsc']));
        if ($status_dtl['code'] == 200 AND $status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_dtl['message']]);
        }
        if ($status_dtl['code'] == 500 OR $status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_dtl['message']]);
        }
    }

    public function uploadUsersRoot(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('id_users'), 'DELETE');
        /**
         * Lalu lakukan upload data
         */
        $upload_file = $request->file('foto_users');
        $path = $upload_file->store('users/root');
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

    public function deleteUsersRoot(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('rsc')['id_users'], 'DELETE');
        /**
         * Proses
         */
        $status_rsc = $this->rsc_model->forceDeleteById($request->all()['rsc']);
        $redirect = redirect(route('users.root.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    //===============##################=============

    /**
     * Sub modul admin
     *
     * @param Request $request
     * @return void
     */
    public function adminIndex(Request $request)
    {
        return $this->pathView('admin.index', [
            'breadcrumbs' => Breadcrumbs::render('users.admin.index')
        ]);
    }

    public function dataTableQueryAdmin()
    {
        return $this->dtl_model['AdminModel']->dataTableQuery();
    }

    public function adminViewEdit(Request $request)
    {
        return $this->pathView('admin.edit', [
            'breadcrumbs' => Breadcrumbs::render('users.admin.edit'),
            'data' => $this->dtl_model['AdminModel']->getById(decrypt($request->get('id')))['data'],
            'rules' => json_decode($this->rsc_model->getUsersRulesById(decrypt($request->get('id')))['data'])
        ]);
    }

    public function createUsersAdmin(Request $request)
    {
        $validator = Validator::make($request->all()['rsc'],
            [
                'username_users' => 'required|unique:tbl_rsc_users',
                'email_users' => 'required|email|unique:tbl_rsc_users'
            ],
            [
                'username_users.unique' => "Username sudah terpakai",
                'username_users.required' => "Username tidak boleh kosong",
                'email_users.email' => "Format email anda salah",
                'email_users.required' => "Email tidak boleh kosong",
                'email_users.unique' => "Email sudah terpakai"
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }

        $status_rsc = $this->rsc_model->createData($request->all()['rsc']);
        $redirect = redirect(route('users.admin.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    public function editUsersAdmin(Request $request)
    {
        /**
         * Ambil data sesuai akses user
         */
        $akses_users = $request->get('rsc')['akses_users'];
        if ($akses_users == env('AKSES_ROOT')) {
            $users = $this->dtl_model['RootModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $users = $this->dtl_model['AdminModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $users = $this->dtl_model['DonaturModel']->getById($request->get('rsc')['id_users'])['data'];
        } else {
            redirect(route('otentikasi.logout'));
        }

        $username = $users->username_users;
        $email = $users->email_users;
        if (($username !== $request->get('rsc')['username_users']) OR ($email !== $request->get('rsc')['email_users'])) {
            /**
             * Validasi apakah ada perubahan terhadap username dan email
             */
            $validator = Validator::make($request->all()['rsc'],
                [
                    'username_users' => 'required|unique:tbl_rsc_users',
                    'email_users' => 'required|email|unique:tbl_rsc_users'
                ],
                [
                    'username_users.unique' => "Username sudah terpakai atau sama dengan username sebelumnya",
                    'username_users.required' => "Username tidak boleh kosong",
                    'email_users.email' => "Format email anda salah",
                    'email_users.required' => "Email tidak boleh kosong",
                    'email_users.unique' => "Email sudah terpakai atau sama dengan email sebelumnya"
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        /**
         * ######### Akhir Validasi
         */

        $status_rsc = $this->rsc_model->updateById($request->all()['rsc']);
        $status_dtl = $this->dtl_model['AdminModel']->updateById($request->all()['dtl']);
        $redirect = redirect(route('users.admin.edit') . '?id=' . encrypt($request->all()['rsc']));
        if ($status_dtl['code'] == 200 AND $status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_dtl['message']]);
        }
        if ($status_dtl['code'] == 500 OR $status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_dtl['message']]);
        }
    }

    public function uploadUsersAdmin(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('id_users'), 'DELETE');
        /**
         * Lalu lakukan upload data
         */
        $upload_file = $request->file('foto_users');
        $path = $upload_file->store('users/admin');
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

    public function deleteUsersAdmin(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('rsc')['id_users'], 'DELETE');
        /**
         * Proses
         */
        $status_rsc = $this->rsc_model->forceDeleteById($request->all()['rsc']);
        $redirect = redirect(route('users.admin.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    //===============##################=============

    /**
     * Sub modul donatur
     *
     * @param Request $request
     * @return void
     */
    public function donaturIndex(Request $request)
    {
        return $this->pathView('donatur.index', [
            'breadcrumbs' => Breadcrumbs::render('users.donatur.index')
        ]);
    }

    public function dataTableQueryDonatur()
    {
        return $this->dtl_model['DonaturModel']->dataTableQuery();
    }

    public function donaturViewEdit(Request $request)
    {
        return $this->pathView('donatur.edit', [
            'breadcrumbs' => Breadcrumbs::render('users.donatur.edit'),
            'data' => $this->dtl_model['DonaturModel']->getById(decrypt($request->get('id')))['data'],
            'rules' => json_decode($this->rsc_model->getUsersRulesById(decrypt($request->get('id')))['data'])
        ]);
    }

    public function createUsersDonatur(Request $request)
    {
        $validator = Validator::make($request->all()['rsc'],
            [
                'username_users' => 'required|unique:tbl_rsc_users',
                'email_users' => 'required|email|unique:tbl_rsc_users'
            ],
            [
                'username_users.unique' => "Username sudah terpakai",
                'username_users.required' => "Username tidak boleh kosong",
                'email_users.email' => "Format email anda salah",
                'email_users.required' => "Email tidak boleh kosong",
                'email_users.unique' => "Email sudah terpakai"
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }

        $status_rsc = $this->rsc_model->createData($request->all()['rsc']);
        $redirect = redirect(route('users.donatur.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    public function editUsersDonatur(Request $request)
    {
        /**
         * Ambil data sesuai akses user
         */
        $akses_users = $request->get('rsc')['akses_users'];
        if ($akses_users == env('AKSES_ROOT')) {
            $users = $this->dtl_model['RootModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_ADMIN')) {
            $users = $this->dtl_model['AdminModel']->getById($request->get('rsc')['id_users'])['data'];
        } elseif ($akses_users == env('AKSES_DONATUR')) {
            $users = $this->dtl_model['DonaturModel']->getById($request->get('rsc')['id_users'])['data'];
        } else {
            redirect(route('otentikasi.logout'));
        }

        $username = $users->username_users;
        $email = $users->email_users;
        if (($username !== $request->get('rsc')['username_users']) OR ($email !== $request->get('rsc')['email_users'])) {
            /**
             * Validasi apakah ada perubahan terhadap username dan email
             */
            $validator = Validator::make($request->all()['rsc'],
                [
                    'username_users' => 'required|unique:tbl_rsc_users',
                    'email_users' => 'required|email|unique:tbl_rsc_users'
                ],
                [
                    'username_users.unique' => "Username sudah terpakai atau sama dengan username sebelumnya",
                    'username_users.required' => "Username tidak boleh kosong",
                    'email_users.email' => "Format email anda salah",
                    'email_users.required' => "Email tidak boleh kosong",
                    'email_users.unique' => "Email sudah terpakai atau sama dengan email sebelumnya"
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        /**
         * ######### Akhir Validasi
         */

        $status_rsc = $this->rsc_model->updateById($request->all()['rsc']);
        $status_dtl = $this->dtl_model['DonaturModel']->updateById($request->all()['dtl']);
        $redirect = redirect(route('users.donatur.edit') . '?id=' . encrypt($request->all()['rsc']));
        if ($status_dtl['code'] == 200 AND $status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_dtl['message']]);
        }
        if ($status_dtl['code'] == 500 OR $status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_dtl['message']]);
        }
    }

    public function uploadUsersDonatur(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('id_users'), 'DELETE');
        /**
         * Proses upload
         */
        $upload_file = $request->file('foto_users');
        $path = $upload_file->store('users/donatur');
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

    public function deleteUsersDonatur(Request $request)
    {
        /**
         * Hapus foto sebelumnya
         */
        $this->rsc_model->fotoUsers($request->post('rsc')['id_users'], 'DELETE');
        /**
         * Proses
         */
        $status_rsc = $this->rsc_model->forceDeleteById($request->all()['rsc']);
        $redirect = redirect(route('users.donatur.index'));
        if ($status_rsc['code'] == 200) {
            return $redirect->with(['success' => $status_rsc['message']]);
        }
        if ($status_rsc['code'] == 500) {
            return $redirect->with(['error' => $status_rsc['message']]);
        }
    }

    //===============##################=============

    public function editPassword(Request $request)
    {
        $status = $this->rsc_model->editPassword($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->withSuccess($status['message']);
        } elseif ($status['code'] == 500) {
            return redirect()->back()->withError($status['message']);
        }
    }

    public function ruleUpdate(Request $request)
    {
        $status = $this->rsc_model->ruleUpdate($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->withSuccess($status['message']);
        } elseif ($status['code'] == 500) {
            return redirect()->back()->withError($status['message']);
        }
    }

}
