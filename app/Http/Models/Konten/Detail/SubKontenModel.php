<?php

namespace App\Http\Models\Konten\Detail;

use App\Http\Models\Label\Source\Src_LabelModel;
use App\Http\Models\Users\Resource\UsersModel;
use App\Mail\KontenEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class SubKontenModel extends Model
{
    protected $table = 'tbl_dtl_sub_konten';
    protected $view = 'vw_dtl_sub_konten';
    protected $primaryKey = 'id_subk';
    protected $foreignKey = 'id_konten';
    protected $guards = [
        "id_subk",
        'created_at'
    ];
    protected $fillable = [
        'id_konten',
        "judul_subk",
        "posisi_subk",
        'isi_subk',
        'broadcast_subk',
        "created_by",
        "updated_by",
        "updated_at",
        "deleted_at",
        "deleted_by"
    ];

    protected $dates = [
        'created_at',
        "updated_at",
        "deleted_at",
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

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
            $query = self::create($request_data);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibuat',
                'data' => $query->id_subk
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
                    'judul_subk' => $array_data['judul_subk'],
                    'isi_subk' => $array_data['isi_subk'],
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
     * Membataskan pengambilan data datatable dengan filter dimana akses user ialah admin
     *
     * @return void
     * @throws \Exception
     */
    public function dataTableQuery($id_konten)
    {
        $UsersModel = new UsersModel();
        $sesi_id_users = session()->get('id_users');
        $fetch_rules = json_decode($UsersModel->getUsersRulesById($sesi_id_users)['data']);

        $query = self::select('id_subk', 'id_konten', 'judul_subk', 'created_at')->where('id_konten', $id_konten);

        if ($fetch_rules->konten->sub->delete == 1 AND $fetch_rules->konten->sub->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('konten.sub.edit') . '?id=' . encrypt($data->id_subk) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_subk" data-d_judul_subk="' . $data->judul_subk . '" data-d_id_subk="' . $data->id_subk . '" data-toggle="modal" class="modal_delete_subk btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } else if ($fetch_rules->konten->sub->delete == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('konten.sub.edit') . '?id=' . encrypt($data->id_subk) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                </div>
                ';
                })->make(true);
        } else if ($fetch_rules->konten->sub->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('konten.sub.edit') . '?id=' . encrypt($data->id_subk) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
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

    public function cekSubKonten($id_konten)
    {
        try {
            $cek = self::where($this->foreignKey, $id_konten)->first();
            if (!empty($cek)) {
                $sub_konten = true;
            } else if (empty($cek)) {
                $sub_konten = false;
            }
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Query berhasil di eksekusi',
                'data' => $sub_konten
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

    public function broadcastEmail($id_subk)
    {
        $Users_Model = new UsersModel();
        $data = [
            'link' => route('frontend.konten.index') . "?id=" . encrypt($id_subk)
        ];
        $emails = $Users_Model->getEmail()['data'];
        Mail::send('mail.konten', $data, function($message) use ($emails)
        {    
            $message->to($emails)
                    ->from('noreply@globalfundforprosperity.com')
                    ->subject('Konten | Global Fund For Prosperity');
        });
        self::where($this->primaryKey, $id_subk)
            ->update([
                'broadcast_subk' => 0,
            ]);
    }

    public function updateSubKonten($array_data)
    {
        $src_model = new Src_LabelModel();

        /**
         * Pembuatan array kembali bertujuan untuk mempermudah mass-assignment
         */
        if (isset($array_data['src_id_label'])) {
            foreach ($array_data['src_id_label'] as $array_key => $data_src) {
                $array_create[] = [
                    'id_label' => $data_src,
                    'id_subk' => $array_data['dtl']['id_subk'],
                    'created_by' => $array_data['dtl']['updated_by']
                ];
            }
        }

        try {
            self::where($this->primaryKey, $array_data['dtl'][$this->primaryKey])
                ->update([
                    'posisi_subk' => $array_data['dtl']['posisi_subk'],
                    'isi_subk' => $array_data['dtl']['isi_subk'],
                    'broadcast_subk' => $array_data['dtl']['broadcast_subk'],
                    'updated_by' => $array_data['dtl']['updated_by'],
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            /**
             * todo : lakukan proses insert tbl_src_label dengan array_data['src_id_label']
             */
            if (isset($array_data['src_id_label'])) {
                $src_model->prosesLabelDataSubKonten('REPLACE', $array_create);
            } elseif (!isset($array_data['src_id_label'])) {
                $src_model->prosesLabelDataSubKonten('RESET', $array_data['dtl'][$this->primaryKey]);
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

    public function getFooterKonten()
    {
        try {
            $konten = DB::table($this->view)->select('id_konten', 'judul_konten')
                ->where('posisi_subk', '=', 2)
                ->distinct()
                ->get();

            $sub_konten = DB::table($this->view)->select('id_subk', 'id_konten', 'judul_subk')
                ->where('posisi_subk', '=', 2)
                ->get();

            $result = [
                'konten' => $konten,
                'sub_konten' => $sub_konten
            ];

            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $result
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

    public function getHeaderKonten()
    {
        try {
            $konten = DB::table($this->view)->select('id_konten', 'judul_konten')
                ->where('posisi_subk', '=', 1)
                ->distinct()
                ->get();

            $sub_konten = DB::table($this->view)->select('id_subk', 'id_konten', 'judul_subk')
                ->where('posisi_subk', '=', 1)
                ->get();

            $result = [
                'konten' => $konten,
                'sub_konten' => $sub_konten
            ];

            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil Dibaca',
                'data' => $result
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
