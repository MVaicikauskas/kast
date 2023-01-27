<section class="posts-section">
  <div class="section-title">
    <h4>
      Naujienos ir įvykiai
    </h4>
  </div>
  <div class="section-content">
    <div class="posts owl-carousel posts-carousel">
      
        @foreach($posts as $post)
          <article class="post-container">

            <div class="post-image">
            
              <img class="owl-lazy"
                src="{{ asset('storage_old/posts/' . $post->image) }}"
                data-src="{{ asset('storage_old/posts/' . $post->image) }}"
                alt="{{ $post->title }}">
            </div>
            
            <div class="post-details">
              <div class="top-row">
                <span>{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
                <span>#{{ $post->category->name }}</span>
              </div>
              <div class="middle-row">
                <h2 class="title"><a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">{{ $post->title }}</a></h2>
                <p class="description">{{ $post->excerpt }}</p>
              </div>
              <div class="bottom-row">
                <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}" class="post-link">
                  Skaityti
                  <img src="././dist/images/web/arrow-read.png" alt="Skaityti">
                </a>
                
            </div>
            </div>
          </article>
        @endforeach
    </div>

    <div class="button-container">
      <a href="{{ route('news.page') }}" class="button button--all">
        Visos naujienos
      </a>
    </div>
  </div>
</section>