@if( $activities->count() )
<div class="row ts-gutter-10">
  @foreach($activities as $activity)
    <div class="col-md-6">
      <div class="post-block-style">
        <div class="post-thumb">
          <a href="{{ url('bureliai/' . $activity->category->slug . '/' . $activity->subcategory->slug . '/' . $activity->slug) }}">
            @if (!empty($activity->image))
              <img
                      class="img-fluid lazyload"
                      src="{{ asset('storage_old/activities/' . $activity->image) }}"
                      data-src="{{ asset('storage_old/activities/' . $activity->image) }}"
                      alt="{{ $activity->title }}">
            @else
              <img
                      class="img-fluid lazyload"
                      src="{{ asset('dist/images/web/default_logo.png') }}"
                      data-src="{{ asset('dist/images/web/default_logo.png') }}">
            @endif
          </a>
          <div class="grid-cat">
            <a class="post-cat"
               href="{{ url('bureliai/' . $activity->category->slug . '/' . $activity->subcategory->slug) }}"
               title="Kategorija: {{ $activity->subcategory->name }}">{{ $activity->subcategory->name }}</a>
          </div>
        </div>

        <div class="post-content">
          <h2 class="post-title title-md">
            <a href="{{ url('bureliai/' . $activity->category->slug . '/' . $activity->subcategory->slug . '/' . $activity->slug) }}"
               title="Žiūrėti būrelį - {{ $activity->name }}">{{ $activity->name }}</a>
          </h2>
          <p>{{ $activity->excerpt }}..</p>
        </div>
      </div>
    </div>
  @endforeach
</div>
<div class="gap-30 d-none d-md-block"></div>
<div class="row">
  <div class="col-12">
    {{ $activities->onEachSide(2)->appends($_GET)->links() }}
  </div>
</div>
@else
  <div class="row ts-gutter-10">
    <div class="col-12">
      @include('web.activities.partials.no-activities')
    </div>
  </div>
@endif