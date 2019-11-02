<div class="modal fade" id="modal_upload_profile" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Foto Profile</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="dz_foto_users" class="dropzone" method="POST" action="{{ route('frontend.profile.edit.upload') }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="{{ $id_users }}" name="id_users" required>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                    <br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
