@extends('web.layout.app_new')

@section('title') 
  <title>Reklama | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Permesk savo konkurentus per šoną! Standartinės ir individualiai pritaikytos reklamos paslaugos už geriausią kainą. Malonus ir greitas bendravimas. Pradėk jau šiandien!">
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <h1>{{ $advertisementPageSettings->Title }}</h1>

                    {!! $advertisementPageSettings->Text !!}

                    @if(!empty($advertisementPageSettings['Photo']))
                        <br>
                        <img src="{{ asset('storage_old/adverts/' . $advertisementPageSettings['Photo']) }}" width="100%">
                    @endif
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
