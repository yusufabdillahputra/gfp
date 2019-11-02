<?php

namespace App\Http\Composers;

use App\Http\Models\Konten\Detail\SubKontenModel;
use App\Http\Models\Users\Resource\UsersModel;
use App\Http\Models\Dompet\Resource\DompetModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewComposer;

class LandingComposer
{

    public function __construct(Request $request)
    {
        $this->cek_sesi = $request->session()->get('id_users');
        if (isset($this->cek_sesi)) {
            $this->rsc_model['UsersModel'] = new UsersModel();
            $this->rsc_model['DompetModel'] = new DompetModel();
            $this->foto_users = Storage::url($this->rsc_model['UsersModel']->fotoUsers($request->session()->get('id_users')));
            $this->saldo = $this->rsc_model['DompetModel']->getById($request->session()->get('id_users'), 'BY_FOREIGN')['data']['saldo_dompet'];
            $this->id_dompet = $this->rsc_model['DompetModel']->getById($request->session()->get('id_users'), 'BY_FOREIGN')['data']['id_dompet'];
            $this->session = $request->session()->all();
            $this->rules = $this->rsc_model['UsersModel']->getUsersRulesById($request->session()->get('id_users'))['data'];
        }
        $this->dtl_model['SubKontenModel'] = new SubKontenModel();
    }

    public function compose(View $view)
    {
        if (isset($this->cek_sesi)) {
            $view->with('foto_users', $this->foto_users);
            $view->with('session', $this->session);
            ViewComposer::share([
                'composers_rules_users' => json_decode($this->rules),
                'composers_saldo_dompet' => $this->saldo,
                'composers_id_dompet' => $this->id_dompet,
                'mst_konten_footer' => $this->dtl_model['SubKontenModel']->getFooterKonten()['data'],
                'mst_konten_header' => $this->dtl_model['SubKontenModel']->getHeaderKonten()['data']
            ]);
        } else {
            ViewComposer::share([
                'mst_konten_footer' => $this->dtl_model['SubKontenModel']->getFooterKonten()['data'],
                'mst_konten_header' => $this->dtl_model['SubKontenModel']->getHeaderKonten()['data']
            ]);
        }
    }

}
