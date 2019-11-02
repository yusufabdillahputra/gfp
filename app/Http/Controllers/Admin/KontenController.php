<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Konten\Detail\SubKontenModel;
use App\Http\Models\Konten\Resource\KontenModel;
use App\Http\Models\Konten\Source\Img_SubKontenModel;
use App\Http\Models\Label\Resource\LabelModel;
use App\Http\Models\Label\Source\Src_LabelModel;
use App\Http\Models\Users\Resource\UsersModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class KontenController extends AdminController
{
    public function __construct()
    {
        parent::__construct('konten');
        $this->rsc_model['KontenModel'] = new KontenModel();
        $this->rsc_model['LabelModel'] = new LabelModel();
        $this->dtl_model['SubKontenModel'] = new SubKontenModel();
        $this->src_model['Img_SubKontenModel'] = new Img_SubKontenModel();
        $this->src_model['Src_LabelModel'] = new Src_LabelModel();
        $this->rsc_model['Users_Model'] = new UsersModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('konten.index')
        ]);
    }

    public function createKonten(Request $request)
    {
        $status = $this->rsc_model['KontenModel']->createData($request->all());
        $redirect = redirect(route('konten.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function dataTableKonten()
    {
        return $this->rsc_model['KontenModel']->dataTableQuery();
    }

    public function deleteKonten(Request $request)
    {
        $status = $this->rsc_model['KontenModel']->forceDeleteById($request->post('id_konten'));
        $redirect = redirect(route('konten.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function editKonten(Request $request)
    {
        $status = $this->rsc_model['KontenModel']->updateById($request->all());
        $redirect = redirect(route('konten.index'));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function ajaxCekSubKonten(Request $request)
    {
        return $this->dtl_model['SubKontenModel']->cekSubKonten($request->post('id_konten'));
    }

    /**
     * List sub konten dari konten
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewSubKonten(Request $request)
    {
        return $this->pathView('sub', [
            'breadcrumbs' => Breadcrumbs::render('konten.sub'),
            'data' => $this->rsc_model['KontenModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function dataTableSubKonten(Request $request)
    {
        return $this->dtl_model['SubKontenModel']->dataTableQuery($request->post('id_konten'));
    }

    public function createSubKonten(Request $request)
    {
        $status = $this->dtl_model['SubKontenModel']->createData($request->all());
        if ($status['code'] == 200) {
            return redirect(route('konten.sub.edit').'?id='.encrypt($status['data']))->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function deleteSubKonten(Request $request)
    {
        /**
         * Cek apakah sub konten memiliki foto ?, kalau ada hapus semuanya
         */
        $this->src_model['Img_SubKontenModel']->gambarSubKonten($request->post('id_subk'), 'DELETE');

        $status = $this->dtl_model['SubKontenModel']->forceDeleteById($request->post('id_subk'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    /**
     * Form (Edit) Sub Konten
     */
    public function editSubKonten(Request $request)
    {
        return $this->pathView('edit', [
            'breadcrumbs' => Breadcrumbs::render('konten.sub.edit'),
            'gambar' => $this->src_model['Img_SubKontenModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'data' => $this->dtl_model['SubKontenModel']->getById(decrypt($request->get('id')))['data'],
            'rsc_label' => $this->rsc_model['LabelModel']->getAll()['data'],
            'src_label' => $this->src_model['Src_LabelModel']->getAllSubKontenByForeignKey(decrypt($request->get('id')))['data']
        ]);
    }

    public function uploadGambarSubKonten(Request $request)
    {
        $upload_file = $request->file('path_img_subk');
        foreach ($upload_file as $img => $data) {
            $path = $data->store('konten/sub_konten');
            $this->src_model['Img_SubKontenModel']::create([
                'id_subk' => $request->post('id_subk'),
                'path_img_subk' => $path,
                'created_by' => $request->session()->get('id_users')
            ]);
        }
        /**
         * function tidak memiliki return dikarenakan proses di trigger oleh Dropzone.JS
         * todo : lakukan redirect secara asyncronous menggunakan Dropzone.js
         *      : Tolong jangan di looping koneksi !, Namun bagaimana set path nya ke tabel ?
         */
        // return ?? with(['success' => 'Foto Berhasil dirubah']);
    }

    public function deleteGambarSubKonten(Request $request)
    {
        $status = $this->src_model['Img_SubKontenModel']->deleteGambarSubKonten($request->post('id_img_subk'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function setThumbnailSubKonten(Request $request)
    {
        $status = $this->src_model['Img_SubKontenModel']->setThumbnailSubKonten($request->post('id_img_subk'), $request->post('id_subk'), $request->post('updated_by'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function updateSubKonten(Request $request)
    {
        $status = $this->dtl_model['SubKontenModel']->updateSubKonten($request->all());
        $status_broadcast = $request->post('dtl')['broadcast_subk'];
        if ($status_broadcast == 1) {
            $this->dtl_model['SubKontenModel']->broadcastEmail($request->post('dtl')['id_subk']);
        }
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
        return $status;
    }

}
