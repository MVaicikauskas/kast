@foreach($events as $event)
  <div class="event">
    <div class="event__image">
            @if($event->is_free)
              <div class="event--free"><span>Nemokamas Renginys</span></div>
              @endif

      <a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}">
        @if (!empty($event->image))
            <img
              class="lazyload"
              src="{{ asset('storage_old/events/' . $event->image) }}"
              data-src="{{ asset('storage_old/events/' . $event->image) }}"
              alt="Renginio nuotrauka, {{ $event->title }}">
          @else
            <img
              class="lazyload"
              src="{{ asset('dist/images/web/default_logo.png') }}"
              data-src="{{ asset('dist/images/web/default_logo.png') }}"
              alt="Renginio nuotrauka">
          @endif
      </a>
    </div>
    <div class="event__details">
      <h2><a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}" class="details__title" title="Nuoroda į renginį, {{ $event->title }}">{{ $event->title }}</a></h2>
      <div class="details">
        <div class="details__location">
          <span>{{ $event->date }}, {{ $event->location }}</span>
        </div>
        <div class="details__start-time">
          <span>{{ $event->start_time }}</span>
        </div>
      </div>
    </div>
  </div>
@endforeach