@extends('admin.global.index')

@section('breadcrumbs')
    {{ $breadcrumbs }}
@endsection

@section('title')
    Profile | Edit
@endsection

@section('foto_header_users')
    <img src="{{ $foto_users }}" alt="" data-src="{{ $foto_users }}"
         data-src-retina="{{ $foto_users }}" width="32" height="32">
@endsection

@section('modal')
    {{ view('admin.global.partials.modal.password', ['data' => $session]) }}
    {{ view('admin.users.profile.modal.foto', ['id_users' => $data->id_users]) }}
@endsection

@section('content')
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
    <div class=" container-fluid container-fixed-md bg-white">
        <div class="row">
            <div class="col-md-4">
                <!-- START card -->
                <div class="row my-md-2">
                    <div class="col-md-12">
                        <a href="{{ route('users.index') }}" class="btn btn-warning btn-cons btn-block btn-animated from-left fa fa-arrow-left mt-2"><span>Kembali</span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default mt-2">
                            <div class="card-header">
                                <div class="card-title">
                                    Foto Profile
                                </div>
                            </div>
                            <div class="card-block">
                                <img src="{{ $foto_users }}"
                                     class="img-fluid rounded mx-auto d-block"
                                     alt="Profile Picture">
                                <hr>
                                <div class="pull-right">
                                    <a href="#modal_upload_profile" data-toggle="modal" class="btn btn-primary">Ubah Foto</a>
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
                        <form method="POST" id="form_edit" action="{{ route('users.profile.edit.post') }}"
                              role="form" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="{{ $data->id_users }}" name="rsc[id_users]">
                            <input type="hidden" value="{{ $data->password_users }}" name="rsc[password_users]">
                            <input type="hidden" value="{{ $data->akses_users }}" name="rsc[akses_users]">
                            <input type="hidden" value="{{ $session['id_users'] }}" name="rsc[updated_by]">
                            <input type="hidden" value="{{ $data->id_root }}" name="dtl[id_root]">
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
                                        <textarea class="form-control" name="dtl[alamat_root]"
                                                  required>{{ $data->alamat_root }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Kecamatan</label>
                                        <input type="text" class="form-control" value="{{ $data->kecamatan_root }}"
                                               name="dtl[kecamatan_root]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Kota / Kabupaten</label>
                                        <input type="text" class="form-control" value="{{ $data->kota_root }}"
                                               name="dtl[kota_root]" placeholder=".......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Provinsi</label>
                                        <input type="text" class="form-control" value="{{ $data->provinsi_root }}"
                                               name="dtl[provinsi_root]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Bank</label>
                                        <input type="text" class="form-control" value="{{ $data->bank_root }}"
                                               name="dtl[bank_root]" placeholder=".......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Rekening Atas Nama</label>
                                        <input type="text" class="form-control" value="{{ $data->nm_rek_root }}"
                                               name="dtl[nm_rek_root]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>No. Rekening</label>
                                        <input type="text" class="form-control" value="{{ $data->rekening_root }}"
                                               name="dtl[rekening_root]" placeholder=".......">
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
@endsection

@push('content_js')
    <script src="{{ asset('js/admin/users/profile/dropzone_profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/users/profile/form_edit_profile.js') }}" type="text/javascript"></script>

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
