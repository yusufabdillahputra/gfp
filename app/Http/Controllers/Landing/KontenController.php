<?php

namespace App\Http\Controllers\Landing;

use App\Http\Models\Konten\Detail\SubKontenModel;
use App\Http\Models\Konten\Source\Img_SubKontenModel;
use App\Http\Models\Label\Resource\LabelModel;
use App\Http\Models\Label\Source\Src_LabelModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\LandingController;

class KontenController extends LandingController
{
    public function __construct()
    {
        parent::__construct('konten');
        $this->dtl_model['SubKontenModel'] = new SubKontenModel();
        $this->src_model['Img_SubKontenModel'] = new Img_SubKontenModel();
        $this->src_model['Src_LabelModel'] = new Src_LabelModel();
        $this->rsc_model['LabelModel'] = new LabelModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'gambar' => $this->src_model['Img_SubKontenModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'data' => $this->dtl_model['SubKontenModel']->getById(decrypt($request->get('id')))['data'],
            'rsc_label' => $this->rsc_model['LabelModel']->getAll()['data'],
            'src_label' => $this->src_model['Src_LabelModel']->getLabelSubKontenByForeignKey(decrypt($request->get('id')))['data']
        ]);
    }
}
