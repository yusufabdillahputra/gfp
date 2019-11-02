<div class="modal fade stick-up" id="modal_delete_konten" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Hapus Konten</span></h5>
                <p>Apa anda yakin untuk menghapus selamanya konten berikut ?</p>
                <div id="info_hapus"></div>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="{{ route('konten.delete') }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" id="d_id_konten" name="id_konten" required>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Judul Konten</label>
                                <input type="text" id="d_judul_konten" readonly class="form-control text-black" name="judul_konten" required>
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
