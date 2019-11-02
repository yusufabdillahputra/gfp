@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Edit Sub Konten
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.konten.edit_modal.delete') }}
    {{ view('admin.konten.edit_modal.thumbnail') }}

@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="card card-transparent">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-10">
                        <h3>"{{ $data->judul_subk }}"</h3>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('konten.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
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
                            <button type="button" id="btn_submit_img" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                        </span>
                    </div>
                    <div class="card-block no-scroll no-padding">
                        <style>
                            .dropzone {
                                height: 250px;
                                min-height: 0px !important;
                            }
                        </style>
                        <form id="my-awesome-dropzone" method="POST" enctype="multipart/form-data" action="{{ route('konten.sub.upload') }}" class="dropzone no-margin">
                            @csrf
                            <input type="hidden" value="{{ $data->id_subk }}" name="id_subk" required>
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
                                                             src="{{ Storage::url($img->path_img_subk) }}">
                                                    </td>
                                                    <td class="v-align-middle text-center">
                                                        <div class="btn-group-xs">
                                                            <a href="#modal_delete_e_subk"
                                                               data-d_path_img_subk="{{ Storage::url($img->path_img_subk) }}"
                                                               data-d_id_img_subk="{{ $img->id_img_subk }}" data-toggle="modal" class="modal_delete_e_subk btn btn-danger mt-1"><i class="fa fa-trash"></i> Hapus</a>
                                                            @if($img->thumbnail_img_subk == 1)
                                                                @php
                                                                    $btn_class = 'btn btn-success mt-1';
                                                                    $icon_class = 'fa fa-check';
                                                                @endphp
                                                            @elseif($img->thumbnail_img_subk == 0)
                                                                @php
                                                                    $btn_class = 'btn btn-default mt-1';
                                                                    $icon_class = 'fa fa-times';
                                                                @endphp
                                                            @endif
                                                            <a href="#modal_thumbnail_e_subk"
                                                               data-t_id_subk="{{ $img->id_subk }}"
                                                               data-t_updated_by="{{ $session['id_users'] }}"
                                                               data-t_path_img_subk="{{ Storage::url($img->path_img_subk) }}"
                                                               data-t_id_img_subk="{{ $img->id_img_subk }}" data-toggle="modal" class="modal_thumbnail_e_subk {{ $btn_class }}"><i class="{{ $icon_class }}"></i> Thumbnail</a>
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
                <form action="{{ route('konten.sub.update') }}" method="POST" class="form-horizontal" role="form" autocomplete="off">
                    @csrf
                    <input type="hidden" value="{{ $data->id_subk }}" name="dtl[id_subk]">
                    <input type="hidden" value="{{ $session['id_users'] }}" name="dtl[updated_by]">
                    <p class="hint-text text-warning-dark">
                        <i class="fa fa-info-circle"></i> Diharapkan untuk menyelesaikan terdahulu form gambar.
                        <br><i class="fa fa-exclamation-circle"></i> Apabila form gambar bekerja form deskripsi dibawah apabila belum di save akan di set ke awal.
                    </p>
                    <div class="form-group row">
                        <label class="col-md-3 control-label">Posisi Sub Konten</label>
                        <div class="col-md-9">
                            <div class="radio radio-success">
                                <input type="radio"
                                       @if($data->posisi_subk == 0) checked="checked" @endif
                                       value="0" name="dtl[posisi_subk]" id="disable">
                                <label for="disable">Jangan Tampilkan</label>

                                <input type="radio"
                                       @if($data->posisi_subk == 1) checked="checked" @endif
                                       value="1" name="dtl[posisi_subk]" id="header">
                                <label for="header">Header</label>

                                <input type="radio"
                                       @if($data->posisi_subk == 2) checked="checked" @endif
                                       value="2" name="dtl[posisi_subk]" id="footer">
                                <label for="footer">Footer</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label">Broadcast</label>
                        <div class="col-md-9">
                            <div class="radio radio-success">
                                <input type="radio"
                                       @if($data->broadcast_subk == 0) checked="checked" @endif
                                       value="0" name="dtl[broadcast_subk]" id="tidak">
                                <label for="tidak">Tidak</label>

                                <input type="radio"
                                       @if($data->broadcast_subk == 1) checked="checked" @endif
                                       value="1" name="dtl[broadcast_subk]" id="ya">
                                <label for="ya">Ya</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group form-group-default form-group-default-select2">
                        <label>Label</label>
                        <select name="src_id_label[]" class="full-width" id="src_id_label" multiple>
                            @foreach($rsc_label as $key_array => $label)
                                <option value="{{ $label->id_label }}">{{ $label->judul_label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group form-group-default">
                        <label>Judul Sub Konten</label>
                        <input type="text" class="form-control" name="dtl[judul_subk]" value="{{ $data->judul_subk }}" required placeholder=".....">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <div class="summernote-wrapper">
                            <textarea name="dtl[isi_subk]" id="isi_subk">{{ $data->isi_subk }}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-9">
                            <p class="text-warning-dark"><i class="fa fa-info-circle"></i> Sebelum menekan tombol submit
                                alangkah baiknya di cek terdahulu form sub konten kembali <i class="fa fa-smile-o"></i>.
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
    <script src="{{ asset('js/admin/konten/edit/form_edit.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/konten/edit/modal_edit.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#src_id_label').select2();
            @isset($src_label)
            $('#src_id_label').val([{{ $src_label }}]);
            $('#src_id_label').trigger('change');
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
