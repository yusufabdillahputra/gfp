<?php

namespace App\Http\Controllers\Otentikasi;

use App\Http\Models\Users\Resource\UsersModel;
use App\Mail\DaftarEmail;
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

    public function createDonatur(Request $request)
    {
        $request->validate(
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
