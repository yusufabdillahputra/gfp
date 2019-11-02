@if(!$rsc_payment->isEmpty())
    <div class="form-group animated fadeIn">
        <label for="id_payment">Bank</label>
        <select class="form-control" id="id_payment" name="id_payment" style="width: 100%;">
            <option selected>Pilih Bank</option>
            @foreach($rsc_payment as $key_array => $payment)
                <option value="{{ $payment->id_payment }}">{{ $payment->nama_bank_payment }}</option>
            @endforeach
        </select>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict'

            $('#id_payment').on('change', function () {
                var get_saldo_transaksi = $('#saldo_transaksi').autoNumeric('get');
                $('#saldo_transaksi').autoNumeric('destroy');
                $.ajax({
                    url: 'ajax/getStepPayment',
                    method: 'POST',
                    data: {
                        '_token': $('#_csrf').val(),
                        'id_payment': $('#id_payment').val(),
                        'saldo_transaksi': get_saldo_transaksi
                    },
                    success: function (parsing_data) {
                        $('#AJAX_StepPayment').html(parsing_data);
                    }
                });
                $('#id_payment').prop('disabled', true);
                $('#jenis_payment').prop('disabled', true);
                $('#saldo_transaksi').prop('disabled', true);
            });
        });
    </script>
@elseif($rsc_payment->isEmpty())
    <div class="block block-rounded bg-light animated fadeIn">
        <div class="block-header">
            <p>
                Maaf untuk jenis ini belum tersedia <i class="si si-emoticon-smile"></i><br>
                Silahkan hubungi ketersediaan dengan Customer Service
            </p>
        </div>
    </div>
@endif
