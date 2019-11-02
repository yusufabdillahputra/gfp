<!doctype html>
<html lang="en" class="no-focus">
{{ view('otentikasi.global.partials.head') }}
<body>
<div id="page-container" class="main-content-boxed">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        @yield('content')
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>

{{ view('otentikasi.global.partials.script') }}

</body>
</html>
