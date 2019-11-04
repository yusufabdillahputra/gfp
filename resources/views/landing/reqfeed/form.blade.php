@extends('landing.global.index')

@section('title')
    Request Feed
@endsection

@section('modal')
    {{ view('landing.reqfeed.modal.delete') }}
    {{ view('landing.reqfeed.modal.thumbnail') }}
@endsection

@section('content')
    <div class="content content-full">
        @isset($session['id_users'])
            <div class="row">
                <div class="col-2 col-xs-2">
                    <a href="{{ route('reqfeed.index') }}"
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
            <div class="block-header">
                <h3 class="block-title">
                    <i class="fa fa-image"></i> Upload Gambar
                </h3>
                <span class="pull-right">
                    <button type="button" id="btn_submit_img" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                </span>
            </div>
            <div class="block-content block-content-full">
                <form id="dz_path_img_feed" class="dropzone" method="POST" action="{{ route('reqfeed.form.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $data->id_feed }}" name="id_feed" required>
                    <div class="fallback">
                        <input name="file" type="file" />
                    </div>
                </form>
            </div>
            <div class="block-content border-bottom">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        @foreach ($gambar as $key_array => $img)
                            <tr>
                                <td class="text-center">
                                    <img width="100px" class="img-fluid"
                                         src="{{ Storage::url($img->path_img_feed) }}">
                                </td>
                                <td class="text-center">
                                    <div class="btn-group-xs">
                                        <a href="#modal_delete_e_feed"
                                           data-d_path_img_feed="{{ Storage::url($img->path_img_feed) }}"
                                           data-d_id_img_feed="{{ $img->id_img_feed }}"
                                           data-toggle="modal"
                                           class="modal_delete_e_feed btn btn-danger mt-1"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                        @if($img->thumbnail_img_feed == 1)
                                            @php
                                                $btn_class = 'btn btn-success mt-1';
                                                $icon_class = 'fa fa-check';
                                            @endphp
                                        @elseif($img->thumbnail_img_feed == 0)
                                            @php
                                                $btn_class = 'btn btn-alt-success mt-1';
                                                $icon_class = 'fa fa-times';
                                            @endphp
                                        @endif
                                        <a href="#modal_thumbnail_e_feed"
                                           data-t_id_feed="{{ $img->id_feed }}"
                                           data-t_updated_by="{{ $session['id_users'] }}"
                                           data-t_path_img_feed="{{ Storage::url($img->path_img_feed) }}"
                                           data-t_id_img_feed="{{ $img->id_img_feed }}"
                                           data-toggle="modal"
                                           class="modal_thumbnail_e_feed {{ $btn_class }}"><i
                                                class="{{ $icon_class }}"></i> Thumbnail</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">
                    <i class="si si-list"></i> Upload Gambar
                </h3>
            </div>
            <div class="block-content block-content-full">

            </div>
        </div>

    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/dropzone_reqfeed.js') }}"></script>

@endpush
