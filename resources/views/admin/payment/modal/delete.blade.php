<div class="modal fade stick-up" id="modal_delete_payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                </button>
                <h5><span class="semi-bold">Hapus Jenis Pembayaran</span></h5>
                <p>Apa anda yakin untuk menghapus selamanya Jenis Pembayaran berikut ?</p>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="{{ route('payment.delete') }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" id="d_id_payment" name="id_payment" required>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Nama Bank</label>
                                <input type="text" id="d_nama_bank_payment" readonly class="form-control text-black" name="nama_bank_payment" required>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Ya, saya yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
