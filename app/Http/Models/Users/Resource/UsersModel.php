<?php

namespace App\Http\Models\Users\Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersModel extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_rsc_users';
    protected $primaryKey = 'id_users';
    protected $guards = [
        "id_users",
        "remember_token",
        "created_at",
    ];
    protected $fillable = [
        "username_users",
        "password_users",
        "akses_users",
        "nama_users",
        "email_users",
        "telp_users",
        "remember_token",
        "jenis_kelamin_users",
        "foto_users",
        "rules_users",
        "updated_by",
        "updated_at",
        "created_by",
        "deleted_at",
        "deleted_by"
    ];
    protected $dates = [
        "deleted_at",
        "updated_at",
        "deleted_at"
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    private $users_unathorized = 0;
    private $users_super_admin = 1;
    private $users_admin = 2;
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

    public function getEmail()
    {
        try {
            $fetch = self::select('email_users')->distinct()->get();
            $data = array();
            foreach ($fetch as $email) {
                array_push($data, $email->email_users);
            }
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
            $query = self::create($request_data);
            $id = $query->id_users;
            $akses = $request_data['akses_users'];
            if ($akses == env('AKSES_ROOT')) {
                $rules = env('RULE_DEFAULT_ROOT');
            } elseif ($akses == env('AKSES_ADMIN')) {
                $rules = env('RULE_DEFAULT_ADMIN');
            } elseif ($akses == env('AKSES_DONATUR')) {
                $rules = env('RULE_DEFAULT_DONATUR');
            } else {
                die();
            }
            self::where($this->primaryKey, $id)->update([
                'rules_users' => $rules
            ]);
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

    public function daftarDonatur($request_data) {
        try {
            $query = self::create([
                'username_users' => $request_data['username_users'],
                'akses_users' => env('AKSES_DONATUR'),
                'password_users' => Hash::make($request_data['password_users']),
                'nama_users' => $request_data['nama_users'],
                'email_users' => $request_data['email_users'],
                'remember_token' => encrypt(rand(1,99)),
                'created_by' => 0
            ]);
            $id = $query->id_users;
            $rules = env('RULE_DEFAULT_DONATUR');
            self::where($this->primaryKey, $id)->update([
                'rules_users' => $rules,
                'created_by' => $id
            ]);
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
                    'username_users' => $array_data['username_users'],
                    'password_users' => $array_data['password_users'],
                    'akses_users' => $array_data['akses_users'],
                    'nama_users' => $array_data['nama_users'],
                    'email_users' => $array_data['email_users'],
                    'telp_users' => $array_data['telp_users'],
                    'jenis_kelamin_users' => $array_data['jenis_kelamin_users'],
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
     * Mengambil foto user
     *
     * @param $id_users
     * @param string $fungsi
     * @return mixed
     */
    public function fotoUsers($id_users, $fungsi = 'GET')
    {
        /**
         * Cek terdahulu apakah ada foto di storage
         */
        $path_foto = self::select('id_users', 'foto_users')
            ->where('id_users', $id_users)
            ->first();
        if ($fungsi == 'GET') {
            return $path_foto['foto_users'];
        } elseif ($fungsi == 'DELETE') {
            /**
             * Jika ada hapus
             */
            if (!empty($path_foto['foto_users'])) {
                if ($path_foto['foto_users'] !== 'users/default.png') {
                    return Storage::delete($path_foto['foto_users']);
                }
            }
        } else {
            return $path_foto['foto_users'];
        }
    }

    public function editPassword($request_data)
    {
        try {
            self::where($this->primaryKey, $request_data['id_users'])->update([
                'password_users' => Hash::make($request_data['users_password_baru'])
            ]);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Password berhasil dirubah',
                'request' => $request_data
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

    public function getUsersRulesById($id)
    {
        try {
            $data = self::select('rules_users')->where('id_users', $id)->first()->rules_users;
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data berhasil di baca',
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

    public function ruleUpdate($array_data)
    {
        try {
            $raw_array = array(
                'landing' =>
                    array(
                        'read' => (int)$array_data['landing_read'],
                    ),
                'backend' =>
                    array(
                        'read' => (int)$array_data['backend_read'],
                    ),
                'dashboard' =>
                    array(
                        'read' => (int)$array_data['dashboard_read'],
                    ),
                'transaksi' =>
                    array(
                        'read' => (int)$array_data['transaksi_read'],
                        'topup' =>
                            array(
                                'read' => (int)$array_data['transaksi_topup_read'],
                            ),
                        'tarik' =>
                            array(
                                'read' => (int)$array_data['transaksi_tarik_read'],
                            ),
                        'donasi' =>
                            array(
                                'read' => (int)$array_data['transaksi_donasi_read'],
                            ),
                        'kebutuhan' =>
                            array(
                                'read' => (int)$array_data['transaksi_kebutuhan_read'],
                            ),
                    ),
                'feed' =>
                    array(
                        'create' => (int)$array_data['feed_create'],
                        'read' => (int)$array_data['feed_read'],
                        'update' => (int)$array_data['feed_update'],
                        'delete' => (int)$array_data['feed_delete'],
                    ),
                'konten' =>
                    array(
                        'create' => (int)$array_data['konten_create'],
                        'read' => (int)$array_data['konten_read'],
                        'update' => (int)$array_data['konten_update'],
                        'delete' => (int)$array_data['konten_delete'],
                        'sub' =>
                            array(
                                'create' => (int)$array_data['konten_sub_create'],
                                'read' => (int)$array_data['konten_sub_read'],
                                'update' => (int)$array_data['konten_sub_update'],
                                'delete' => (int)$array_data['konten_sub_delete'],
                            ),
                    ),
                'label' =>
                    array(
                        'create' => (int)$array_data['label_create'],
                        'read' => (int)$array_data['label_read'],
                        'update' => (int)$array_data['label_update'],
                        'delete' => (int)$array_data['label_delete'],
                    ),
                'payment' =>
                    array(
                        'create' => (int)$array_data['payment_create'],
                        'read' => (int)$array_data['payment_read'],
                        'update' => (int)$array_data['payment_update'],
                        'delete' => (int)$array_data['payment_delete'],
                    ),
                'donasi' =>
                    array(
                        'create' => (int)$array_data['donasi_create'],
                        'read' => (int)$array_data['donasi_read'],
                        'update' => (int)$array_data['donasi_update'],
                        'delete' => (int)$array_data['donasi_delete'],
                    ),
                'users' =>
                    array(
                        'root' =>
                            array(
                                'read' => 0,
                            ),
                        'admin' =>
                            array(
                                'read' => (int)$array_data['users_admin_read'],
                            ),
                        'donatur' =>
                            array(
                                'read' => (int)$array_data['users_donatur_read'],
                            ),
                        'profile' =>
                            array(
                                'read' => 1,
                            ),
                    ),
            );
            self::where($this->primaryKey, $array_data[$this->primaryKey])
                ->update([
                    'rules_users' => json_encode($raw_array),
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

}
