<footer>
  <div class="top-footer">
    <div class="logo">
      <img
        class="lazyload"
        src="{{ asset('dist/images/web/default_logo_white.png') }}"
        data-src="{{ asset('dist/images/web/default_logo_white.png') }}"
        alt="Klaipėda Aš Su Tavim logotipas">
    </div>
    @if( Request::is('/') )
      <h1 style="font-size: 15px; color: #fff; font-family: 'Montserrat', sans-serif;">Klaipėdos ir jos krašto naujienos, renginiai.</h1>
    @else
      <h3 style="font-size: 15px; color: #fff; font-family: 'Montserrat', sans-serif;">Klaipėda, aš su tavim - sparčiausiai vakarų Lietuvoje auganti socialinių tinklų ir portalo grupė!</h3>
    @endif
    <div class="footer-menu">
      <ul>
        <li><a href="{{ route('events.page') }}">Renginiai</a></li>
        <li><a href="{{ route('activities.page') }}">Būreliai</a></li>
        <li><a href="{{ route('news.page') }}">Naujienos</a></li>
		<li><a href="{{ route('advertisement') }}">Reklama</a></li>
      </ul>
      <ul>
        <li><a href="{{ route('privacyPolicy') }}">Privatumo politika</a></li>
        <li><a href="{{ route('gallery.page') }}">Galerija</a></li>
        <li><a href="{{ route('aboutUs') }}">Apie Mus</a></li>
        <li><a href="{{ route('contacts') }}">Kontaktai</a></li>
      </ul>
      <ul class="social-links">
        <li><a href="https://www.facebook.com/Klaipedaassutavim/" target='_blank'><i class="fab fa-facebook-square"></i></a></li>
        <li><a href="https://www.instagram.com/klaipedaassutavim/" target='_blank'><i class="fab fa-instagram"></i></a></li>
      </ul>
    </div>
  </div>
  <div class="copyright">
    <p>
      {{ date('Y') }} Klaipėda, aš su tavim | Visos teisės saugomos
    </p>
  </div>
</footer>
<!--JQuery-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('dist/js/underscore.js') }}"></script>
<script src="{{ asset('dist/js/moment.js') }}"></script>
<script src="{{ asset('dist/js/clndr.min.js') }}"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.7.1/lazyload.min.js"></script>
{{-- <!--<script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>--> --}}

@yield('scripts')

<script src="{{ asset('dist/js/custom.js') }}?v={{ config('app.version')  }}"></script>
<script defer src="{{ asset('dist/js/jquery.jscroll.min.js') }}"></script>

<script type="text/javascript">
moment.locale('lt');

moment.updateLocale('lt', {
    months : [
        "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
        "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"
    ]
});

window.lazyLoadOptions = {
    threshold: 400,
    class_loading: 'img-loading'
};

(function($){
  $(document).on('contextmenu', 'img', function() {
      return false;
  })
})(jQuery);

$( document ).ajaxComplete( function() {
    $( window ).trigger('resize');
} );
</script>