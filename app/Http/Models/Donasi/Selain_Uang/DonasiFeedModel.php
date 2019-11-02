<?php

namespace App\Http\Models\Donasi\Selain_Uang;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DonasiFeedModel extends Model
{
    protected $table = 'tbl_feed_donasi';
    protected $view = 'vw_feed_donasi';
    protected $primaryKey = 'id_feed_donasi';
    protected $guards = [
        "id_feed_donasi",
        "created_at"
    ];
    protected $fillable = [
        "id_src_donasi",
        'id_satuan',
        'jumlah_feed_satuan',
        'status_feed_donasi',
        "created_by",
        "updated_by"
    ];
    protected $dates = [
        "created_at",
        "updated_at",
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Mengambil semua data yang ada sesuai primary key
     * Method   : GET
     *
     * @return void
     */
    public function getById($id)
    {
        try {
            $data = DB::table($this->view)
                ->where($this->primaryKey, $id)
                ->first();
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
     * Mengambil semua data yang ada sesuai feed
     * Method   : GET
     *
     * @return void
     */
    public function getByFeed($id_feed, $offset = 0, $limit = 3)
    {
        try {
            $data = DB::table($this->view)
                ->where('id_feed', $id_feed)
                ->where('status_feed_donasi', 2)
                ->offset($offset)
                ->limit($limit)
                ->orderBy('created_at', 'desc')
                ->get();
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

    public function getAllSatuan()
    {
        try {
            $data = DB::table('tbl_rsc_satuan')
                ->select('id_satuan', 'nama_satuan')
                ->orderBy('nama_satuan', 'desc')
                ->get();
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

    public function getByFeedCount($id_feed)
    {
        try {
            $data = DB::table($this->view)
                ->select($this->primaryKey)
                ->where('id_feed', $id_feed)
                ->where('status_feed_donasi', 2)
                ->orderBy('created_at', 'desc')
                ->get();
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $data->count()
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
                    'status_feed_donasi' => $array_data['status_feed_donasi'],
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

    public function dataTableKebutuhan()
    {
        $query = DB::table($this->view)
            ->select('id_feed_donasi', 'nama_users', 'jumlah_feed_satuan', 'nama_satuan', 'status_feed_donasi', 'created_at')
            ->orderBy('created_at', 'desc');
        $data_table = Datatables::of($query)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                <a href="#modal_edit_kebutuhan" data-e_id_feed_donasi="' . $data->id_feed_donasi . '" data-e_status_feed_donasi="' . $data->status_feed_donasi . '" data-toggle="modal" class="modal_edit_kebutuhan btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="'.route('transaksi.kebutuhan.detail').'?id='.encrypt($data->id_feed_donasi).'" class="btn btn-xs btn-success"><i class="fa fa-search"></i> Detail</a>
                </div>
                ';
            })->make(true);
        return $data_table;
    }

}
