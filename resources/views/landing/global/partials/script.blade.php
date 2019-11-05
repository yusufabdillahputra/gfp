<script src="{{ asset('template/landing/js/codebase.app.js') }}"></script>
<script src="{{ asset('template/landing/js/laravel.app.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/dropzonejs/dropzone.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('template/landing/js/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- BEGIN AUTONUMERIC JS -->
<script type="text/javascript" src="{{ asset('template/admin/assets/plugins/jquery-autonumeric/autoNumeric.js') }}"></script>
<!-- END AUTONUMERIC JS -->

<script src="{{ asset('template/landing/js/pages/be_ui_animations.min.js') }}"></script>
@stack('script')

<script src="{{ asset('js/partials/dateFormat.min.js') }}" type="text/javascript"></script>
@isset($session['id_users'])
    <script src="{{ asset('js/partials/form_password.js') }}" type="text/javascript"></script>
@endisset

@if ($message = Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                type: 'success',
                title: 'Proses berhasil'
            });
        });
    </script>
@elseif($message = Session::get('error'))
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                type: 'error',
                title: 'Proses gagal'
            });
        });
    </script>
@endif
