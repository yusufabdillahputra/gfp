<div class="modal fade slide-right" id="modal_logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="pg-close fs-14"></i>
                </button>
                <div class="container-xs-height full-height">
                    <div class="row-xs-height">
                        <div class="modal-body col-xs-height col-middle text-center   ">
                            <h4>
                                Apa anda yakin keluar dari sistem ?
                            </h4>
                            <br>
                            <div class="btn-group btn-group-md">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Tidak <i class="fa fa-times"></i>
                                </button>
                            <a href="{{ route('otentikasi.logout') }}" class="btn btn-danger">
                                    Ya, saya yakin <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>