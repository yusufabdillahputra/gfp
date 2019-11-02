<div class="modal fade" id="modal_ganti_password" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="js-validation-bootstrap" method="POST" id="form_pass" action="{{ route('users.profile.edit.password') }}" role="form" autocomplete="off">
            @method('GET')
            @csrf
            <input type="hidden" name="id_users" value="{{ $data['id_users'] }}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Ganti Password</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label class="col-12">Password Lama</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="......." id="users_password_lama" name="users_password_lama" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-12">Password Baru</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="users_password_baru" name="users_password_baru" placeholder="......." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-12">Ketik Kembali Password Baru</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="users_password_baru_re" placeholder="......." required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
