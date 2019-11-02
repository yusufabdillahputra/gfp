<div class="modal fade stick-up" id="modal_delete_feed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Hapus Feed</span></h5>
                <p>Apa anda yakin untuk menghapus selamanya feed berikut ?</p>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="{{ route('feed.delete') }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" id="d_id_feed" name="id_feed" required>
                    <input type="hidden" name="deleted_by" value="{{ $deleted_by }}" required>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Judul Feed</label>
                                <input type="text" id="d_judul_feed" readonly class="form-control text-black" name="judul_feed" required>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button id="submit_button" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Ya, saya yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
