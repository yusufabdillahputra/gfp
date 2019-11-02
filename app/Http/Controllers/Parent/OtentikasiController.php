<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OtentikasiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $ctrl_path;

    protected function __construct($controller_path){
        $this->ctrl_path = $controller_path;
    }

    protected function motherPath() {
        return 'otentikasi';
    }

    protected function pathView($path, $data = null) {
        if (empty($data)) {
            return view(self::motherPath().'.'.$this->ctrl_path.'.'.$path);
        } else if (!empty($data)) {
            return view(self::motherPath().'.'.$this->ctrl_path.'.'.$path, $data);
        }
    }
}
