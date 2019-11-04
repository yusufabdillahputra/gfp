@if(isset($session['id_users']))
@php
    $current_route = Route::currentRouteName();
    $explode_route = explode('.', $current_route);
    $current_main_route = $explode_route[0];
@endphp
<ul class="nav-main">
    <li class="nav-main-heading">Menu</li>
    @if ($current_main_route == 'dompet')
        <li class="active">
    @else
        <li>
    @endif
            <a href="{{ route('dompet.index') }}">
                <i class="si si-wallet"></i> Dompet
            </a>
        </li>


    @if($composers_rules_users->reqfeed->read == 1)
        @if($current_main_route == 'reqfeed')
            <li class="active">
        @else
            <li>
        @endif
                <a href="{{ route('reqfeed.index') }}" class="text-white">
                    <i class="si si-book-open"></i> Request Feed
                </a>
            </li>
    @endif

    @if (count($mst_konten_header))
        @foreach($mst_konten_header['konten'] as $konten)
            <li>
                <a class="nav-submenu" data-toggle="nav-submenu" href="javascript:void(0)">{{ $konten->judul_konten }}</a>
                @if (count($mst_konten_header['sub_konten']))
                    <ul>
                        @foreach ($mst_konten_header['sub_konten'] as $sub_konten)
                            @if($konten->id_konten == $sub_konten->id_konten)
                                <li>
                                    <a href="{{ route('frontend.konten.index')."?id=".encrypt($sub_konten->id_subk) }}">{{ $sub_konten->judul_subk }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif

</ul>
@endif
