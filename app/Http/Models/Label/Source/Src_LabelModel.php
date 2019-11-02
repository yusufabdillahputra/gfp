<?php

namespace App\Http\Models\Label\Source;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Src_LabelModel extends Model {

    protected $table = 'tbl_src_label';
    protected $view = 'vw_src_label';
    protected $primaryKey = 'id_src_label';
    protected $guards = [
        "id_src_label",
        "created_at"
    ];
    protected $fillable = [
        "id_label",
        "id_subk",
        "id_feed",
        "created_by",
        "deleted_by",
        "deleted_at"
    ];
    protected $dates = [
        "deleted_at"
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function getAllSubKontenByForeignKey($id_subk)
    {
        try {
            $fetch = self::select('id_label')
                ->whereNotNull('id_subk')
                ->where('id_subk', $id_subk)
                ->get();
            $data_array = array();
            foreach ($fetch as $array_key => $data) {
                $data_array[] = $data['id_label'];
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

    public function getLabelSubKontenByForeignKey($id_subk)
    {
        try {
            $data = DB::table($this->view)->select('id_label', 'judul_label')
                ->whereNotNull('id_subk')
                ->where('id_subk', $id_subk)
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

    public function getAllFeedByForeignKey($id_feed)
    {
        try {
            $fetch = self::select('id_label')
                ->whereNotNull('id_feed')
                ->where('id_feed', $id_feed)
                ->get();
            $data_array = array();
            foreach ($fetch as $array_key => $data) {
                $data_array[] = $data['id_label'];
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

    public function getLabelFeedByForeignKey($id_feed)
    {
        try {
            $data = DB::table($this->view)->select('id_label', 'judul_label')
                ->whereNotNull('id_feed')
                ->where('id_feed', $id_feed)
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

    public function prosesLabelDataSubKonten($condition = 'REPLACE' , $array_data) {
        try {
            if ($condition == 'REPLACE') {
                self::where('id_subk', $array_data[0]['id_subk'])->forceDelete();
                self::insert($array_data);
            } if ($condition == 'RESET') {
                self::where('id_subk', $array_data)->forceDelete();
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

    public function prosesLabelDataFeed($condition = 'REPLACE' , $array_data) {
        try {
            if ($condition == 'REPLACE') {
                self::where('id_feed', $array_data[0]['id_feed'])->forceDelete();
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
