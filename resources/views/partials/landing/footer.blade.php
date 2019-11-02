@if (count($mst_konten_footer))
    <div class="row">
        @foreach ($mst_konten_footer['konten'] as $konten)
            <div class="col-md-2">
            <b><u>{{ $konten->judul_konten }}</u></b>
            <ul style="list-style-type: none; margin: 0; padding: 0">
                @foreach ($mst_konten_footer['sub_konten'] as $sub_konten)
                    @if($konten->id_konten == $sub_konten->id_konten)
                        <li>
                            <a href="{{ route('frontend.konten.index')."?id=".encrypt($sub_konten->id_subk) }}">{{ $sub_konten->judul_subk }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            </div>
        @endforeach
    </div>
@endif
