<?php

namespace App\Http\Models\Donasi\Resource;

use App\Http\Models\Users\Resource\UsersModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Yajra\DataTables\DataTables;

class DonasiModel extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_rsc_donasi';
    protected $primaryKey = 'id_donasi';
    protected $guards = [
        "id_donasi",
        "created_at"
    ];
    protected $fillable = [
        "nama_donasi",
        "created_by",
        "updated_by",
        "updated_at",
        "deleted_by",
        "deleted_at"
    ];
    protected $dates = [
        "deleted_at"
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    /**
     * Mengambil semua data yang ada
     * Method   : GET
     *
     * @return void
     */
    public function getAll()
    {
        try {
            $data = self::orderBy('created_at', 'desc')->get();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $data
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

    /**
     * Mengambil data berdasarkan primary key
     * Method   : GET
     *
     * @param [type] $id
     * @return void
     */
    public function getById($id)
    {
        try {
            $data = self::where($this->primaryKey, $id)->first();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $data
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

    /**
     * Mengambil data di tong sampah
     * Method   : GET
     *
     * @return void
     */
    public function getTrashed()
    {
        try {
            $data = self::onlyTrashed()->orderBy('created_at', 'desc')->get();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $data
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

    /**
     * Membuat sebuah data
     * Method   : POST
     *
     * @param [type] $array_data
     * @return array
     */
    public function createData($request_data)
    {
        try {
            self::create($request_data);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibuat'
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

    /**
     * Mengubah data berdasarkan primary key
     * Method   : PUT
     *
     * @param [type] $array_data
     * @return array
     */
    public function updateById($array_data)
    {
        try {
            self::where($this->primaryKey, $array_data[$this->primaryKey])
                ->update([
                    'nama_donasi' => $array_data['nama_donasi'],
                    'updated_by' => $array_data['updated_by'],
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Diubah',
                'data' => $array_data
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

    /**
     * Mengembalikan data yang berada di tong sampah
     *
     * @param [type] $id
     * @return void
     */
    public function restoreData($id)
    {
        try {
            self::where($this->primaryKey, $id)->restore();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dikembalikan',
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

    /**
     * Meletakkan data ke tong sampah berdasarkan primary key
     * Method   : DELETE
     *
     * @param [type] $id
     * @return void
     */
    public function deleteById($id)
    {
        try {
            self::where($this->primaryKey, $id)->delete();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil di Buang Ke Tong Sampah',
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

    /**
     * Menghapus data berdasarkan primary key
     * Method   : DELETE
     *
     * @param [type] $id
     * @return void
     */
    public function forceDeleteById($id)
    {
        try {
            self::where($this->primaryKey, $id)->forceDelete();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil di Hapus',
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

    /**
     * Membataskan pengambilan data datatable dengan filter dimana akses user ialah donatur
     *
     * @return void
     * @throws \Exception
     */
    public function dataTableQuery()
    {
        $UsersModel = new UsersModel();
        $sesi_id_users = session()->get('id_users');
        $fetch_rules = json_decode($UsersModel->getUsersRulesById($sesi_id_users)['data']);

        $query = self::select('id_donasi', 'nama_donasi', 'created_at')->orderBy('created_at', 'desc');

        if ($fetch_rules->donasi->delete == 1 AND $fetch_rules->donasi->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="#modal_edit_donasi" data-e_nama_donasi="'.$data->nama_donasi.'" data-e_id_donasi="'.$data->id_donasi.'" data-toggle="modal" class="modal_edit_donasi btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_donasi" data-d_nama_donasi="'.$data->nama_donasi.'" data-d_id_donasi="'.$data->id_donasi.'" data-toggle="modal" class="modal_delete_donasi btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->donasi->delete == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="#modal_delete_donasi" data-d_nama_donasi="'.$data->nama_donasi.'" data-d_id_donasi="'.$data->id_donasi.'" data-toggle="modal" class="modal_delete_donasi btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->donasi->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="#modal_edit_donasi" data-e_nama_donasi="'.$data->nama_donasi.'" data-e_id_donasi="'.$data->id_donasi.'" data-toggle="modal" class="modal_edit_donasi btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                </div>
                ';
                })->make(true);
        } else {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"></div>';
                })->make(true);
        }

        return $data_table;
    }


}
