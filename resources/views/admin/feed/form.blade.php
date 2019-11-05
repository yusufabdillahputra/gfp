@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Edit Feed
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.feed.form.delete') }}
    {{ view('admin.feed.form.thumbnail') }}

@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="card card-transparent">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-10">
                        <h3>"{{ $data->judul_feed }}"</h3>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('feed.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                    </div>
                </div>
                <hr>
                <div class="clearfix"></div>
            </div>
            <div class="card-block no-scroll card-toolbar">
                <div class="card card-default">
                    <div class="card-header ">
                        <div class="card-title">
                            <i class="fa fa-image"></i> Upload Gambar
                        </div>
                        <span class="pull-right">
                            <button type="button" id="btn_submit_img" class="btn btn-success"><i
                                    class="fa fa-upload"></i> Upload</button>
                        </span>
                    </div>
                    <div class="card-block no-scroll no-padding">
                        <style>
                            .dropzone {
                                height: 250px;
                                min-height: 0px !important;
                            }
                        </style>
                        <form id="my-awesome-dropzone" method="POST" enctype="multipart/form-data"
                              action="{{ route('feed.form.upload') }}" class="dropzone no-margin">
                            @csrf
                            <input type="hidden" value="{{ $data->id_feed }}" name="id_feed" required>
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </form>
                    </div>
                    <div class="card-block no-scroll">
                        <form class="form-horizontal" role="form" autocomplete="off">
                            <div class="card card-transparent">
                                <div class="card-block no-padding">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach ($gambar as $key_array => $img)
                                                <tr>
                                                    <td class="v-align-middle text-center">
                                                        <img width="100px" class="img-fluid"
                                                             src="{{ Storage::url($img->path_img_feed) }}">
                                                    </td>
                                                    <td class="v-align-middle text-center">
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
                                                                    $btn_class = 'btn btn-default mt-1';
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
                        </form>
                    </div>
                </div>
                <form id="form_feed" action="{{ route('feed.edit') }}" method="POST" class="form-horizontal" role="form" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $data->id_feed }}" name="id_feed">
                    <input type="hidden" value="{{ $session['id_users'] }}" name="updated_by">
                    <input type="hidden" id="val_created_at" value="{{ $data->created_at }}">
                    <input type="hidden" id="val_max_donasi_feed" name="max_donasi_feed" value="{{ $data->max_donasi_feed }}">
                    <input type="hidden" id="val_min_donasi_feed" name="min_donasi_feed" value="{{ $data->min_donasi_feed }}">
                    <input type="hidden" id="val_ended_at_feed" name="ended_at_feed" value="{{ $data->ended_at_feed }}">
                    <textarea name="isi_feed" id="val_isi_feed" style="display: none">{{ $data->isi_feed }}</textarea>
                    <textarea name="keterangan_feed" id="val_keterangan_feed" style="display: none">{{ $data->keterangan_feed }}</textarea>

                    <p class="hint-text text-warning-dark">
                        <i class="fa fa-info-circle"></i> Diharapkan untuk menyelesaikan terdahulu form gambar.
                        <br><i class="fa fa-exclamation-circle"></i> Apabila form gambar bekerja form deskripsi dibawah
                        apabila belum di save akan di set ke awal.
                    </p>
                    <div class="card card-default bg-complete-lighter">
                        <div class="card-block">
                            {{--
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Campaign</label>
                                <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               @if($data->campaign_feed == 1) checked="checked" @endif
                                               value="1" name="campaign_feed" id="tidak">
                                        <label for="tidak">Tidak</label>

                                        <input type="radio"
                                               @if($data->campaign_feed == 2) checked="checked" @endif
                                               value="2" name="campaign_feed" id="ya">
                                        <label for="ya">Ya</label>
                                    </div>
                                </div>
                            </div>
                            --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Prioritas</label>
                                <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               @if($data->prioritas_feed == 1) checked="checked" @endif
                                               value="1" name="prioritas_feed" id="reguler">
                                        <label for="reguler">Reguler</label>

                                        <input type="radio"
                                               @if($data->prioritas_feed == 2) checked="checked" @endif
                                               value="2" name="prioritas_feed" id="urgent">
                                        <label for="urgent">Urgent</label>

                                        <input type="radio"
                                               @if($data->prioritas_feed == 3) checked="checked" @endif
                                               value="3" name="prioritas_feed" id="longterm">
                                        <label for="longterm">Longterm</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default bg-complete">
                        <div class="card-block">
                            <div class="form-group form-group-default form-group-default-select2">
                                <label>Label</label>
                                <select name="src_id_label[]" class="full-width" id="src_id_label" multiple>
                                    @foreach($rsc_label as $key_array_label => $label)
                                        <option value="{{ $label->id_label }}">{{ $label->judul_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-group-default form-group-default-select2">
                                <label>Jenis Donasi (Selain Uang)</label>
                                <select name="src_id_donasi[]" class="full-width" id="src_id_donasi" multiple>
                                    @foreach($rsc_donasi as $key_array_donasi => $donasi)
                                        <option value="{{ $donasi->id_donasi }}">{{ $donasi->nama_donasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default bg-complete-dark">
                        <div class="card-block">
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-md-8">
                                        <div class="form-group form-group-default required" data-animation="false">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" value="{{ $data->judul_feed }}"
                                                   name="judul_feed" placeholder="...." required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default required">
                                            <label>Tgl Berakhir</label>
                                            <input type="text" id="raw_ended_at_feed" class="form-control date" value="{{ date_format(date_create($data->ended_at_feed), 'd/m/Y') }}" placeholder="DD/MM/YYYY" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-default">
                                    <label>Sub Judul</label>
                                    <input type="text" class="form-control" value="{{ $data->sub_judul_feed }}"
                                           name="sub_judul_feed" placeholder=".......">
                                </div>

                            </div>
                            <br>
                            <div class="form-group-attached">

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" value="{{ $data->alamat_feed }}"
                                                   name="alamat_feed" placeholder="......." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" value="{{ $data->kecamatan_feed }}"
                                                   name="kecamatan_feed" placeholder=".......">
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Kabupaten / Kota</label>
                                            <input type="text" class="form-control" value="{{ $data->kota_feed }}"
                                                   name="kota_feed" placeholder="......." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Provinsi</label>
                                            <input type="text" class="form-control" value="{{ $data->provinsi_feed }}"
                                                   name="provinsi_feed" placeholder="......." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Minimal Donasi (Rp.)</label>
                                            <input type="text" class="form-control autonumeric" value="{{ $data->min_donasi_feed }}"
                                                   id="raw_min_donasi_feed" name="raw_min_donasi_feed" placeholder="000.000.000,-" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Maksimal Donasi (Rp.)</label>
                                            <input type="text" class="form-control autonumeric" value="{{ $data->max_donasi_feed }}"
                                                   id="raw_max_donasi_feed" name="raw_max_donasi_feed" placeholder="000.000.000,-">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-default">
                                    <label>Total Jumlah Donasi</label>
                                    <input type="text" class="form-control" readonly value="Rp. {{ number_format($data->total_uang_donasi,0,'','.') }},-" placeholder="Jumlah donasi kosong">
                                </div>
                            </div>
                            <br>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>Nama Talent</label>
                                            <input type="text" class="form-control" value="{{ $data->talent_feed }}"
                                                   name="talent_feed" placeholder="......." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default required">
                                            <label>No. Telp Talent</label>
                                            <input type="text" class="form-control" value="{{ $data->telp_talent_feed }}"
                                                   name="telp_talent_feed" placeholder="08xx-xxxx-xxxx" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-default">
                                    <label>Email Talent</label>
                                    <input type="email" class="form-control" value="{{ $data->email_talent_feed }}" name="email_talent_feed" placeholder=".......">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-block">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <div class="summernote-wrapper">
                                    <textarea id="raw_isi_feed">{{ $data->isi_feed }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <div class="summernote-wrapper">
                            <textarea id="raw_keterangan_feed">{{ $data->keterangan_feed }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default bg-complete-lighter">
                        <div class="card-block">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Draft Feed ?</label>
                                <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               @if($data->draft_feed == 1) checked="checked" @endif
                                               value="1" name="draft_feed" id="draft_true">
                                        <label for="draft_true">Tidak, Tampilkan di feed</label>

                                        <input type="radio"
                                               @if($data->draft_feed == 2) checked="checked" @endif
                                               value="2" name="draft_feed" id="draft_false">
                                        <label for="draft_false">Ya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p class="text-warning-dark"><i class="fa fa-info-circle"></i> Sebelum menekan tombol submit
                                alangkah baiknya di cek terdahulu form feed kembali <i class="fa fa-smile-o"></i>.
                            </p>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success btn-block" type="submit"><i class="fa fa-save"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/feed/form_feed.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/feed/modal_form_feed.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#src_id_label').select2();
            @isset($src_label)
            $('#src_id_label').val([{{ $src_label }}]);
            $('#src_id_label').trigger('change');
            @endisset

            $('#src_id_donasi').select2();
            @isset($src_label)
            $('#src_id_donasi').val([{{ $src_donasi }}]);
            $('#src_id_donasi').trigger('change');
            @endisset
        });
    </script>

    @if ($message = Session::get('success'))
        <script type="text/javascript">
            $(document).ready(function () {
                'use strict';
                $('.page-content-wrapper').pgNotification({
                    style: 'simple',
                    message: '{{ $message }}',
                    position: 'top-right',
                    timeout: 4000,
                    type: 'success'
                }).show();
            });
        </script>
    @elseif($message = Session::get('error'))
        <script type="text/javascript">
            $(document).ready(function () {
                'use strict';
                $('.page-content-wrapper').pgNotification({
                    style: 'simple',
                    message: '{{ $message }}',
                    position: 'top-right',
                    timeout: 4000,
                    type: 'error'
                }).show();
            });
        </script>
    @endif
@endpush
