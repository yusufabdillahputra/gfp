<?php

namespace App\Http\Models\Payment\Resource;

use App\Http\Models\Users\Resource\UsersModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PaymentModel extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_rsc_payment';
    protected $primaryKey = 'id_payment';
    protected $guards = [
        "id_payment",
        "created_at"
    ];
    protected $fillable = [
        "nama_bank_payment",
        "rekening_payment",
        "pemilik_rek_payment",
        "jenis_payment",
        "logo_bank_payment",
        "created_by",
        "updated_by",
        "updated_at",
        "deleted_by",
        "deleted_at"
    ];
    protected $dates = [
        "created_at",
        "updated_at",
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

    public function getByJenis($jenis_payment)
    {
        try {
            $data = self::where('jenis_payment', $jenis_payment)
                ->orderBy('id_payment', 'desc')
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
     * Mengambil data di tong sampah
     * Method   : GET
     *
     * @return void
     */
    public function getTrashed()
    {
        try {
            $data = self::onlyTrashed()->get();
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
                'data' => $query->id_payment
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
                    "nama_bank_payment" => $array_data['nama_bank_payment'],
                    "rekening_payment" => $array_data['rekening_payment'],
                    "pemilik_rek_payment" => $array_data['pemilik_rek_payment'],
                    "jenis_payment" => $array_data['jenis_payment'],
                    "step_payment" => $array_data['step_payment'],
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

        $query = self::select('id_payment', 'nama_bank_payment', 'created_at')->orderBy('created_at', 'desc');
        if ($fetch_rules->payment->delete == 1 AND $fetch_rules->payment->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('payment.edit.form') . '?id=' . encrypt($data->id_payment) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
                <a href="#modal_delete_payment" data-d_nama_bank_payment="' . $data->nama_bank_payment . '" data-d_id_payment="' . $data->id_payment . '" data-toggle="modal" class="modal_delete_payment btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->payment->delete == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="#modal_delete_payment" data-d_nama_bank_payment="' . $data->nama_bank_payment . '" data-d_id_payment="' . $data->id_payment . '" data-toggle="modal" class="modal_delete_payment btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                ';
                })->make(true);
        } elseif ($fetch_rules->payment->update == 1) {
            $data_table = Datatables::of($query)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                <a href="' . route('payment.edit.form') . '?id=' . encrypt($data->id_payment) . '" class="btn btn-xs btn-complete"><i class="fa fa-edit"></i> Edit</a>
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

    public function logoBank($id_payment, $fungsi = 'GET')
    {
        /**
         * Cek terdahulu apakah ada foto di storage
         */
        $path_logo = self::select('id_payment', 'logo_bank_payment')
            ->where($this->primaryKey, $id_payment)
            ->first();
        if ($fungsi == 'GET') {
            return $path_logo['logo_bank_payment'];
        } elseif ($fungsi == 'DELETE') {
            /**
             * Jika ada hapus
             */
            if (!empty($path_logo['logo_bank_payment']) AND $path_logo['logo_bank_payment'] !== 'public/payment/default.png') {
                return Storage::delete($path_logo['logo_bank_payment']);
            }
        } else {
            return $path_logo['logo_bank_payment'];
        }
    }


}
