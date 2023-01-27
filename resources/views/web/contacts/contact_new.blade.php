@extends('web.layout.app_new')

@section('title')
    <title>Kontaktai | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
    <meta name="description"
          content="Parašyk mums! Turi idėją, komentarą, problemą ar norėtum pasikalbėti? Pataikei būtent čia! Nekantraujame iš tavęs sulaukti žinutės!">
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    {!! $contact_us->Text !!}

                    <br>
                    <div id="fb-root"></div>
                    <script async crossorigin="anonymous" src="https://connect.facebook.net/lt_LT/sdk.js#xfbml=1&version=v12.0&appId=531414237512591&autoLogAppEvents=1" nonce="f3rnALsm"></script>
                    <div class="fb-page" data-href="https://www.facebook.com/Klaipedaassutavim/" data-tabs="messages,timeline,events" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Klaipedaassutavim/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Klaipedaassutavim/">Klaipėda, aš su tavim</a></blockquote></div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
