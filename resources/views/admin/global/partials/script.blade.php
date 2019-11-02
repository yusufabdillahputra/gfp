    <!-- BEGIN VENDOR JS -->
    <script src="{{ asset('template/admin/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{!! url('template/admin/assets/plugins/jquery/jquery-1.11.1.min.js') !!}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/tether/js/tether.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/bootstrap/js/bootstrap.min.j') }}s" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-bez/jquery.bez.min.js') }}"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <!-- BEGIN DATATABLE JS -->
    <script src="{{ asset('template/admin/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/admin/assets/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
    <!-- END DATATABLE JS -->

    <!-- BEGIN FORM JS -->
    <script type="text/javascript" src="{{ asset('template/admin/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/admin/assets/plugins/classie/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/admin/assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <!-- END FORM JS -->
    <!-- BEGIN DROP ZONE JS -->
    <script type="text/javascript" src="{{ asset('template/admin/assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <!-- END DROP ZONE JS -->
    <!-- BEGIN SUMMERNOTE JS -->
    <script src="{{ asset('template/admin/assets/plugins/summernote/js/summernote.min.js') }}" type="text/javascript"></script>
    <!-- END SUMMERNOTE JS -->
    <!-- END VENDOR JS -->

    <!-- BEGIN AUTONUMERIC JS -->
    <script type="text/javascript" src="{{ asset('template/admin/assets/plugins/jquery-autonumeric/autoNumeric.js') }}"></script>
    <!-- END AUTONUMERIC JS -->

    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{ asset('template/admin/pages/js/pages.js') }}" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->

    <!-- BEGIN DEV LEVEL JS -->
    @stack('content_js')

    <script src="{{ asset('js/partials/form_password.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/partials/dateFormat.min.js') }}" type="text/javascript"></script>
    <!-- END DEV LEVEL JS -->
