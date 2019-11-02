@extends('landing.global.index')

@section('title')
    Profile
@endsection

@section('modal')
    {{ view('landing.profile.modal.foto', ['id_users' => $data->id_users]) }}
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
                            <a href="{{ route('dompet.topup.index') }}" class="btn btn-circle btn-outline-success pull-left">
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

        <div class="block block-transparent">
            <div class="row">
                <div class="col-md-3">
                    <div class="block block-transparent">
                        <div class="block-header">
                            <h4><i class="si si-user"></i> Foto Profile</h4>
                        </div>
                        <div class="block-content p-0 overflow-hidden">
                            <center>
                                <a class="img-link" data-toggle="modal" href="#modal_upload_profile">
                                    <img width="200px" src="{{ $foto_users }}" class="img-fluid rounded-top"
                                         alt="Foto Profile">
                                </a>
                                <hr>
                                <a href="#modal_upload_profile" data-toggle="modal"
                                   class="btn btn-rounded btn-outline-secondary min-width-125 mb-10">Ubah Foto</a>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="js-validation-bootstrap" method="POST" id="form_edit" action="{{ route('frontend.profile.edit.post') }}" role="form"
                          autocomplete="off">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{ $data->id_users }}" name="rsc[id_users]">
                        <input type="hidden" value="{{ $data->password_users }}" name="rsc[password_users]">
                        <input type="hidden" value="{{ $data->akses_users }}" name="rsc[akses_users]">
                        <input type="hidden" value="{{ $session['id_users'] }}" name="rsc[updated_by]">
                        <input type="hidden" value="{{ $data->id_root }}" name="dtl[id_root]">
                        <input type="hidden" value="{{ $session['id_users'] }}" name="dtl[updated_by]">

                        <div class="block block-rounded">
                            <div class="block-header">
                                <h4><i class="fa fa-wpforms"></i> Deskripsi</h4>
                            </div>
                            <div class="block-content p-0 overflow-hidden border-bottom">
                                <div class="form-group">
                                    <label class="col-12">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $data->nama_users }}" name="rsc[nama_users]" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-12">Username</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $data->username_users }}" name="rsc[username_users]" placeholder="...." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control" value="{{ $data->email_users }}" name="rsc[email_users]" placeholder="......." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-12">Jenis Kelamin</label>
                                    <div class="col-12">
                                        <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="rsc[jenis_kelamin_users]" id="male" value="1" @if($data->jenis_kelamin_users == 1) checked @endif>
                                            <label class="custom-control-label" for="male">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="rsc[jenis_kelamin_users]" id="female" value="2" @if($data->jenis_kelamin_users == 2) checked @endif>
                                            <label class="custom-control-label" for="female">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Alamat</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="dtl[alamat_root]" required>{{ $data->alamat_root }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Kecamatan</label>
                                            <div class="col-md-12">
                                            <input type="text" class="form-control" value="{{ $data->kecamatan_root }}" name="dtl[kecamatan_root]" placeholder=".......">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Kota / Kabupaten</label>
                                            <div class="col-md-12">
                                            <input type="text" class="form-control" value="{{ $data->kota_root }}" name="dtl[kota_root]" placeholder=".......">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Provinsi</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" value="{{ $data->provinsi_root }}" name="dtl[provinsi_root]" placeholder=".......">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" value="{{ $data->bank_root }}" name="dtl[bank_root]" placeholder=".......">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-12">Rekening Atas Nama</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" value="{{ $data->nm_rek_root }}" name="dtl[nm_rek_root]" placeholder=".......">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-12">No. Rekening</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="{{ $data->rekening_root }}" name="dtl[rekening_root]" placeholder=".......">
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-hero btn-noborder btn-primary btn-block"
                                                type="submit">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/landing/profile/dropzone_profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/landing/profile/form_edit_profile.js') }}" type="text/javascript"></script>

@endpush
