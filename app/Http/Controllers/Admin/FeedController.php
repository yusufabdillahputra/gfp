<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Donasi\Resource\DonasiModel;
use App\Http\Models\Donasi\Source\Src_DonasiModel;
use App\Http\Models\Feed\Resource\FeedModel;
use App\Http\Models\Feed\Source\Img_FeedModel;
use App\Http\Models\Label\Resource\LabelModel;
use App\Http\Models\Label\Source\Src_LabelModel;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\AdminController;

class FeedController extends AdminController
{
    public function __construct()
    {
        parent::__construct('feed');
        $this->rsc_model['FeedModel'] = new FeedModel();
        $this->rsc_model['LabelModel'] =  new LabelModel();
        $this->rsc_model['DonasiModel'] =  new DonasiModel();
        $this->src_model['Src_LabelModel'] = new Src_LabelModel();
        $this->src_model['Src_DonasiModel'] = new Src_DonasiModel();
        $this->src_model['Img_FeedModel'] = new Img_FeedModel();
    }

    public function index(Request $request)
    {
        return $this->pathView('index', [
            'breadcrumbs' => Breadcrumbs::render('feed.index')
        ]);
    }

    public function dataTableFeed()
    {
        return $this->rsc_model['FeedModel']->dataTableQuery();
    }

    public function formFeed(Request $request)
    {
        return $this->pathView('form', [
            'breadcrumbs' => Breadcrumbs::render('feed.form'),
            'gambar' => $this->src_model['Img_FeedModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'rsc_label' => $this->rsc_model['LabelModel']->getAll()['data'],
            'rsc_donasi' => $this->rsc_model['DonasiModel']->getAll()['data'],
            'src_label' => $this->src_model['Src_LabelModel']->getAllFeedByForeignKey(decrypt($request->get('id')))['data'],
            'src_donasi' => $this->src_model['Src_DonasiModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'data' => $this->rsc_model['FeedModel']->getById(decrypt($request->get('id')))['data']
        ]);
    }

    public function createFeed(Request $request)
    {
        $status = $this->rsc_model['FeedModel']->createData($request->all());
        $redirect = redirect(route('feed.form').'?id='.encrypt($status['id']));
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function deleteFeed(Request $request)
    {
        /**
         * Cek apakah sub konten memiliki foto ?, kalau ada hapus semuanya
         */
        $this->src_model['Img_FeedModel']->gambarFeedByForeignKey($request->post('id_feed'), 'DELETE');

        $status = $this->rsc_model['FeedModel']->forceDeleteById($request->post('id_feed'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function editFeed(Request $request)
    {
        $status = $this->rsc_model['FeedModel']->updateFeed($request->all());
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
        return $status;
    }

    public function uploadGambarFeed(Request $request)
    {
        $upload_file = $request->file('path_img_feed');
        foreach ($upload_file as $img => $data) {
            $path = $data->store('feed');
            $this->src_model['Img_FeedModel']::create([
                'id_feed' => $request->post('id_feed'),
                'path_img_feed' => $path,
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

    public function deleteGambarFeed(Request $request)
    {
        $status = $this->src_model['Img_FeedModel']->deleteGambarFeedByPrimaryKey($request->post('id_img_feed'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

    public function setThumbnailFeed(Request $request)
    {
        $status = $this->src_model['Img_FeedModel']->setThumbnailFeed($request->post('id_img_feed'), $request->post('id_feed'), $request->post('updated_by'));
        $redirect = redirect()->back();
        if ($status['code'] == 200) {
            return $redirect->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return $redirect->with(['error' => $status['message']]);
        }
    }

}
