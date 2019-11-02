<div class="modal fade stick-up" id="modal_thumbnail_e_feed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Set Thumbnail Feed</span></h5>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="{{ route('feed.form.img.thumbnail') }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="t_id_img_feed" name="id_img_feed" required>
                    <input type="hidden" id="t_id_feed" name="id_feed" required>
                    <input type="hidden" id="t_updated_by" name="updated_by" required>
                    <hr>
                    <div class="row clearfix">
                        <div id="t_path_img_feed" class="col-md-12"></div>
                    </div>
                    <hr>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn btn-success" type="submit"><i class="fa fa-trash"></i> Ya, saya yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
