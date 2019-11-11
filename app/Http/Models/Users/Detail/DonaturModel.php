<?php

namespace App\Http\Models\Users\Detail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DonaturModel extends Model
{
    protected $rsc_table = 'tbl_rsc_donatur';
    protected $table = 'tbl_dtl_donatur';
    protected $view = 'vw_users_donatur';
    protected $primaryKey = 'id_donatur';
    protected $foreignKey = 'id_users';
    protected $guards = [
        "id_donatur",
        "id_users",
    ];
    protected $fillable = [
        "alamat_donatur",
        "kecamatan_donatur",
        "kota_donatur",
        "provinsi_donatur",
        "bank_donatur",
        "rekening_donatur",
        "nm_rek_donatur",
        "updated_by",
        "updated_at"
    ];
    protected $dates = [
        "updated_at"
    ];

    const UPDATED_AT = 'updated_at';

    private $users_unathorized = 0;
    private $users_donatur = 3;

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
                    'alamat_donatur' => $array_data['alamat_donatur'],
                    'kecamatan_donatur' => $array_data['kecamatan_donatur'],
                    'kota_donatur' => $array_data['kota_donatur'],
                    'provinsi_donatur' => $array_data['provinsi_donatur'],
                    "bank_donatur" => $array_data['bank_donatur'],
                    "rekening_donatur" => $array_data['rekening_donatur'],
                    "nm_rek_donatur" => $array_data['nm_rek_donatur'],
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
     * Membataskan pengambilan data datatable dengan filter dimana akses user ialah donatur
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
                <a href="' . route('users.donatur.edit') . '?id=' . encrypt($data->id_users) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_donatur" data-d_nama_users="'.$data->nama_users.'" data-d_id_users="'.$data->id_users.'" data-toggle="modal" class="modal_delete_donatur btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
            })->make(true);
        return $data_table;
    }

}
