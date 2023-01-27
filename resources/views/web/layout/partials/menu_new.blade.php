<div class="main-nav clearfix is-ts-sticky">
    <div class="container">
        <div class="row justify-content-center">
            <nav class="navbar navbar-expand-lg">
                <div class="site-nav-inner float-left">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="true" aria-label="Įjungti meniu">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div id="navbarSupportedContent"
                         class="collapse navbar-collapse navbar-responsive-collapse align-items-center justify-content-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item dropdown active">
                                <a href="/" title="Pradinis puslapis">Pradinis</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="{{ route('news.page') }}" class="menu-dropdown" data-toggle="dropdown">
                                    Naujienos <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($post_categories as $cat)
                                        <li><a href="{{ route('categorie.view', $cat->slug) }}">{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('events.page') }}">Renginiai</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="{{ route('activities.page') }}" class="menu-dropdown" data-toggle="dropdown">
                                    Būreliai <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('activities.forAdults') }}">Suaugusiems</a></li>
                                    <li><a href="{{ route('activities.forChildren') }}">Vaikams ir jaunimui</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('gallery.page') }}">Galerija</a>
                            </li>

                            <li>
                                <a href="{{ route('contacts') }}">Kontaktai</a>
                            </li>


                            <li class="nav-item add-event">
                                <a href="{{ route('user.add-event') }}">ĮKELK RENGINĮ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="menu-logo d-lg-none">
                <a href="/" title="Nuoroda į pradinį puslapį">
                    <img src="{{ asset('assets/images/logos/kast-logo.png') }}"
                         alt="Klaipėda Aš Su Tavim Logotipas"
                         title="Klaipėda Aš Su Tavim Logotipas"
                         loading="lazy">
                </a>
            </div>
            <div class="menu-title d-lg-none">
                <p>Klaipėda, Aš Su Tavim</p>
            </div>
        </div>
    </div>
</div>