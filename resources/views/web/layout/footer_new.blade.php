<footer class="ts-footer">
    <div class="container">
        <div class="row ts-gutter-30 justify-content-lg-between justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h3 class="widget-title"><span>Klaipėda, aš su tavim</span></h3>
                    <div class="widget-content">
                        <img src="{{ asset('assets/images/logos/kast-logo-baltas-300.png') }}" alt="Klaipėda Aš Su Tavim logotipas, baltas" title="Klaipėda Aš Su Tavim logotipas"
                             style="width: 200px;"
                             class="d-block mb-5">
                        <p class="mb-20" style="width: 80%">Sparčiausiai Vakarų Lietuvoje auganti socialinių tinklų ir portalo grupė!</p>
                        <ul class="footer-menu">
                            <li><a href="{{ route('aboutUs') }}">Apie mus</a></li>
                            <li><a href="{{ route('advertisement') }}">Reklama</a></li>
                            <li><a href="{{ route('privacyPolicy') }}">Privatumo politika</a></li>
                            <li><a href="{{ route('contacts') }}">Kontaktai</a></li>
                        </ul>
                        <ul class="ts-social">
                            <li><a href="https://www.facebook.com/Klaipedaassutavim/" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/klaipedaassutavim/" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/klaip%C4%97da-a%C5%A1-su-tavim-portalas-ir-socialini%C5%B3-tinkl%C5%B3-grup%C4%97" target="_blank"><i
                                            class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://twitter.com/klaipedasutavim?t=OgpYfwSD1PNUiAnOTALfRA&s=07" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>{{--col end --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget post-widget">
                    <h3 class="widget-title"><span>Naujienos</span></h3>
                    <div class="widget-content">
                        <div class="list-post-block">
                            <ul class="list-post">
                                @foreach($footer_news as $news_post)
                                    @php
                                        $image = $news_post->image ? 'storage_old/posts/' . $news_post->image : 'assets/images/placeholder.png';
                                        $link = url('naujienos/' . $news_post->category->slug . '/' . $news_post->slug)
                                    @endphp
                                <li>
                                    <div class="post-block-style media">
                                        <div class="post-thumb">
                                            <a href="{{ $link }}">
                                                <img class="img-fluid"
                                                     src="{{ asset($image) }}"
                                                     data-src="{{ asset($image) }}"
                                                     alt="{{ $news_post->title }}"
                                                     title="{{ $news_post->title }}"
                                                     loading="lazy">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h4 class="post-title">
                                                <a href="{{ $link }}">{{ $news_post->title }}</a>
                                            </h4>
                                        </div>{{--Post content end --}}
                                    </div>{{--Post block style end --}}
                                </li>{{--Li 1 end --}}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>{{--col end --}}
            <div class="col-lg-3 col-md-6 text-center">
                <div class="footer-widget post-widget">
                    <div class="widget-content">
                        @include('web.layout.widgets.ad_block', ['type' => 'FOOTER_RE'])
                    </div>
                </div>
            </div>{{--col end --}}
        </div>{{--row end --}}
    </div>{{--container end --}}
</footer>

<div class="ts-copyright">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 text-center">
                <div class="copyright-content text-light">
                    <p>&copy; 2021 Klaipėda, aš su tavim | Visos teisės saugomos</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="top-up-btn">
    <div class="backto">
        <a href="#" class="fa fa-angle-up" aria-hidden="true"></a>
    </div>
</div>