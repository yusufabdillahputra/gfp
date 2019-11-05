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

        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="fa fa-image"></i> Form Gambar
            </h2>
        </div>

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
                <form id="dz_path_img_feed" class="dropzone" method="POST" action="{{ route('reqfeed.form.upload') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $data->id_feed }}" name="id_feed" required>
                    <div class="fallback">
                        <input name="file" type="file"/>
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

        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="si si-list"></i> Form Request
            </h2>
        </div>

        <form id="form_request_feed" action="{{ route('reqfeed.edit') }}" method="POST" role="form" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{ $data->id_feed }}" name="id_feed">
            <input type="hidden" value="{{ $session['id_users'] }}" name="updated_by">
            <input type="hidden" id="val_created_at" value="{{ $data->created_at }}">
            <input type="hidden" id="val_max_donasi_feed" name="max_donasi_feed" value="{{ $data->max_donasi_feed }}">
            <input type="hidden" id="val_min_donasi_feed" name="min_donasi_feed" value="{{ $data->min_donasi_feed }}">
            <input type="hidden" id="val_ended_at_feed" name="ended_at_feed" value="{{ $data->ended_at_feed }}">
            <input type="hidden" name="draft_feed" value="2">

            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">
                        <i class="fa fa-exclamation-triangle"></i> Perhatian
                    </h3>
                </div>
                <div class="block-content">
                    <ul>
                        <li>
                            Diharapkan untuk menyelesaikan terdahulu form gambar.
                        </li>
                        <li>
                            Apabila form gambar bekerja form deskripsi dibawah
                            apabila belum di save akan di set ke awal.
                        </li>
                        <li>
                            Apabila feed telah diposting, Form request feed akan di non-aktifkan, disarankan untuk
                            menghubungi administrator apabila donatur bermaksud untuk mengubah feed yang telah di
                            request.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <label class="col-12">Campaign</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input type="radio" class="custom-control-input"
                                       @if($data->campaign_feed == 1) checked="checked" @endif
                                       value="1" name="campaign_feed" id="tidak">
                                <label class="custom-control-label" for="tidak">Tidak</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input type="radio" class="custom-control-input"
                                       @if($data->campaign_feed == 2) checked="checked" @endif
                                       value="2" name="campaign_feed" id="ya">
                                <label class="custom-control-label" for="ya">Ya</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12">Prioritas</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input type="radio" class="custom-control-input"
                                       @if($data->prioritas_feed == 1) checked="checked" @endif
                                       value="1" name="prioritas_feed" id="reguler">
                                <label class="custom-control-label" for="reguler">Reguler</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input type="radio" class="custom-control-input"
                                       @if($data->prioritas_feed == 2) checked="checked" @endif
                                       value="2" name="prioritas_feed" id="urgent">
                                <label class="custom-control-label" for="urgent">Urgent</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input type="radio" class="custom-control-input"
                                       @if($data->prioritas_feed == 3) checked="checked" @endif
                                       value="3" name="prioritas_feed" id="longterm">
                                <label class="custom-control-label" for="longterm">Longterm</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <div class="form-group row">
                        <label class="col-12" for="src_id_label">Label</label>
                        <div class="col-lg-12">
                            <select class="js-select2 form-control" id="src_id_label" name="src_id_label[]"
                                    style="width: 100%;" data-placeholder="Pilih label.." multiple>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach($rsc_label as $key_array_label => $label)
                                    <option value="{{ $label->id_label }}">{{ $label->judul_label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="src_id_donasi">Jenis Donasi (Selain Uang)</label>
                        <div class="col-lg-12">
                            <select class="js-select2 form-control" id="src_id_donasi" name="src_id_donasi[]"
                                    style="width: 100%;" data-placeholder="Pilih label.." multiple>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach($rsc_donasi as $key_array_donasi => $donasi)
                                    <option value="{{ $donasi->id_donasi }}">{{ $donasi->nama_donasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content block-content-full">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-12" for="judul_feed">Judul</label>
                                <div class="col-md-12">
                                    <input type="text" id="judul_feed" class="form-control"
                                           value="{{ $data->judul_feed }}" name="judul_feed" placeholder="...."
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-12" for="raw_ended_at_feed">Tgl Berakhir</label>
                                <div class="col-md-12">
                                    <input type="text" id="raw_ended_at_feed" class="form-control"
                                           value="{{ date_format(date_create($data->ended_at_feed), 'd/m/Y') }}"
                                           placeholder="DD/MM/YYYY" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="sub_judul_feed">Sub Judul</label>
                        <div class="col-md-12">
                        <input type="text" id="sub_judul_feed" class="form-control" value="{{ $data->sub_judul_feed }}"
                               name="sub_judul_feed" placeholder=".......">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="alamat_feed">Alamat</label>
                                <div class="col-md-12">
                                    <input type="text" id="alamat_feed" class="form-control"
                                           value="{{ $data->alamat_feed }}"
                                           name="alamat_feed" placeholder="......." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="kecamatan_feed">Kecamatan</label>
                                <div class="col-md-12">
                                    <input type="text" id="kecamatan_feed" class="form-control"
                                           value="{{ $data->kecamatan_feed }}"
                                           name="kecamatan_feed" placeholder=".......">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="kota_feed">Kabupaten / Kota</label>
                                <div class="col-md-12">
                                    <input type="text" id="kota_feed" class="form-control"
                                           value="{{ $data->kota_feed }}"
                                           name="kota_feed" placeholder="......." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="provinsi_feed">Provinsi</label>
                                <div class="col-md-12">
                                    <input type="text" id="provinsi_feed" class="form-control"
                                           value="{{ $data->provinsi_feed }}"
                                           name="provinsi_feed" placeholder="......." required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="raw_min_donasi_feed">Minimal Donasi (Rp.)</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control autonumeric"
                                           value="{{ $data->min_donasi_feed }}"
                                           id="raw_min_donasi_feed" name="raw_min_donasi_feed"
                                           placeholder="000.000.000,-" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="raw_max_donasi_feed">Maksimal Donasi (Rp.)</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control autonumeric"
                                           value="{{ $data->max_donasi_feed }}"
                                           id="raw_max_donasi_feed" name="raw_max_donasi_feed"
                                           placeholder="000.000.000,-">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="talent_feed">Nama Talent</label>
                                <div class="col-md-12">
                                    <input type="text" id="talent_feed" class="form-control"
                                           value="{{ $data->talent_feed }}"
                                           name="talent_feed" placeholder="......." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-12" for="telp_talent_feed">No. Telp Talent</label>
                                <div class="col-md-12">
                                    <input type="text" id="telp_talent_feed" class="form-control"
                                           value="{{ $data->telp_talent_feed }}"
                                           name="telp_talent_feed" placeholder="08xx-xxxx-xxxx" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="email_talent_feed">Email Talent</label>
                        <div class="col-md-12">
                            <input type="email" id="email_talent_feed" class="form-control"
                                   value="{{ $data->email_talent_feed }}"
                                   name="email_talent_feed" placeholder=".......">
                        </div>
                    </div>

                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">
                        Deskripsi
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <textarea name="isi_feed" id="isi_feed">{{ $data->isi_feed }}</textarea>
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">
                        Keterangan
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <textarea name="keterangan_feed" id="keterangan_feed">{{ $data->keterangan_feed }}</textarea>
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
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/form.js') }}"></script>
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
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landing/reqfeed/dropzone_reqfeed.js') }}"></script>

@endpush
