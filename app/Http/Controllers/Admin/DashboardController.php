<?php

namespace App\Http\Controllers\Admin;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class DashboardController extends AdminController
{
    public function __construct(){
        parent::__construct('dashboard');
    }

    public function index(Request $request){
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('dashboard.index'),
        ]);
    }
}
