<?php

namespace App\Http\Models\Users\Detail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AdminModel extends Model
{
    protected $rsc_table = 'tbl_rsc_admin';
    protected $table = 'tbl_dtl_admin';
    protected $view = 'vw_users_admin';
    protected $primaryKey = 'id_admin';
    protected $foreignKey = 'id_users';
    protected $guards = [
        "id_admin",
        "id_users",
    ];
    protected $fillable = [
        "alamat_admin",
        "kecamatan_admin",
        "kota_admin",
        "provinsi_admin",
        "bank_admin",
        "rekening_admin",
        "nm_rek_admin",
        "updated_by",
        "updated_at"
    ];

    protected $dates = [
        "updated_at"
    ];

    const UPDATED_AT = 'updated_at';

    private $users_unathorized = 0;
    private $users_admin = 2;

    /**
     * Mengambil semua data yang ada
     * Method   : GET
     *
     * @return void
     */
    public function getAll()
    {
        try {
            $data = DB::table($this->view)->get();
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
            $data = DB::table($this->view)->where($this->foreignKey, $id)->first();
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
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => self::onlyTrashed()->get()
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
     * @return void
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
     * @return void
     */
    public function updateById($array_data)
    {
        try {
            self::where($this->primaryKey, $array_data[$this->primaryKey])
                ->update([
                    'alamat_admin' => $array_data['alamat_admin'],
                    'kecamatan_admin' => $array_data['kecamatan_admin'],
                    'kota_admin' => $array_data['kota_admin'],
                    'provinsi_admin' => $array_data['provinsi_admin'],
                    "bank_admin" => $array_data['bank_admin'],
                    "rekening_admin" => $array_data['rekening_admin'],
                    "nm_rek_admin" => $array_data['nm_rek_admin'],
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
     * todo : Untuk sementara ini belum menerapkan soft delete.
     *
     * @param [type] $id
     * @return void
     */
    public function forceDeleteById($id)
    {
        try {
            DB::table($this->rsc_table)->where($this->foreignKey, $id)->forceDelete();
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
     * Membataskan pengambilan data datatable dengan filter dimana akses user ialah admin
     *
     * @return void
     * @throws \Exception
     */
    public function dataTableQuery()
    {
        $query = DB::table($this->view)->select('id_users', 'nama_users', 'created_at_users', 'akses_users')->orderBy('created_at_users', 'desc');
        $data_table = Datatables::of($query)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                <a href="' . route('users.admin.edit') . '?id=' . encrypt($data->id_users) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_admin" data-d_nama_users="'.$data->nama_users.'" data-d_id_users="'.$data->id_users.'" data-toggle="modal" class="modal_delete_admin btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
            })->make(true);
        return $data_table;
    }
}
