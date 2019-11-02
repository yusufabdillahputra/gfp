<div class="modal fade slide-front" id="modal_edit_kebutuhan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form method="POST" action="{{ route('transaksi.kebutuhan.update') }}">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="pg-close fs-14"></i>
                    </button>
                    <h5>
                        <span class="semi-bold">Edit Status Donasi Kebutuhan</span>
                        <select class="cs-select cs-skin-slide" data-init-plugin="cs-select" id="e_status_feed_donasi"
                                name="status_feed_donasi" required>
                            <option value="1">Proses</option>
                            <option value="2">Diterima</option>
                            <option value="3">Cancel</option>
                        </select>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="updated_by" value="{{ $session['id_users'] }}" required>
                    <input type="hidden" id="e_id_feed_donasi" name="id_feed_donasi" required>
                    <div class="btn-group pull-right">
                        <button type="button" data-dismiss="modal" class="btn btn-default"><i class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
