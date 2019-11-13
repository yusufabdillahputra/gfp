<?php

namespace App\Http\Models\Users\Log;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LogModel extends Model
{

    protected $table = 'tbl_rsc_log';
    protected $view = 'vw_rsc_log';
    protected $primaryKey = 'id_log';

    public function createData($request_data)
    {
        try {
            DB::table($this->table)
                ->insert($request_data);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Log Berhasil Dibuat'
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

    public function dataTableQueryLogin()
    {
        $query = DB::table($this->view)
            ->where('tipe_log', 1)
            ->orderBy('id_log', 'desc');
        $data_table = Datatables::of($query)->make(true);
        return $data_table;
    }

    public function dataTableQueryLogout()
    {
        $query = DB::table($this->view)
            ->where('tipe_log', 2)
            ->orderBy('id_log', 'desc');
        $data_table = Datatables::of($query)->make(true);
        return $data_table;
    }

}
