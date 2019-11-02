<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Label\Resource\LabelModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class LabelController extends AdminController
{
    public function __construct()
    {
        parent::__construct('label');
        $this->rsc_model['LabelModel'] = new LabelModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('label.index')
        ]);
    }

    public function dataTableLabel()
    {
        return $this->rsc_model['LabelModel']->dataTableQuery();
    }

    public function createLabel(Request $request)
    {
        $status = $this->rsc_model['LabelModel']->createData($request->all());
        $redirect = redirect(route('label.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function editLabel(Request $request)
    {
        $status = $this->rsc_model['LabelModel']->updateById($request->all());
        $redirect = redirect(route('label.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function deleteLabel(Request $request)
    {
        $status = $this->rsc_model['LabelModel']->forceDeleteById($request->post('id_label'));
        $redirect = redirect(route('label.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

}
