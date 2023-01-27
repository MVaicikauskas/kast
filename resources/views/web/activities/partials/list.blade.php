
@foreach($activities as $activity)
  <div class="activity activity__inner">
    <div class="activity__image">
      <a href="{{ url('bureliai/' . $activity->category->slug . '/' . $activity->subcategory->slug . '/' . $activity->slug) }}">
        @if (!empty($activity->image))
          <img
            class="lazyload"
            src="{{ asset('storage_old/activities/' . $activity->image) }}"
            data-src="{{ asset('storage_old/activities/' . $activity->image) }}">
        @else
          <img
            class="lazyload"
            src="{{ asset('dist/images/web/default_logo.png') }}"
            data-src="{{ asset('dist/images/web/default_logo.png') }}">
        @endif
      </a>
    </div>

    <div class="activity__details">
      <a> {{ $activity->subcategory->name }}</a>
      <a href="{{ url('bureliai/' . $activity->category->slug . '/' . $activity->subcategory->slug . '/' . $activity->slug) }}" class="details__title">
        {{ $activity->name }}
      </a>

      <div class="details">
        <div class="details__location">
          <p>{{ $activity->excerpt }}</p>
        </div>
      </div>
    </div>
  </div>
@endforeach
