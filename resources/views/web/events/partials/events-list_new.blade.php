@if( $events->count() )
  <div class="row ts-gutter-10">
    @foreach($events as $event)
      <div class="col-md-6">
        <div class="post-block-style">
          <div class="post-thumb">
            <a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}">
              @if (!empty($event->image))
                <img
                        class="img-fluid lazyload"
                        src="{{ asset('storage_old/events/' . $event->image) }}"
                        data-src="{{ asset('storage_old/posts/' . $event->image) }}"
                        alt="Renginio nuotrauka, {{ $event->title }}">
              @else
                <img
                        class="img-fluid lazyload"
                        src="{{ asset('dist/images/web/default_logo.png') }}"
                        data-src="{{ asset('dist/images/web/default_logo.png') }}"
                        alt="Renginio nuotrauka">
              @endif
            </a>
            <div class="grid-cat">
              @if($event->category->name)
                <span class="post-cat" title="Kategorija: {{ $event->category->name }}">{{ $event->category->name }}</span>
              @endif
              @if($event->is_free)
                <span class="post-cat free-event">Nemokamas</span>
              @endif
            </div>
          </div>

          <div class="post-content">
            <h2 class="post-title title-md">
              <a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}"
                 title="Nuoroda į renginį, {{ $event->title }}">{{ $event->title }}</a>
            </h2>
            <div class="post-meta mb-7">
              <span class="post-date"><i class="fa fa-calendar-times-o"></i> {{ $event->date }}</span>
              <span class="post-time"><i class="fa fa-clock-o"></i> {{ $event->start_time }}</span>
              <span class="post-location"><i class="fa fa-map"></i> {{ $event->location }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="gap-30 d-none d-md-block"></div>
  <div class="row">
    <div class="col-12">
      {{ $events->onEachSide(2)->appends(request()->query())->links() }}
    </div>
  </div>
@else
  <div class="row ts-gutter-10">
    <div class="col-12">
      <p>Neradome renginių. <br><br>Pakoreguokite paiešką arba žiūrėkite visus renginius <a href="{{ route('events.page') }}" title="Visi renginiai">čia</a>.</p>
    </div>
  </div>
@endif