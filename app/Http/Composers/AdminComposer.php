<?php

namespace App\Http\Composers;

use App\Http\Models\Users\Resource\UsersModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewComposer;

class AdminComposer {

    public function __construct(Request $request)
    {
        $this->rsc_model = new UsersModel();
        $this->foto_users = Storage::url($this->rsc_model->fotoUsers($request->session()->get('id_users')));
        $this->session = $request->session()->all();
        $this->rules = $this->rsc_model->getUsersRulesById($request->session()->get('id_users'))['data'];
    }

    public function compose(View $view) {
        $view->with('foto_users', $this->foto_users);
        $view->with('session', $this->session);
        ViewComposer::share([
            'composers_rules_users' => json_decode($this->rules),
        ]);
    }

}
