@extends('web.layout.app_new')

@section('title') 
  <title>Būreliai | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Mes surinkome virš 400 būrelių vaikams ir suaugusiems, esančių Klaipėdoje ir Klaipėdos rajone. Čia lengvai ir greitai rasi ką veikti!">
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <h1>Būreliai, studijos, kursai</h1>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 mb-20 mb-md-0">
                            <div class="post-overaly-style post-lg"
                                 style="background-image:url({{ asset('assets/images/bureliai-vaikams-ir-jaunimui.jpg') }})">

                                <a href="{{ route('activities.forChildren') }}" class="image-link">&nbsp;</a>
                                <div class="overlay-post-content">
                                    <div class="post-content">
                                        <h2 class="post-title title-md">
                                            <a href="{{ route('activities.forChildren') }}">Vaikams ir jaunimui</a>
                                        </h2>
                                        <div class="post-meta">
                                            <ul>
                                                <li><i class="icon icon-fire"></i> {{ $activitiesChildrenCount }}+</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="post-overaly-style post-lg"
                                 style="background-image:url({{ asset('assets/images/bureliai-suaugusiems.jpg') }})">
                                <a href="{{ route('activities.forAdults') }}" class="image-link">&nbsp;</a>
                                <div class="overlay-post-content">
                                    <div class="post-content">
                                        <h2 class="post-title title-md">
                                            <a href="{{ route('activities.forAdults') }}">Suaugusiems</a>
                                        </h2>
                                        <div class="post-meta">
                                            <ul>
                                                <li><i class="icon icon-fire"></i> {{ $activitiesAdultsCount }}+</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_ACTIVITIES'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
