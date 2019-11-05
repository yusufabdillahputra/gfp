<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>

    <meta name="description" content="Global Fund and Prosperity">
    <meta name="author" content="Yusuf Abdillah Putra">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="GFP">
    <meta property="og:site_name" content="GFP">
    <meta property="og:description" content="Global Fund and Prosperity">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('landing.index') }}">
    <meta property="og:image" content="{{ asset('image/sys/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('template/landing/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('template/landing/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('template/landing/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/dropzonejs/dist/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/landing/js/plugins/summernote/summernote-bs4.css') }}">

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('template/landing/css/codebase.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <link rel="stylesheet" id="css-theme" href="{{ asset('template/landing/css/themes/corporate.css') }}">
    <!-- END Stylesheets -->
</head>
