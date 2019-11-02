<?php

namespace App\Http\Controllers\Otentikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Parent\OtentikasiController;

class ErrorController extends OtentikasiController
{
    public function __construct()
    {
        parent::__construct('error');
    }

    public function forbiddenError()
    {
        return $this->pathView('forbidden');
    }

}
