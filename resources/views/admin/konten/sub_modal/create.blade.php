<div class="modal fade slide-right" id="modal_create_subk" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <form method="POST" id="form_create" action="{{ route('konten.sub.create') }}"
                                      role="form" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="created_by" value="{{ $created_by }}">
                                    <input type="hidden" name="id_konten" value="{{ $id_konten }}">
                                    <div class="row clearfix mx-auto">
                                        <h3>Buat Konten Baru</h3>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default required">
                                                <label>Judul Sub Konten</label>
                                                <input type="text" class="form-control" name="judul_subk" required>
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
