<?php

namespace App\Http\Controllers\Otentikasi;

use App\Http\Models\Users\Resource\UsersModel;
use App\Mail\DaftarEmail;
use App\Mail\ForgotPasswordEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\OtentikasiController;
use App\Http\Models\Otentikasi\AuthModel;
use Illuminate\Support\Facades\Mail;

class AuthController extends OtentikasiController
{
    public function __construct(){
        parent::__construct('login');
        $this->model = new AuthModel();
        $this->Users_Model = new UsersModel();
    }

    public function index(){
        return $this->pathView('index');
    }

    public function signIn()
    {
        return $this->pathView('signin');
    }

    public function forgotPassword()
    {
        return $this->pathView('forgot');
    }

    public function createForgotPassword(Request $request)
    {
        $fetch = $this->Users_Model->getIdByEmail($request->post('email_users'))['data'];
        if (empty($fetch)) {
            return redirect()->back()->with(['error' => 'Email tidak terdaftar']);
        } else if (!empty($fetch)) {
            $data = new \stdClass();
            $data->link = route('otentikasi.forgot.form')."?id=".encrypt($fetch->id_users);
            Mail::to($request->get('email_users'))->send(new ForgotPasswordEmail($data));
            return redirect()->back()->with(['success' => 'Reset password sudah dikirim ke email anda']);
        }
    }

    public function formForgotPassword(Request $request)
    {
        return $this->pathView('reset_password', [
            'id_users' => decrypt($request->get('id'))
        ]);
    }

    public function editForgotPassword(Request $request)
    {
        $status = $this->Users_Model->editPassword($request->all());
        $redirect = redirect(route('login'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => 'Password berhasil dirubah']);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function createDonatur(Request $request)
    {
        $request->validate(
            [
                'username_users' => 'required|unique:tbl_rsc_users',
                'email_users' => 'required|email|unique:tbl_rsc_users',
                'password_users' => 'required'
            ],
            [
                'username_users.unique' => "Username sudah terpakai",
                'username_users.required' => "Username tidak boleh kosong",
                'email_users.email' => "Format email anda salah",
                'email_users.required' => "Email tidak boleh kosong",
                'email_users.unique' => "Email sudah terpakai",
                'password_users' => "Password tidak boleh kosong"
            ]
        );

        $status = $this->Users_Model->daftarDonatur($request->all());
        $redirect = redirect(route('login'));
        if ($status['code'] == 200) {
            $data = new \stdClass();
            $data->receiver = $request->get('nama_users');
            Mail::to($request->get('email_users'))->send(new DaftarEmail($data));

            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function verifyUser(Request $request){
        return $this->model->verifyUser($request->all());
    }

    public function logoutUser(){
        return $this->model->logoutUser();
    }

}
