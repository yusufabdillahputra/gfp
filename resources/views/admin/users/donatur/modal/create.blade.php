<div class="modal fade slide-right" id="modal_create_donatur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="pg-close fs-14"></i>
                </button>
                <div class="container-xs-height full-height">
                    <div class="row-xs-height">
                        <div class="modal-body col-xs-height col-middle">
                            <div class=" container-fluid container-fixed-md">
                                <form method="POST" id="form_create" action="{{ route('users.donatur.create.post') }}"
                                      role="form" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="rsc[password_users]" value="{{ env('DEFAULT_PASSWORD') }}">
                                    <input type="hidden" name="rsc[akses_users]" value="{{ env('AKSES_DONATUR') }}">
                                    <input type="hidden" name="rsc[created_by]" value="{{ $created_by }}">
                                    <div class="row clearfix mx-auto">
                                        <h3>Buat Donatur Baru</h3>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" name="rsc[nama_users]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="rsc[username_users]" placeholder="...." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="rsc[email_users]" placeholder="......." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label">Jenis Kelamin</label>
                                        <div class="col-md-8">
                                            <div class="radio radio-success">
                                                <input
                                                    checked="checked"
                                                    type="radio" value="1" name="rsc[jenis_kelamin_users]" id="male">
                                                <label for="male">Laki-Laki</label>
                                                <input
                                                    type="radio" value="2" name="rsc[jenis_kelamin_users]" id="female">
                                                <label for="female">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
