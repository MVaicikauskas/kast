@foreach($posts as $post)
  <div class="post">
    <div class="post__image">
      <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">
        @if (!empty($post->image))
          <img
            class="lazyload"
            src="{{ asset('storage_old/posts/' . $post->image) }}"
            data-src="{{ asset('storage_old/posts/' . $post->image) }}">
        @else
          <img
            class="lazyload"
            src="{{ asset('dist/images/web/default_logo.png') }}"
            data-src="{{ asset('dist/images/web/default_logo.png') }}">
        @endif
      </a>
    </div>

    <div class="post__details">
              <div class="top-row">
                <span>{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
                <span>#{{ $post->category->name }}</span>
              </div>
              <div class="middle-row">
                <h2 class="title"><a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">{{ $post->title }}</a></h2>
                <!-- <h4 class="author">{{ $post->author ?? 'Klaipėda aš su Tavim' }}</h4> -->
                <p class="description">{{ $post->excerpt }}</p>
              </div>
              <div class="bottom-row">
                <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}" class="post-link">
                  Skaityti
                  <img src="{{ url('dist/images/web/arrow-read.png') }}" alt="Skaityti, rodyklė">
                </a>
                
            </div>
    </div>
  </div>
@endforeach