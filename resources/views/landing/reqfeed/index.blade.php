@extends('landing.global.index')

@section('title')
    Request Feed
@endsection

@section('modal')
    {{ view('landing.reqfeed.modal.create', ['created_by' => $session['id_users']]) }}
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('landing.index') }}"
                       class="btn btn-rounded btn-lg btn-outline-warning text-uppercase mb-10 mt-3">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-10 col-xs-10">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <a href="{{ route('landing.index') }}" class="btn btn-circle btn-outline-success pull-left">
                                <i class="si si-wallet"></i>
                            </a>
                            <span class="pull-center">
                                Rp. {{ number_format($composers_saldo_dompet,0,'','.') }},-
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        @endisset

        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h3 class="block-title">
                            <i class="si si-book-open"></i> Daftar Request Feed
                        </h3>
                    </div>
                    <div class="col-md-6 text-center mb-3">
                        <a href="#modal_create_feed" data-toggle="modal" class="btn btn-alt-primary">
                            <i class="si si-plus"></i> Request Feed
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(!$data->isEmpty())
            <div id="AJAX_list_reqfeed" class="row">
                @foreach($data as $feed)
                    <div class="col-md-4 animated fadeIn" data-toggle="appear">
                        <div class="block block-rounded">
                            <div class="block-content p-0 overflow-hidden">
                                @if($feed->draft_feed == 1)
                                    <a class="img-link" href="{{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}">
                                    @isset($feed->thumbnail_feed)
                                        <img width="1366px" height="768px" src="{{ Storage::url($feed->thumbnail_feed) }}"
                                             class="img-fluid rounded-top"
                                             alt="Foto Donasi">
                                    @endisset
                                    @empty($feed->thumbnail_feed)
                                        <img width="1366px" height="768px"
                                             src="{{ Storage::url('public/feed/default.png') }}"
                                             class="img-fluid rounded-top" alt="GFP">
                                    @endempty
                                    </a>
                                @elseif($feed->draft_feed == 2)
                                    <a class="img-link" href="{{ route('reqfeed.form').'?id='.encrypt($feed->id_feed) }}">
                                        @isset($feed->thumbnail_feed)
                                            <img width="1366px" height="768px" src="{{ Storage::url($feed->thumbnail_feed) }}"
                                                 class="img-fluid rounded-top"
                                                 alt="Foto Donasi">
                                        @endisset
                                        @empty($feed->thumbnail_feed)
                                            <img width="1366px" height="768px"
                                                 src="{{ Storage::url('public/feed/default.png') }}"
                                                 class="img-fluid rounded-top" alt="GFP">
                                        @endempty
                                    </a>
                                @endif
                            </div>
                            <div class="block-content border-bottom">
                                @isset($feed->judul_feed)
                                    <h4 class="font-size-h5 mb-10">{{ $feed->judul_feed }}</h4>
                                @endisset
                                @empty($feed->judul_feed)
                                    <h4 class="font-size-h5 mb-10">...</h4>
                                @endempty
                                @isset($feed->sub_judul_feed)
                                    <p class="text-muted">
                                        {{ $feed->sub_judul_feed }}
                                    </p>
                                @endisset
                                @empty($feed->sub_judul_feed)
                                    <p class="text-muted">
                                        ...
                                    </p>
                                @endempty
                            </div>
                            <div class="block-content border-bottom">
                                <p>
                                    <i class="fa fa-fw fa-money text-muted mr-5"></i> Uang Terkumpul
                                </p>
                                <h5 class="text-center">
                                    Rp. {{ number_format($feed->total_uang_donasi,0,'','.').',-' }}
                                </h5>
                            </div>
                            <div class="block-content border-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        @isset($feed->telp_talent_feed)
                                            <p>
                                                <i class="fa fa-fw fa-phone text-muted mr-5"></i> {{ $feed->telp_talent_feed }}
                                            </p>
                                        @endisset
                                        @empty($feed->telp_talent_feed)
                                            <p>
                                                <i class="fa fa-fw fa-phone text-muted mr-5"></i> ...
                                            </p>
                                        @endempty
                                    </div>
                                    <div class="col-12">
                                        <p>
                                            <i class="fa fa-fw fa-calendar-check-o text-muted mr-5"></i> {{ $feed->selisih_tanggal_feed }}
                                            Hari lagi
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        @if($feed->draft_feed == 1)
                                            <p class="text-warning">
                                                <i class="fa fa-fw fa-question-circle mr-5"></i> Hubungi administrator untuk pengubahan
                                            </p>
                                        @else
                                            @isset($feed->talent_feed)
                                                <p>
                                                    <i class="fa fa-fw fa-user-circle-o text-muted mr-5"></i> {{ $feed->talent_feed }}
                                                </p>
                                            @endisset
                                            @empty($feed->talent_feed)
                                                <p>
                                                    <i class="fa fa-fw fa-user-circle-o text-muted mr-5"></i> ...
                                                </p>
                                            @endempty
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                @if($feed->draft_feed == 1)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="btn-group">
                                                <div class="fb-share-button"
                                                     data-href="{{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}"
                                                     data-layout="button_count" data-size="small">
                                                    <a
                                                        target="_blank"
                                                        href="https://www.facebook.com/sharer/sharer.php?u={{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}&amp;src=sdkpreparse"
                                                        class="fb-xfbml-parse-ignore btn btn-lg btn-circle btn-outline-primary mr-5 mb-5">
                                                        <i class="fa fa-facebook-square"></i>
                                                    </a>
                                                </div>
                                                <a class="btn btn-lg btn-circle btn-outline-primary mr-5 mb-5"
                                                   href="whatsapp://send?text={{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}">
                                                    <i class="fa fa-whatsapp"></i>
                                                </a>
                                                <a target="_blank" class="btn btn-lg btn-circle btn-outline-primary mr-5 mb-5"
                                                   href="https://twitter.com/intent/tweet?text={{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                                               href="{{ route('landing.feed').'?id='.encrypt($feed->id_feed) }}">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                @elseif($feed->draft_feed == 2)
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn btn-sm btn-hero btn-noborder btn-primary btn-block" href="{{ route('reqfeed.form').'?id='.encrypt($feed->id_feed) }}">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="_csrf" value="{{ @csrf_token() }}">
                    <input type="hidden" id="_offset_now">
                    <input type="hidden" id="_limit_db" value="6">
                    <button type="button" id="btn_append_reqfeed" class="btn btn-block btn-alt-primary min-width-125"
                            data-toggle="click-ripple">
                        Lihat Lagi..
                    </button>
                </div>
            </div>
        @elseif($data->isEmpty())
            <div class="my-50 text-center">
                <h3 class="h5 text-muted mb-0">
                    <i class="si si-exclamation"></i> Data kosong...
                </h3>
            </div>
        @endif
    </div>
@endsection

@push('script')
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v4.0"></script>
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/index.js') }}"></script>

@endpush
