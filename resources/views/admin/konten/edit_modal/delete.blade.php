<div class="modal fade stick-up" id="modal_delete_e_subk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Hapus Gambar Sub Konten</span></h5>
                <p>Apa anda yakin untuk menghapus selamanya gambar sub konten berikut ?</p>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="{{ route('konten.sub.img.delete') }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" id="d_id_img_subk" name="id_img_subk" required>
                    <hr>
                    <div class="row clearfix">
                        <div id="d_path_img_subk" class="col-md-12"></div>
                    </div>
                    <hr>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Ya, saya yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
