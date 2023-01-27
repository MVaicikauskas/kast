@extends('web.layout.app_new')

@section('title') 
  <title>Apie Mus | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Ar mes pažįstami? Susipažinkime! Mes laikome „Klaipėda, aš su tavim“ projekto vairą ir spaudžiame “gazą“. Draugaukime!">
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <h1>{{ $about_us->Title }}</h1>
                    <div class="about_us_image-container">
                        @if(!empty($about_us['Photo']))
                            <img src="{{ asset('storage_old/aboutus/' . $about_us['Photo']) }}" width="100%" alt="Klaipėda, aš su tavim komanda, Darius, Monika">
                        @endif
                    </div>
                    <p>{!! $about_us->Text !!}</p>
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