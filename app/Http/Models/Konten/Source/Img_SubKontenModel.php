<?php

namespace App\Http\Models\Konten\Source;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class Img_SubKontenModel extends Model
{
    protected $table = 'tbl_src_img_sub_konten';
    protected $primaryKey = 'id_img_subk';
    protected $foreignKey = 'id_subk';
    protected $guards = [
        "id_img_subk",
        'created_at'
    ];
    protected $fillable = [
        'id_subk',
        "path_img_subk",
        "thumbnail_img_subk",
        "created_by",
        "updated_by",
        "updated_at",
        "deleted_at",
        "deleted_by"
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
    public function getAllByForeignKey($id_foreignKey)
    {
        try {
            $data = self::where($this->foreignKey, $id_foreignKey)->get();
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
     * Mengambil foto user
     *
     * @param $id_users
     * @param string $fungsi
     * @return mixed
     */
    public function gambarSubKonten($id_foreignKey, $fungsi = 'THUMBNAIL')
    {
        /**
         * Cek terdahulu apakah ada foto di storage
         */
        if ($fungsi == 'THUMBNAIL') {
            $path = self::select('id_img_subk', 'id_subk', 'path_img_subk')
                ->where($this->foreignKey, $id_foreignKey)
                ->where('thumbnail_img_subk', true)
                ->first();
            return $path['path_img_subk'];
        } elseif ($fungsi == 'DELETE') {
            $fetch = self::select('id_img_subk', 'id_subk', 'path_img_subk')
                ->where($this->foreignKey, $id_foreignKey)
                ->get();
            /**
             * Jika ada hapus
             */
            if (!$fetch->isEmpty()) {
                foreach ($fetch as $key_array => $data) {
                    $delete_path[] = $data['path_img_subk'];
                }
                /**
                 * Hapus path di tabel tbl_src_img_sub_konten
                 */
                self::where($this->foreignKey, $id_foreignKey)->forceDelete();
                return Storage::delete($delete_path);
            } else {
                return true;
            }
        }
    }

    public function deleteGambarSubKonten($id_primaryKey)
    {
        try {
            $fetch_path = self::select('id_img_subk', 'path_img_subk')
                ->where($this->primaryKey, $id_primaryKey)
                ->first();
            Storage::delete($fetch_path['path_img_subk']);
            self::where($this->primaryKey, $id_primaryKey)->forceDelete();
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

    public function setThumbnailSubKonten($id_primaryKey, $id_foreignKey, $id_session)
    {
        try {
            /**
             * Cari data yang thumbnail nya true lalu set jadi false
             */
            $fetch_path = self::select('id_img_subk', 'thumbnail_img_subk')
                ->where($this->foreignKey, $id_foreignKey)
                ->where('thumbnail_img_subk', true)
                ->first();
            if (!empty($fetch_path)) {
                self::where($this->primaryKey, $fetch_path['id_img_subk'])
                    ->update([
                        'thumbnail_img_subk' => false,
                        'updated_by' => $id_session,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }
            /**
             * Update gambar thumbnail yang di set
             */
            self::where($this->primaryKey, $id_primaryKey)
                ->update([
                    'thumbnail_img_subk' => true,
                    'updated_by' => $id_session,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            $status = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Berhasil di Ubah',
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
