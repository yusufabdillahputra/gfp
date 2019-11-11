<?php

namespace App\Http\Models\Dashboard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{

    public $RSC;
    public $DTL;
    public $SRC;
    public $VW;

    public function __construct()
    {
        $this->RSC = [

        ];
        $this->DTL = [

        ];
        $this->SRC = [

        ];
        $this->VW = [

        ];
    }

    public function getUserTopDonasi() {
        $prop = [
            'table' => 'dsh_users_top_donasi'
        ];
        try {
            $fetch = DB::table($prop['table'])->get();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch
            ];
        } catch (QueryException $error) {
            $status = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'message' => $error
            ];
        }
        return $status;
    }

    public function getTotalDonasi() {
        $prop = [
            'table' => 'dsh_total_donasi'
        ];
        try {
            $fetch = DB::table($prop['table'])->first();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch
            ];
        } catch (QueryException $error) {
            $status = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'message' => $error
            ];
        }
        return $status;
    }

    public function getTransaksiDonasiHariIni() {
        $prop = [
            'table' => 'vw_dtl_transaksi'
        ];
        try {
            $fetch = DB::table($prop['table'])
                ->where('jenis_transaksi', 2)
                ->where('status_transaksi', 1)
                ->where('created_at', Carbon::now())
                ->sum('saldo_transaksi');
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch
            ];
        } catch (QueryException $error) {
            $status = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'message' => $error
            ];
        }
        return $status;
    }

    public function getTransaksiTopupHariIni()
    {
        $prop = [
            'table' => 'vw_dtl_transaksi'
        ];
        try {
            $fetch = DB::table($prop['table'])
                ->where('jenis_transaksi', 1)
                ->where('status_transaksi', 1)
                ->where('created_at', Carbon::now())
                ->sum('saldo_transaksi');
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch
            ];
        } catch (QueryException $error) {
            $status = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'message' => $error
            ];
        }
        return $status;
    }

    public function getTransaksiTarikHariIni()
    {
        $prop = [
            'table' => 'vw_dtl_transaksi'
        ];
        try {
            $fetch = DB::table($prop['table'])
                ->where('jenis_transaksi', 3)
                ->where('status_transaksi', 1)
                ->where('created_at', Carbon::now())
                ->sum('saldo_transaksi');
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch
            ];
        } catch (QueryException $error) {
            $status = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'message' => $error
            ];
        }
        return $status;
    }

}
