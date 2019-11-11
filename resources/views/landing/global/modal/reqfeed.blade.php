<div class="modal fade" id="modal_reqfeed" tabindex="-1" role="dialog" aria-labelledby="modal-fadein"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        @if($composers_reqfeed_status === 1)
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Permintaan Hak Akses Membuat Feed</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p class="text-warning">
                            <i class="fa fa-exclamation-triangle"></i> Permintaan akses anda sedang di proses diharapkan untuk menunggu pemberian akses.
                            <br>
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        @elseif($composers_reqfeed_status === 0)
            <form method="post" action="{{ route('frontend.request.feed') }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary">
                            <h3 class="block-title">Permintaan Hak Akses Membuat Feed</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <input type="hidden" name="id_users" value="{{ $session['id_users'] }}">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                Dengan ini anda menyatakan akan tunduk terhadap syarat dan
                                ketentuan yang berlaku
                                terhadap penggunaan fitur "Request Feed"
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-alt-primary"><i class="fa fa-check"></i> Ya</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
