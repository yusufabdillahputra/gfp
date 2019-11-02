<?php

namespace App\Http\Models\Donasi\Source;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Src_DonasiModel extends Model {

    protected $table = 'tbl_src_donasi';
    protected $view = 'vw_src_donasi';
    protected $primaryKey = 'id_src_donasi';
    protected $foreignKey = 'id_feed';
    protected $guards = [
        "id_src_donasi",
        "created_at"
    ];
    protected $fillable = [
        "id_donasi",
        "id_feed",
        "created_by",
        "deleted_by",
        "deleted_at"
    ];
    protected $dates = [
        "deleted_at",
        'updated_at',
        'created_at'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function getByFeed($id)
    {
        try {
            $data = DB::table($this->view)
                ->select('id_src_donasi', 'nama_donasi')
                ->whereNotNull($this->foreignKey)
                ->where($this->foreignKey, $id)
                ->orderBy('id_donasi', 'asc')
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

    public function getAllByForeignKey($id_foreignKey)
    {
        try {
            $fetch = self::select('id_donasi')
                ->whereNotNull($this->foreignKey)
                ->where($this->foreignKey, $id_foreignKey)
                ->get();
            $data_array = array();
            foreach ($fetch as $array_key => $data) {
                $data_array[] = $data['id_donasi'];
            }
            $fetch_implode = implode(',', $data_array);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $fetch_implode
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

    public function prosesDataFeed($condition = 'REPLACE' , $array_data) {
        try {
            if ($condition == 'REPLACE') {
                self::where($this->foreignKey, $array_data[0][$this->foreignKey])->forceDelete();
                self::insert($array_data);
            } if ($condition == 'RESET') {
                self::where('id_feed', $array_data)->forceDelete();
            }
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Berhasil eksekusi query',
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

}
