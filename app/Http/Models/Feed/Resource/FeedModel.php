<?php

namespace App\Http\Models\Feed\Resource;

use App\Http\Models\Donasi\Source\Src_DonasiModel;
use App\Http\Models\Label\Source\Src_LabelModel;
use App\Http\Models\Users\Resource\UsersModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FeedModel extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_rsc_feed';
    protected $view = 'vw_rsc_feed';
    protected $primaryKey = 'id_feed';
    protected $guards = [
        "id_feed",
        "created_at"
    ];

    protected $fillable = [
        "judul_feed",
        "draft_feed",
        "status_feed",
        "campaign_feed",
        "prioritas_feed",
        "sub_judul_feed",
        "isi_feed",
        "alamat_feed",
        "kecamatan_feed",
        "kota_feed",
        "provinsi_feed",
        "min_donasi_feed",
        "max_donasi_feed",
        "talent_feed",
        "telp_talent_feed",
        "keterangan_feed",
        "ended_feed",
        "created_by",
        "updated_by",
        "updated_at",
        "deleted_by",
        "deleted_at"
    ];

    protected $dates = [
        "deleted_at",
        'updated_at',
        'deleted_at'
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

    public function getAutoFeed()
    {
        try {
            $data = DB::table($this->view)
                ->select('id_feed', 'min_donasi_feed')
                ->where('selisih_tanggal_feed', '>', 0)
                ->where('draft_feed', 1)
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

    public function getFeedsAppend($offset = 0, $limit = 6)
    {
        try {
            $data = DB::table($this->view)
                ->where('selisih_tanggal_feed', '>', 0)
                ->where('draft_feed', 1)
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

    public function getLabelFeedsAppend($id_label, $offset = 0, $limit = 6)
    {
        try {
            $data = DB::table('vw_label_feed')
                ->where('selisih_tanggal_feed', '>', 0)
                ->where('draft_feed', 1)
                ->where('id_label', $id_label)
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
            $data = DB::table($this->view)->where($this->primaryKey, $id)->first();
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
    public function getCampaign()
    {
        try {
            $data = self::where('campaign_feed', 2)->first();
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
            $query = self::create($request_data);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibuat',
                'id' => $query->id_feed
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
     * Create and Replace Label
     * Method   : PUT
     *
     * @param [type] $array_data
     * @return array
     */
    public function updateFeed($array_data)
    {
        $src_model['Src_LabelModel'] = new Src_LabelModel();
        $src_model['Src_DonasiModel'] = new Src_DonasiModel();

        /**
         * Pembuatan array kembali bertujuan untuk mempermudah mass-assignment
         */
        if (isset($array_data['src_id_label'])) {
            foreach ($array_data['src_id_label'] as $array_key_label => $data_src_label) {
                $array_create_label[] = [
                    'id_label' => $data_src_label,
                    'id_feed' => $array_data['id_feed'],
                    'created_by' => $array_data['updated_by']
                ];
            }
        }

        if (isset($array_data['src_id_donasi'])) {
            foreach ($array_data['src_id_donasi'] as $array_key_donasi => $data_src_donasi) {
                $array_create_donasi[] = [
                    'id_donasi' => $data_src_donasi,
                    'id_feed' => $array_data['id_feed'],
                    'created_by' => $array_data['updated_by']
                ];
            }
        }

        try {

            /**
             * Reset status campaign apabila ada campaign yang aktif
             */
            $status_campaign = $array_data['campaign_feed'];
            if ($status_campaign == 2) {
                $ex_campaign = self::select($this->primaryKey)->where('campaign_feed', 2)->first();
                if (!empty($ex_campaign)) {
                    self::where($this->primaryKey, $ex_campaign->id_feed)->update(["campaign_feed" => 1]);
                }
            }

            /**
             * Proses update data detail
             */
            self::where($this->primaryKey, $array_data[$this->primaryKey])
                ->update([
                    'judul_feed' => $array_data['judul_feed'],
                    "draft_feed" => $array_data['draft_feed'],
                    "campaign_feed" => $array_data['campaign_feed'],
                    "prioritas_feed" => $array_data['prioritas_feed'],
                    "sub_judul_feed" => $array_data['sub_judul_feed'],
                    "isi_feed" => $array_data['isi_feed'],
                    "alamat_feed" => $array_data['alamat_feed'],
                    "kecamatan_feed" => $array_data['kecamatan_feed'],
                    "kota_feed" => $array_data['kota_feed'],
                    "provinsi_feed" => $array_data['provinsi_feed'],
                    "min_donasi_feed" => $array_data['min_donasi_feed'],
                    "max_donasi_feed" => $array_data['max_donasi_feed'],
                    "talent_feed" => $array_data['talent_feed'],
                    "email_talent_feed" => $array_data['email_talent_feed'],
                    "telp_talent_feed" => $array_data['telp_talent_feed'],
                    "keterangan_feed" => $array_data['keterangan_feed'],
                    "ended_at_feed" => $array_data['ended_at_feed'],
                    'updated_by' => $array_data['updated_by'],
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            /**
             * Proses Replace atau reset label
             */
            if (isset($array_data['src_id_label'])) {
                $src_model['Src_LabelModel']->prosesLabelDataFeed('REPLACE', $array_create_label);
            } elseif (!isset($array_data['src_id_label'])) {
                $src_model['Src_LabelModel']->prosesLabelDataFeed('RESET', $array_data[$this->primaryKey]);
            }

            /**
             * Proses Replace atau reset jenis donasi (Kecuali uang)
             */
            if (isset($array_data['src_id_donasi'])) {
                $src_model['Src_DonasiModel']->prosesDataFeed('REPLACE', $array_create_donasi);
            } elseif (!isset($array_data['src_id_donasi'])) {
                $src_model['Src_DonasiModel']->prosesDataFeed('RESET', $array_data[$this->primaryKey]);
            }

            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Sub konten berhasil di update',
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

        $query = self::select('id_feed', 'judul_feed', 'created_at')->orderBy('created_at', 'desc');
        if ($fetch_rules->feed->delete == 1 AND $fetch_rules->feed->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('feed.form') . '?id=' . encrypt($data->id_feed) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_feed" data-d_csrf="'.@csrf_token().'" data-d_judul_feed="'.$data->judul_feed.'" data-d_id_feed="'.$data->id_feed.'" data-toggle="modal" class="modal_delete_feed btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->feed->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('feed.form') . '?id=' . encrypt($data->id_feed) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->feed->delete == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="#modal_delete_feed" data-d_csrf="'.@csrf_token().'" data-d_judul_feed="'.$data->judul_feed.'" data-d_id_feed="'.$data->id_feed.'" data-toggle="modal" class="modal_delete_feed btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
