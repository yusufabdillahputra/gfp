<?php

namespace App\Http\Middleware;

use App\Http\Models\Users\Resource\UsersModel;
use Closure;

class CheckSession
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('id_users')) {
            return redirect(route('login'));
        }
        /**
         * Set rule akses untuk pengguna (Hati-hati pengubahan dapat merusak sistem)
         */
        if ($request->session()->exists('id_users')) {
            $users_model = new UsersModel();
            $id_users = $request->session()->get('id_users');
            $fetch = $users_model::select('rules_users')->where('id_users', $id_users)->first();
            $rules = json_decode($fetch->rules_users);
            $route_name = explode('.', $request->route()->getName());
            if ($route_name[0] == 'reqfeed') {
                if ($rules->reqfeed->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'landing') {
                if ($rules->landing->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'dashboard') {
                if ($rules->dashboard->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'transaksi') {
                if ($route_name[1] == 'topup') {
                    if ($rules->transaksi->topup->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'donasi') {
                    if ($rules->transaksi->donasi->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'kebutuhan') {
                    if ($rules->transaksi->kebutuhan->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'tarik') {
                    if ($rules->transaksi->donasi->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($rules->transaksi->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'feed') {
                if ($rules->feed->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'konten') {
                if ($rules->konten->read == 0) {
                    return redirect(route('error.forbidden'));
                } elseif ($route_name[1] == 'sub') {
                    if ($rules->konten->sub->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
            }
            if ($route_name[0] == 'label') {
                if ($rules->label->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'payment') {
                if ($rules->payment->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'donasi') {
                if ($rules->donasi->read == 0) {
                    return redirect(route('error.forbidden'));
                }
            }
            if ($route_name[0] == 'users') {
                if ($route_name[1] == 'root') {
                    if ($rules->users->root->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'admin') {
                    if ($rules->users->admin->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'donatur') {
                    if ($rules->users->donatur->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
                if ($route_name[1] == 'profile') {
                    if ($rules->users->profile->read == 0) {
                        return redirect(route('error.forbidden'));
                    }
                }
            }
            return $next($request);
        }
    }

}
