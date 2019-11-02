<div class="modal fade slide-right" id="modal_ganti_password" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <form method="POST" id="form_pass" action="{{ route('users.profile.edit.password') }}"
                                      role="form" autocomplete="off">
                                    @method('GET')
                                    @csrf
                                    <input type="hidden" name="id_users" value="{{ $data['id_users'] }}">
                                    <div class="row clearfix mx-auto">
                                        <h3>Ganti Password</h3>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Password Lama</label>
                                                <input type="password" class="form-control" placeholder="......." id="users_password_lama" name="users_password_lama" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Password Baru</label>
                                                <input type="password" class="form-control" id="users_password_baru" name="users_password_baru" placeholder="......." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Re-type Password Baru</label>
                                                <input type="password" class="form-control" name="users_password_baru_re" placeholder="......." required>
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
