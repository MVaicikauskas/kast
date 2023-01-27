@extends('web.layout.app')

@section('title')
    <title>{{ $tag->seo_title ? $tag->seo_title : $tag->title . " | „Klaipėda, aš su tavim“" }}</title>
@endsection


@section('meta')
    <meta name="date" content="{{ $tag->created_at }}">
    <meta name="revised" content="{{ $tag->updated_at }}">
    @isset($tag->seo_description)
        <meta name="description" content="{{ $tag->seo_description }}">
    @endisset
    <link rel="canonical" href="{{ url()->current() }}" />
@endsection

@section('facebook_share_title', $tag->seo_title ? $tag->seo_title : $tag->title)
@section('facebook_share_description', $tag->seo_description)

@section('content')

    <section class="section__padding">
        <div class="section-title">
            <h1>Žyma: {{ $tag->title }}</h1>
        </div>
        <div class="section-content">
            <p class="tag-description" style="margin-bottom: 15px">{{ $tag->short_description }}</p>
            <div class="posts-block">
                <div class="posts-list column column--left">
                    @includeIf('web.posts.partials.list', ['posts' => $tag->posts])
                    {{ $tag->posts->links() }}
                </div>

                @if ($googleAds)
                    <div class="ad-list column column--right bordered_ad">
                        <div class="advert_logo">REKLAMA</div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 1 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="9035454948"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 2 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="1226969880"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 3 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="1324485883"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>

                    </div>
                @elseif (sizeof($ads) >= 1)
                    @include('web.advertisements.index', array('ads' => $ads->slice(0, 3)))
                @endif

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.filter__news a[data-category]').on('click', function (e) {
            e.preventDefault()

            const categoryID = $(this).data('category')
            const url = 'naujienu-paieska/' + categoryID

            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    const html = $(data)
                    $('.posts-list').hide().html(html).fadeIn()
                }
            })
        })
    </script>
@endsection