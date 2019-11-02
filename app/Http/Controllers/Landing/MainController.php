<?php

namespace App\Http\Controllers\Landing;

use App\Http\Models\Donasi\Resource\DonasiModel;
use App\Http\Models\Donasi\Selain_Uang\DonasiFeedModel;
use App\Http\Models\Donasi\Source\Src_DonasiModel;
use App\Http\Models\Feed\Resource\FeedModel;
use App\Http\Models\Feed\Source\Img_FeedModel;
use App\Http\Models\Label\Resource\LabelModel;
use App\Http\Models\Label\Source\Src_LabelModel;
use App\Http\Models\Payment\Resource\PaymentModel;
use App\Http\Models\Transaksi\Detail\TransaksiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Parent\LandingController;
use Illuminate\Support\Facades\Hash;

class MainController extends LandingController
{
    public function __construct()
    {
        parent::__construct('landing');
        $this->rsc_model['FeedModel'] = new FeedModel();
        $this->rsc_model['PaymentModel'] = new PaymentModel();
        $this->rsc_model['LabelModel'] = new LabelModel();
        $this->rsc_model['DonasiModel'] = new DonasiModel();

        $this->src_model['Src_LabelModel'] = new Src_LabelModel();
        $this->src_model['Src_DonasiModel'] = new Src_DonasiModel();
        $this->src_model['Img_FeedModel'] = new Img_FeedModel();

        $this->dtl_model['TransaksiModel'] = new TransaksiModel();

        $this->feed_model['DonasiFeedModel'] = new DonasiFeedModel();

    }

    public function index(Request $request)
    {
        $data_campaign = $this->rsc_model['FeedModel']->getCampaign()['data'];
        return $this->pathView('index', [
            'data_campaign' => $data_campaign,
            'gambar_campaign' => $this->src_model['Img_FeedModel']->getAllByForeignKey($data_campaign->id_feed)['data'],
            'feeds' => $this->rsc_model['FeedModel']->getFeedsAppend()['data'],
            'rsc_label' => $this->rsc_model['LabelModel']->getAll()['data']
        ]);
    }

    public function feed(Request $request)
    {
        return $this->pathView('feed', [
            'gambar' => $this->src_model['Img_FeedModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'rsc_label' => $this->rsc_model['LabelModel']->getAll()['data'],
            'rsc_donasi' => $this->rsc_model['DonasiModel']->getAll()['data'],
            'src_label' => $this->src_model['Src_LabelModel']->getLabelFeedByForeignKey(decrypt($request->get('id')))['data'],
            'src_donasi' => $this->src_model['Src_DonasiModel']->getAllByForeignKey(decrypt($request->get('id')))['data'],
            'rsc_payment' => $this->rsc_model['PaymentModel']->getAll()['data'],
            'data' => $this->rsc_model['FeedModel']->getById(decrypt($request->get('id')))['data'],
            'daftar_donasi_uang' => $this->dtl_model['TransaksiModel']->getFeedDonasiUang(decrypt($request->get('id')))['data'],
            'hitung_donasi_uang' => $this->dtl_model['TransaksiModel']->countFeedDonasiUang(decrypt($request->get('id')))['data'],
            'rsc_satuan' => $this->feed_model['DonasiFeedModel']->getAllSatuan()['data'],
            'feed_donasi_bukan_uang' => $this->src_model['Src_DonasiModel']->getByFeed(decrypt($request->get('id')))['data'],
            'daftar_donasi_kebutuhan' => $this->feed_model['DonasiFeedModel']->getByFeed(decrypt($request->get('id')))['data'],
            'hitung_donasi_kebutuhan' => $this->feed_model['DonasiFeedModel']->getByFeedCount(decrypt($request->get('id')))['data']
        ]);
    }

    public function ajaxAppendDaftarDonasiUang(Request $request)
    {
        return $this->pathView('ajax.donasi_uang', [
            'daftar_donasi_uang' => $this->dtl_model['TransaksiModel']->getFeedDonasiUang(decrypt($request->get('id_feed')), $request->post('offset'), $request->post('limit'))['data']
        ]);
    }

    public function ajaxAppendDaftarDonasiKebutuhan(Request $request)
    {
        return $this->pathView('ajax.donasi_kebutuhan', [
            'daftar_donasi_kebutuhan' => $this->feed_model['DonasiFeedModel']->getByFeed(decrypt($request->get('id_feed')), $request->post('offset'), $request->post('limit'))['data']
        ]);
    }

    public function ajaxAppendFeed(Request $request)
    {
        $id_label = $request->post('id_label');
        if (empty($id_label)) {
            $offset = $request->post('offset');
            if (empty($offset)) {
                return $this->pathView('ajax.feed', [
                    'feeds' => $this->rsc_model['FeedModel']->getFeedsAppend()['data']
                ]);
            } if (!empty($offset)) {
                return $this->pathView('ajax.feed', [
                    'feeds' => $this->rsc_model['FeedModel']->getFeedsAppend($request->post('offset'), $request->post('limit'))['data']
                ]);
            }
        }
        if (!empty($id_label)) {
            $offset = $request->post('offset');
            if (empty($offset)) {
                return $this->pathView('ajax.feed', [
                    'feeds' => $this->rsc_model['FeedModel']->getLabelFeedsAppend($id_label)['data']
                ]);
            }
            if (!empty($offset)) {
                return $this->pathView('ajax.feed', [
                    'feeds' => $this->rsc_model['FeedModel']->getLabelFeedsAppend($id_label, $request->post('offset'), $request->post('limit'))['data']
                ]);
            }
        }
    }

    public function ajaxGetStepPayment(Request $request)
    {
        return $this->pathView('ajax.step', [
            'data' => $this->rsc_model['PaymentModel']->getById($request->post('id_payment'), 'BY_PRIMARY')['data'],
            'jumlah_transaksi' => number_format($request->post('saldo_transaksi') + random_int(1, 999), 0, '.', ','),
            'id_payment' => $request->post('id_payment')
        ]);
    }

    public function createDonasiKebutuhan(Request $request)
    {
        $status = $this->feed_model['DonasiFeedModel']->createData($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function donasiUang(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->donasiUang($request->all());
        //$redirect = redirect(route('dompet.transaksi.detail')."?id=".encrypt($status['data']));
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function autoDonasiUang(Request $request)
    {
        $status = $this->dtl_model['TransaksiModel']->autoDonasiUang($request->all());
        if ($status['code'] == 200) {
            return redirect()->back()->with(['success' => $status['message']]);
        }
        if ($status['code'] == 500) {
            return redirect()->back()->with(['error' => $status['message']]);
        }
    }

    public function coba()
    {

    }

    public function rule()
    {
        $rule = [
            'landing' => [
                'read' => false
            ],
            'backend' => [
                'read' => false
            ],
            'dashboard' => [
                'read' => false
            ],
            'transaksi' => [
                'read' => false,
                'topup' => [
                    'read' => false
                ],
                'tarik' => [
                    'read' => false
                ],
                'donasi' => [
                    'read' => false
                ],
                'kebutuhan' => [
                    'read' => false
                ]
            ],
            'feed' => [
                'create' => false,
                'read' => false,
                'update' => false,
                'delete' => false
            ],
            'konten' => [
                'create' => false,
                'read' => false,
                'update' => false,
                'delete' => false,
                'sub' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ],
            'label' => [
                'create' => false,
                'read' => false,
                'update' => false,
                'delete' => false
            ],
            'payment' => [
                'create' => false,
                'read' => false,
                'update' => false,
                'delete' => false
            ],
            'donasi' => [
                'create' => false,
                'read' => false,
                'update' => false,
                'delete' => false
            ],
            'users' => [
                'root' => [
                    'read' => false
                ],
                'admin' => [
                    'read' => false
                ],
                'donatur' => [
                    'read' => false
                ],
                'profile' => [
                    'read' => true
                ]
            ],
        ];

        return json_encode($rule);
    }

}
