@foreach($ads_list as $ad)
    @if( $ad->title == $type)
        <div id="{{ $ad->title }}" class="RE {{ $ad->type }} {{ $ad->title }}">
            @switch($ad->type)
                @case('image')
                <a href="{{ $ad->link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset('storage_old/ad-folder/' . $ad->image) }}" alt="Reklama"
                         referrerpolicy="no-referrer" loading="lazy">
                </a>
                @break

                @case('custom')
                {!! $ad->custom !!}
                @break

                @case('google')
                {!! $ad->google !!}
                @break
            @endswitch
            @if($type == "BOTTOM_FIXED")
                <a href="javascript:void(0)" id="CLOSE_BOTTOM_FIXED"><img style="height: 30px;width:auto;right:0;top: -22px;position:absolute;z-index:2147483646;margin: 0;" alt="Ikona, uždaryti" src="{{ asset('assets/images/uzdaryti.png') }}" loading="lazy"></a>
            @endif
        </div>
    @endif
@endforeach