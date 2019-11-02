@php
$current_route = Route::currentRouteName();
$explode_route = explode('.', $current_route);
$current_main_route = $explode_route[0];
@endphp
<ul class="menu-items mt-md-2">
    @if($composers_rules_users->landing->read == 1)
    <li>
        <a href="{{ route('landing.index') }}">
            <span class="title">Landing</span>
        </a>
        <span class="icon-thumbnail "><i class="pg-desktop"></i></span>
    </li>
    @endif

    @if($composers_rules_users->dashboard->read == 1)
    @if ($current_main_route == 'dashboard')
    <li class="active">
        @else
    <li>
        @endif
        <a href="{{ url('dashboard') }}">
            <span class="title">Dashboard</span>
        </a>
        @if ($current_main_route == 'dashboard')
        <span class="bg-success icon-thumbnail "><i class="pg-home"></i></span>
        @else
        <span class="icon-thumbnail "><i class="pg-home"></i></span>
        @endif
    </li>
    @endif

    @if($composers_rules_users->transaksi->read == 1)
    @if ($current_main_route == 'transaksi')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('transaksi') }}">
                <span class="title">Transaksi</span>
            </a>
            @if ($current_main_route == 'transaksi')
                <span class="bg-success icon-thumbnail "><i class="fa fa-money"></i></span>
            @else
                <span class="icon-thumbnail "><i class="fa fa-money"></i></span>
            @endif
        </li>
    @endif

    @if($composers_rules_users->feed->read == 1)
    @if ($current_main_route == 'feed')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('feed') }}">
                <span class="title">Feed</span>
            </a>
            @if ($current_main_route == 'feed')
                <span class="bg-success icon-thumbnail "><i class="pg-layouts"></i></span>
            @else
                <span class="icon-thumbnail "><i class="pg-layouts"></i></span>
            @endif
        </li>
    @endif

    @if($composers_rules_users->konten->read == 1)
    @if ($current_main_route == 'konten')
    <li class="active">
    @else
    <li>
        @endif
        <a href="{{ url('konten') }}">
            <span class="title">Konten</span>
        </a>
        @if ($current_main_route == 'konten')
            <span class="bg-success icon-thumbnail "><i class="fa fa-newspaper-o"></i></span>
        @else
            <span class="icon-thumbnail "><i class="fa fa-newspaper-o"></i></span>
        @endif
    </li>
    @endif

    @if($composers_rules_users->label->read == 1)
    @if ($current_main_route == 'label')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('label') }}">
                <span class="title">Label</span>
            </a>
            @if ($current_main_route == 'label')
                <span class="bg-success icon-thumbnail "><i class="fa fa-tags"></i></span>
            @else
                <span class="icon-thumbnail "><i class="fa fa-tags"></i></span>
            @endif
        </li>
    @endif

    @if($composers_rules_users->payment->read == 1)
    @if ($current_main_route == 'payment')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('payment') }}">
                <span class="title">Pembayaran</span>
            </a>
            @if ($current_main_route == 'payment')
                <span class="bg-success icon-thumbnail "><i class="fa fa-bank"></i></span>
            @else
                <span class="icon-thumbnail "><i class="fa fa-bank"></i></span>
            @endif
        </li>
    @endif

    @if($composers_rules_users->donasi->read == 1)
    @if ($current_main_route == 'donasi')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('donasi') }}">
                <span class="title">Donasi</span>
            </a>
            @if ($current_main_route == 'donasi')
                <span class="bg-success icon-thumbnail "><i class="fa fa-stack-overflow"></i></span>
            @else
                <span class="icon-thumbnail "><i class="fa fa-stack-overflow"></i></span>
            @endif
        </li>
    @endif

    @if ($current_main_route == 'users')
        <li class="active">
    @else
        <li>
            @endif
            <a href="{{ url('users') }}">
                <span class="title">Pengguna</span>
            </a>
            @if ($current_main_route == 'users')
                <span class="bg-success icon-thumbnail "><i class="fa fa-users"></i></span>
            @else
                <span class="icon-thumbnail "><i class="fa fa-users"></i></span>
            @endif
        </li>

</ul>
