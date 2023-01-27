<div class="sidebar-widget post-list-widget">
    <h3 class="block-title">
        <span class="title-angle-shap">Naujienos</span>
    </h3>
    <div class="list-post-block">
        <ul class="list-post">
            @foreach($news_sidebar as $sidebar_new)
                @php
                    $image = $sidebar_new->image ? 'storage_old/posts/' .$sidebar_new->image : 'assets/images/placeholder.png';
                    $link = url('naujienos/' . $sidebar_new->category->slug . '/' . $sidebar_new->slug);
                @endphp
            <li>
                <div class="post-block-style media">
                    <div class="post-thumb">
                        <a href="{{ $link }}">
                            <img class="img-fluid owl-lazy"
                                 src="{{ asset($image) }}"
                                 data-src="{{ asset($image) }}"
                                 alt="{{ $sidebar_new->title }}"
                                 title="{{ $sidebar_new->title }}"
                                 loading="lazy">
                        </a>
                    </div>
                    <div class="post-content media-body">
                        <h4 class="post-title">
                            <a href="{{ $link }}">{{ $sidebar_new->title }}</a>
                        </h4>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>