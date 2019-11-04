@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Donatur | Edit
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.users.donatur.modal.foto', ['id_users' => $data->id_users]) }}
@endsection

@section('content')
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="row">
            <div class="col-md-4">
                <!-- START card -->
                <div class="row my-md-2">
                    <div class="col-md-12">
                        <a href="{{ route('users.donatur.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    Foto Profile
                                </div>
                            </div>
                            <div class="card-block">
                                <img src="{{ Storage::url($data->foto_users) }}"
                                     class="img-fluid rounded mx-auto d-block"
                                     alt="Profile Picture">
                                <hr>
                                <div class="pull-right">
                                    <a href="#modal_upload_donatur" data-toggle="modal" class="btn btn-primary">Ubah Foto</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <div class="col-md-8">
                <!-- START card -->
                <div class="card card-transparent">
                    <div class="card-block">
                        <form method="POST" id="form_edit" action="{{ route('users.donatur.edit.post') }}"
                              role="form" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="{{ $data->id_users }}" name="rsc[id_users]">
                            <input type="hidden" value="{{ $data->password_users }}" name="rsc[password_users]">
                            <input type="hidden" value="{{ $data->akses_users }}" name="rsc[akses_users]">
                            <input type="hidden" value="{{ $session['id_users'] }}" name="rsc[updated_by]">
                            <input type="hidden" value="{{ $data->id_donatur }}" name="dtl[id_donatur]">
                            <input type="hidden" value="{{ $session['id_users'] }}" name="dtl[updated_by]">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $data->nama_users }}"
                                               name="rsc[nama_users]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="{{ $data->username_users }}"
                                               name="rsc[username_users]" placeholder="...." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{ $data->email_users }}"
                                               name="rsc[email_users]" placeholder="......." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default required">
                                        <label>Telp. / Hp</label>
                                        <input type="text" class="form-control" value="{{ $data->telp_users }}"
                                               name="rsc[telp_users]" placeholder="0000-0000-0000" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Jenis Kelamin</label>
                                <div class="col-md-9">
                                    <div class="radio radio-success">
                                        <input
                                            @if($data->jenis_kelamin_users == 1)
                                            checked="checked"
                                            @endif
                                            type="radio" value="1" name="rsc[jenis_kelamin_users]" id="male">
                                        <label for="male">Laki-Laki</label>
                                        <input
                                            @if($data->jenis_kelamin_users == 2)
                                            checked="checked"
                                            @endif
                                            type="radio" value="2" name="rsc[jenis_kelamin_users]" id="female">
                                        <label for="female">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="dtl[alamat_donatur]"
                                                  required>{{ $data->alamat_donatur }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" value="{{ $data->kecamatan_donatur }}"
                                               name="dtl[kecamatan_donatur]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Kota / Kabupaten</label>
                                        <input type="text" class="form-control" value="{{ $data->kota_donatur }}"
                                               name="dtl[kota_donatur]" placeholder=".......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Provinsi</label>
                                        <input type="text" class="form-control" value="{{ $data->provinsi_donatur }}"
                                               name="dtl[provinsi_donatur]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Bank</label>
                                        <input type="text" class="form-control" value="{{ $data->bank_donatur }}"
                                               name="dtl[bank_donatur]" placeholder=".......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Rekening Atas Nama</label>
                                        <input type="text" class="form-control" value="{{ $data->nm_rek_donatur }}"
                                               name="dtl[nm_rek_donatur]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>No. Rekening</label>
                                        <input type="text" class="form-control" value="{{ $data->rekening_donatur }}"
                                               name="dtl[rekening_donatur]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- END card -->
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="container-fluid container-fixed-md bg-white">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="container-fluid container-fixed-md">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-transparent">
                    <div class="card-header ">
                        <div class="card-title">
                            <h5>Aturan Akses Pengguna</h5>
                        </div>
                    </div>
                    <div class="card-block">
                        <hr>
                        <form action="{{ route('users.rule.update') }}" method="POST" class="form-horizontal" role="form" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $data->id_users }}" name="id_users">
                            <input type="hidden" value="{{ $session['id_users'] }}" name="updated_by">

                            {{-- START Request Feed --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Request Feed (Landing)</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="reqfeed_read"
                                                       @if($rules->reqfeed->read == 1) checked="checked" @endif
                                                       value="1" id="reqfeed_read_true">
                                                <label for="reqfeed_read_true">Ya</label>

                                                <input type="radio" name="reqfeed_read"
                                                       @if($rules->reqfeed->read == 0) checked="checked" @endif
                                                       value="0" id="reqfeed_read_false">
                                                <label for="reqfeed_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END Request Feed --}}

                            {{-- START landing --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Landing</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="landing_read"
                                                       @if($rules->landing->read == 1) checked="checked" @endif
                                                       value="1" id="landing_read_true">
                                                <label for="landing_read_true">Ya</label>

                                                <input type="radio" name="landing_read"
                                                       @if($rules->landing->read == 0) checked="checked" @endif
                                                       value="0" id="landing_read_false">
                                                <label for="landing_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END Landing --}}

                            {{-- START backend --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Backend</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="backend_read"
                                                       @if($rules->backend->read == 1) checked="checked" @endif
                                                       value="1" id="backend_read_true">
                                                <label for="backend_read_true">Ya</label>

                                                <input type="radio" name="backend_read"
                                                       @if($rules->backend->read == 0) checked="checked" @endif
                                                       value="0" id="backend_read_false">
                                                <label for="backend_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END backend --}}

                            {{-- START dashboard --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Dashboard (Home Backend)</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="dashboard_read"
                                                       @if($rules->dashboard->read == 1) checked="checked" @endif
                                                       value="1" id="dashboard_read_true">
                                                <label for="dashboard_read_true">Ya</label>

                                                <input type="radio" name="dashboard_read"
                                                       @if($rules->dashboard->read == 0) checked="checked" @endif
                                                       value="0" id="dashboard_read_false">
                                                <label for="dashboard_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END dashboard --}}

                            {{-- START transaksi --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Transaksi</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-warning-dark"><i class="fa fa-exclamation-triangle"></i> &nbsp;Apabila status "Tidak" maka konten <b><u>Top Up</u>, <u>Donasi</u> dan <u>Penarikan Dana</u> tidak bisa diakses (403 | Forbidden)</b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="transaksi_read"
                                                       @if($rules->transaksi->read == 1) checked="checked" @endif
                                                       value="1" id="transaksi_read_true">
                                                <label for="transaksi_read_true">Ya</label>

                                                <input type="radio" name="transaksi_read"
                                                       @if($rules->transaksi->read == 0) checked="checked" @endif
                                                       value="0" id="transaksi_read_false">
                                                <label for="transaksi_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END transaksi --}}

                            {{-- START transaksi -> topup --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Top Up</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-complete"><i class="fa fa-info-circle"></i> &nbsp;Sub proses dari <b><u>Transaksi</u></b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="transaksi_topup_read"
                                                       @if($rules->transaksi->topup->read == 1) checked="checked" @endif
                                                       value="1" id="transaksi_topup_read_true">
                                                <label for="transaksi_topup_read_true">Ya</label>

                                                <input type="radio" name="transaksi_topup_read"
                                                       @if($rules->transaksi->topup->read == 0) checked="checked" @endif
                                                       value="0" id="transaksi_topup_read_false">
                                                <label for="transaksi_topup_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END transaksi -> topup --}}

                            {{-- START transaksi -> tarik --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Penarikan Dana</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-complete"><i class="fa fa-info-circle"></i> &nbsp;Sub proses dari <b><u>Transaksi</u></b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="transaksi_tarik_read"
                                                       @if($rules->transaksi->tarik->read == 1) checked="checked" @endif
                                                       value="1" id="transaksi_tarik_read_true">
                                                <label for="transaksi_tarik_read_true">Ya</label>

                                                <input type="radio" name="transaksi_tarik_read"
                                                       @if($rules->transaksi->tarik->read == 0) checked="checked" @endif
                                                       value="0" id="transaksi_tarik_read_false">
                                                <label for="transaksi_tarik_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END transaksi -> tarik --}}

                            {{-- START transaksi -> donasi --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Donasi Uang</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-complete"><i class="fa fa-info-circle"></i> &nbsp;Sub proses dari <b><u>Transaksi</u></b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="transaksi_donasi_read"
                                                       @if($rules->transaksi->donasi->read == 1) checked="checked" @endif
                                                       value="1" id="transaksi_donasi_read_true">
                                                <label for="transaksi_donasi_read_true">Ya</label>

                                                <input type="radio" name="transaksi_donasi_read"
                                                       @if($rules->transaksi->donasi->read == 0) checked="checked" @endif
                                                       value="0" id="transaksi_donasi_read_false">
                                                <label for="transaksi_donasi_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END transaksi -> donasi --}}

                            {{-- START transaksi -> kebutuhan --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Kebutuhan</label>
                                <div class="col-md-9">
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-complete"><i class="fa fa-info-circle"></i> &nbsp;Sub proses dari <b><u>Transaksi</u></b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="transaksi_kebutuhan_read"
                                                       @if($rules->transaksi->kebutuhan->read == 1) checked="checked" @endif
                                                       value="1" id="transaksi_kebutuhan_read_true">
                                                <label for="transaksi_kebutuhan_read_true">Ya</label>

                                                <input type="radio" name="transaksi_kebutuhan_read"
                                                       @if($rules->transaksi->kebutuhan->read == 0) checked="checked" @endif
                                                       value="0" id="transaksi_kebutuhan_read_false">
                                                <label for="transaksi_kebutuhan_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END transaksi -> kebutuhan --}}

                            {{-- START feed --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Feed</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="feed_create"
                                                       @if($rules->feed->create == 1) checked="checked" @endif
                                                       value="1" id="feed_create_true">
                                                <label for="feed_create_true">Ya</label>

                                                <input type="radio" name="feed_create"
                                                       @if($rules->feed->create == 0) checked="checked" @endif
                                                       value="0" id="feed_create_false">
                                                <label for="feed_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="feed_read"
                                                       @if($rules->feed->read == 1) checked="checked" @endif
                                                       value="1" id="feed_read_true">
                                                <label for="feed_read_true">Ya</label>

                                                <input type="radio" name="feed_read"
                                                       @if($rules->feed->read == 0) checked="checked" @endif
                                                       value="0" id="feed_read_false">
                                                <label for="feed_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="feed_update"
                                                       @if($rules->feed->update == 1) checked="checked" @endif
                                                       value="1" id="feed_update_true">
                                                <label for="feed_update_true">Ya</label>

                                                <input type="radio" name="feed_update"
                                                       @if($rules->feed->update == 0) checked="checked" @endif
                                                       value="0" id="feed_update_false">
                                                <label for="feed_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="feed_delete"
                                                       @if($rules->feed->delete == 1) checked="checked" @endif
                                                       value="1" id="feed_delete_true">
                                                <label for="feed_delete_true">Ya</label>

                                                <input type="radio" name="feed_delete"
                                                       @if($rules->feed->delete == 0) checked="checked" @endif
                                                       value="0" id="feed_delete_false">
                                                <label for="feed_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END feed --}}

                            {{-- START konten --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Konten</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_create"
                                                       @if($rules->konten->create == 1) checked="checked" @endif
                                                       value="1" id="konten_create_true">
                                                <label for="konten_create_true">Ya</label>

                                                <input type="radio" name="konten_create"
                                                       @if($rules->konten->create == 0) checked="checked" @endif
                                                       value="0" id="konten_create_false">
                                                <label for="konten_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-warning-dark"><i class="fa fa-exclamation-triangle"></i> &nbsp;Apabila status "Tidak" maka konten <b><u>Sub Konten</u> tidak bisa diakses (403 | Forbidden)</b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_read"
                                                       @if($rules->konten->read == 1) checked="checked" @endif
                                                       value="1" id="konten_read_true">
                                                <label for="konten_read_true">Ya</label>

                                                <input type="radio" name="konten_read"
                                                       @if($rules->konten->read == 0) checked="checked" @endif
                                                       value="0" id="konten_read_false">
                                                <label for="konten_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_update"
                                                       @if($rules->konten->update == 1) checked="checked" @endif
                                                       value="1" id="konten_update_true">
                                                <label for="konten_update_true">Ya</label>

                                                <input type="radio" name="konten_update"
                                                       @if($rules->konten->update == 0) checked="checked" @endif
                                                       value="0" id="konten_update_false">
                                                <label for="konten_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_delete"
                                                       @if($rules->konten->delete == 1) checked="checked" @endif
                                                       value="1" id="konten_delete_true">
                                                <label for="konten_delete_true">Ya</label>

                                                <input type="radio" name="konten_delete"
                                                       @if($rules->konten->delete == 0) checked="checked" @endif
                                                       value="0" id="konten_delete_false">
                                                <label for="konten_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END konten --}}

                            {{-- START konten -> sub --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Sub Konten</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_sub_create"
                                                       @if($rules->konten->sub->create == 1) checked="checked" @endif
                                                       value="1" id="konten_sub_create_true">
                                                <label for="konten_sub_create_true">Ya</label>

                                                <input type="radio" name="konten_sub_create"
                                                       @if($rules->konten->sub->create == 0) checked="checked" @endif
                                                       value="0" id="konten_sub_create_false">
                                                <label for="konten_sub_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <p class="hint-text small text-complete"><i class="fa fa-info-circle"></i> &nbsp;Sub proses dari <b><u>Konten</u></b></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_sub_read"
                                                       @if($rules->konten->sub->read == 1) checked="checked" @endif
                                                       value="1" id="konten_sub_read_true">
                                                <label for="konten_sub_read_true">Ya</label>

                                                <input type="radio" name="konten_sub_read"
                                                       @if($rules->konten->sub->read == 0) checked="checked" @endif
                                                       value="0" id="konten_sub_read_false">
                                                <label for="konten_sub_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_sub_update"
                                                       @if($rules->konten->sub->update == 1) checked="checked" @endif
                                                       value="1" id="konten_sub_update_true">
                                                <label for="konten_sub_update_true">Ya</label>

                                                <input type="radio" name="konten_sub_update"
                                                       @if($rules->konten->sub->update == 0) checked="checked" @endif
                                                       value="0" id="konten_sub_update_false">
                                                <label for="konten_sub_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="konten_sub_delete"
                                                       @if($rules->konten->sub->delete == 1) checked="checked" @endif
                                                       value="1" id="konten_sub_delete_true">
                                                <label for="konten_sub_delete_true">Ya</label>

                                                <input type="radio" name="konten_sub_delete"
                                                       @if($rules->konten->sub->delete == 0) checked="checked" @endif
                                                       value="0" id="konten_sub_delete_false">
                                                <label for="konten_sub_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END konten -> sub --}}

                            {{-- START label --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Label</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="label_create"
                                                       @if($rules->label->create == 1) checked="checked" @endif
                                                       value="1" id="label_create_true">
                                                <label for="label_create_true">Ya</label>

                                                <input type="radio" name="label_create"
                                                       @if($rules->label->create == 0) checked="checked" @endif
                                                       value="0" id="label_create_false">
                                                <label for="label_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="label_read"
                                                       @if($rules->label->read == 1) checked="checked" @endif
                                                       value="1" id="label_read_true">
                                                <label for="label_read_true">Ya</label>

                                                <input type="radio" name="label_read"
                                                       @if($rules->label->read == 0) checked="checked" @endif
                                                       value="0" id="label_read_false">
                                                <label for="label_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="label_update"
                                                       @if($rules->label->update == 1) checked="checked" @endif
                                                       value="1" id="label_update_true">
                                                <label for="label_update_true">Ya</label>

                                                <input type="radio" name="label_update"
                                                       @if($rules->label->update == 0) checked="checked" @endif
                                                       value="0" id="label_update_false">
                                                <label for="label_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="label_delete"
                                                       @if($rules->label->delete == 1) checked="checked" @endif
                                                       value="1" id="label_delete_true">
                                                <label for="label_delete_true">Ya</label>

                                                <input type="radio" name="label_delete"
                                                       @if($rules->label->delete == 0) checked="checked" @endif
                                                       value="0" id="label_delete_false">
                                                <label for="label_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END label --}}

                            {{-- START payment --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Pembayaran</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="payment_create"
                                                       @if($rules->payment->create == 1) checked="checked" @endif
                                                       value="1" id="payment_create_true">
                                                <label for="payment_create_true">Ya</label>

                                                <input type="radio" name="payment_create"
                                                       @if($rules->payment->create == 0) checked="checked" @endif
                                                       value="0" id="payment_create_false">
                                                <label for="payment_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="payment_read"
                                                       @if($rules->payment->read == 1) checked="checked" @endif
                                                       value="1" id="payment_read_true">
                                                <label for="payment_read_true">Ya</label>

                                                <input type="radio" name="payment_read"
                                                       @if($rules->payment->read == 0) checked="checked" @endif
                                                       value="0" id="payment_read_false">
                                                <label for="payment_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="payment_update"
                                                       @if($rules->payment->update == 1) checked="checked" @endif
                                                       value="1" id="payment_update_true">
                                                <label for="payment_update_true">Ya</label>

                                                <input type="radio" name="payment_update"
                                                       @if($rules->payment->update == 0) checked="checked" @endif
                                                       value="0" id="payment_update_false">
                                                <label for="payment_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="payment_delete"
                                                       @if($rules->payment->delete == 1) checked="checked" @endif
                                                       value="1" id="payment_delete_true">
                                                <label for="payment_delete_true">Ya</label>

                                                <input type="radio" name="payment_delete"
                                                       @if($rules->payment->delete == 0) checked="checked" @endif
                                                       value="0" id="payment_delete_false">
                                                <label for="payment_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END payment --}}

                            {{-- START donasi --}}
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Donasi</label>
                                <div class="col-md-9">
                                    <p>Create</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat menambahkan isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="donasi_create"
                                                       @if($rules->donasi->create == 1) checked="checked" @endif
                                                       value="1" id="donasi_create_true">
                                                <label for="donasi_create_true">Ya</label>

                                                <input type="radio" name="donasi_create"
                                                       @if($rules->donasi->create == 0) checked="checked" @endif
                                                       value="0" id="donasi_create_false">
                                                <label for="donasi_create_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Read</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat melihat isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="donasi_read"
                                                       @if($rules->donasi->read == 1) checked="checked" @endif
                                                       value="1" id="donasi_read_true">
                                                <label for="donasi_read_true">Ya</label>

                                                <input type="radio" name="donasi_read"
                                                       @if($rules->donasi->read == 0) checked="checked" @endif
                                                       value="0" id="donasi_read_false">
                                                <label for="donasi_read_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Update</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="donasi_update"
                                                       @if($rules->donasi->update == 1) checked="checked" @endif
                                                       value="1" id="donasi_update_true">
                                                <label for="donasi_update_true">Ya</label>

                                                <input type="radio" name="donasi_update"
                                                       @if($rules->donasi->update == 0) checked="checked" @endif
                                                       value="0" id="donasi_update_false">
                                                <label for="donasi_update_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Delete</p>
                                    <p class="hint-text small">Apa anda ingin pengguna berikut ini dapat mengubah isi konten ?</p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="radio radio-success">
                                                <input type="radio" name="donasi_delete"
                                                       @if($rules->donasi->delete == 1) checked="checked" @endif
                                                       value="1" id="donasi_delete_true">
                                                <label for="donasi_delete_true">Ya</label>

                                                <input type="radio" name="donasi_delete"
                                                       @if($rules->donasi->delete == 0) checked="checked" @endif
                                                       value="0" id="donasi_delete_false">
                                                <label for="donasi_delete_false">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END donasi --}}

                            <input type="hidden" name="users_admin_read" value="{{ $rules->users->admin->read }}">
                            <input type="hidden" name="users_donatur_read" value="{{ $rules->users->donatur->read }}">

                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <p><i class="fa fa-exclamation-triangle"></i> Mohon di cek kembali form peraturannya apakah sudah setara dengan SOP yang tersedia</p>
                                </div>
                                <div class="col-md-9">
                                    <button class="btn btn-success btn-block pull-right" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/users/donatur/dropzone_donatur.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/users/donatur/form_edit_donatur.js') }}" type="text/javascript"></script>

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
