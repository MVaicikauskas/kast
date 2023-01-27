<div class="sidebar-widget social-widget">
    <h3 class="block-title">
        <span class="title-angle-shap"> Žymos</span>
    </h3>
    <div class="tag-lists">
        @foreach($tags_sidebar as $tag)
            <h4><a href="{{ url('zyma/' . $tag->slug ) }}">{{ $tag->title }}</a></h4>
        @endforeach
    </div>
</div>