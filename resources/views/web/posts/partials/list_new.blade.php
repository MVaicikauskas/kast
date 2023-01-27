<div class="row ts-gutter-10">
    @foreach($posts as $post)
        <div class="col-md-6">
            <div class="post-block-style">
                <div class="post-thumb">
                    <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">
                        @if (!empty($post->image))
                            <img
                                    class="img-fluid lazyload"
                                    src="{{ asset('storage_old/posts/' . $post->image) }}"
                                    data-src="{{ asset('storage_old/posts/' . $post->image) }}"
                                    alt="{{ $post->title }}">
                        @else
                            <img
                                    class="img-fluid lazyload"
                                    src="{{ asset('dist/images/web/default_logo.png') }}"
                                    data-src="{{ asset('dist/images/web/default_logo.png') }}">
                        @endif
                    </a>
                </div>

                <div class="post-content">
                    <div class="post-meta my-1">
                        <span class="post-date"><i class="fa fa-clock-o"></i> {{ date('Y-m-d', strtotime($post->created_at)) }}</span>
                    </div>
                    <h2 class="post-title title-md">
                        <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}"
                        title="Skaityti straipsnį - {{ $post->title }}">{{ $post->title }}</a>
                    </h2>
                    <p>{{ $post->excerpt }}..</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="gap-10"></div>
@include('web.layout.widgets.ad_block', ['type' => 'CATEGORY_RE'])
<div class="gap-10"></div>
<div class="row">
    <div class="col-12">
        {{ $posts->onEachSide(2)->appends($_GET)->links() }}
    </div>
</div>