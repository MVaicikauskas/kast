<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/">Pradinis</a>
                    </li>
                    @if( Request::is('naujienos/*') )
                        <li><i class="fa fa-angle-right"></i><a href="{{ route('news.page') }}">Naujienos</a></li>
                    @endif
                    @if( Request::is('zyma/*') )
                        <li><i class="fa fa-angle-right"></i>Žyma</li>
                    @endif
                    @if( Request::is('bureliai/*') )
                        <li><i class="fa fa-angle-right"></i><a href="{{ route('activities.page') }}">Būreliai</a></li>
                    @endif
                    @if( Request::is('renginiai/*/*') )
                        <li><i class="fa fa-angle-right"></i><a href="{{ route('events.page') }}">Renginiai</a></li>
                    @endif
                    @if( isset($heading) && isset($heading_link) )
                        <li><i class="fa fa-angle-right"></i><a href="{{ $heading_link }}">{{ $heading }}</a></li>
                    @elseif( isset($heading) )
                        <li><i class="fa fa-angle-right"></i>{{ $heading }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>