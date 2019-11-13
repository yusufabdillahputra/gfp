<?php

namespace App\Http\Models\Otentikasi;

use App\Http\Models\Users\Log\LogModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthModel extends Model
{
    protected $table = 'tbl_rsc_users';
    protected $primaryKey = 'id_users';
    protected $guards = [
        'id_users',
        "username_users",
        "password_users",
        "akses_users",
        "nama_users",
        "email_users",
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

    public function verifyUser($request)
    {
        $query = self::where('username_users', $request['username_users']);
        $data = $query->first();
        if (empty($data)) {
            Session::flash('HTTP_Code', 401);
            return redirect()->route('login');
        } elseif (!empty($data)) {
            if (Hash::check($request['password_users'], $data->password_users)) {
                /**
                 * Dikarenakan di hosting tidak diperbolehkan memakai Event
                 * Untuk sementara eksekusi di selipkan ketika user login
                 */
                self::eventFeedEnded();
                self::eventTransaksiExpired();
                /**
                 * ######################################################
                 */
                Session::put([
                    'id_users' => $data['id_users'],
                    'username_users' => $data['username_users'],
                    'password_users' => $data['password_users'],
                    'akses_users' => $data['akses_users'],
                    'nama_users' => $data['nama_users']
                ]);

                /**
                 * Set Log Login Pengguna
                 */
                $LogModel = new LogModel();
                $log_data = [
                    'tipe_log' => 1,
                    'id_users' => $data['id_users']
                ];
                $LogModel->createData($log_data);

                if ($data['akses_users'] == env('AKSES_ROOT') OR $data['akses_users'] == env('AKSES_ADMIN')) {
                    return redirect()->route('dashboard.index');
                } else {
                    return redirect()->route('landing.index');
                }
            } else {
                Session::flash('HTTP_Code', 401);
                return redirect()->route('login');
            }
        }
    }

    public function logoutUser()
    {
        /**
         * Dikarenakan di hosting tidak diperbolehkan memakai Event
         * Untuk sementara eksekusi di selipkan ketika user logout
         */
        self::eventFeedEnded();
        self::eventTransaksiExpired();
        /**
         * ######################################################
         */

        /**
         * Set Log Logout Pengguna
         */
        $LogModel = new LogModel();
        $log_data = [
            'tipe_log' => 2,
            'id_users' => Session::get('id_users')
        ];
        $LogModel->createData($log_data);

        Session::flush();
        return redirect()->route('index');
    }

    private function eventFeedEnded()
    {
        try {
            DB::table('tbl_rsc_feed')
                ->where('ended_at_feed', '<=', Carbon::now()->toDateTimeString())
                ->where('status_feed', true)
                ->update([
                    'status_feed' => false,
                    'updated_by' => 0,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
        } catch (QueryException $error) {
            return $error;
        }
    }

    private function eventTransaksiExpired()
    {
        try {
            DB::table('tbl_dtl_transaksi')
                ->where('created_at', Carbon::now()->addDay()->toDateTimeString())
                ->where('status_transaksi', 0)
                ->update([
                    'status_transaksi' => 3,
                    'updated_by' => 0,
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
        } catch (QueryException $error) {
            return $error;
        }
    }

}
