<div class="modal fade slide-right" id="modal_upload_payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                        class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Logo Bank</span></h5>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="card card-default">
                        <div class="card-block no-scroll no-padding">
                            <form id="my-awesome-dropzone" method="POST" action="{{ route('payment.edit.upload') }}" class="dropzone no-margin" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" value="{{ $id_payment }}" name="id_payment" required>
                                <div class="fallback">
                                    <input name="file" type="file" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
