<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Dashboard\DashboardModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class DashboardController extends AdminController
{
    public $model;

    public function __construct(){
        parent::__construct('dashboard');
        $this->model = new DashboardModel();
    }

    public function index(Request $request){
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('dashboard.index'),
            'top_donatur' => $this->model->getUserTopDonasi()['data'],
            'total_donasi' => $this->model->getTotalDonasi()['data'],
            'transaksi_donasi_now' => $this->model->getTransaksiDonasiHariIni()['data'],
            'transaksi_topup_now' => $this->model->getTransaksiTopupHariIni()['data'],
            'transaksi_tarik_now' => $this->model->getTransaksiTarikHariIni()['data'],
            'transaksi_today' => $this->model->getTransaksiToday()['data']
        ]);
    }
}
