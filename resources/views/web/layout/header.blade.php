  <!-- Header container -->
<div class="header-container">
  <!-- Header branding - logo or title -->
  <div class="branding">

    <div class="logo-container">
      <a href="{{ route('home') }}">
        
          <img
            class="lazyload"
            src="{{ asset('dist/images/web/default_logo.png') }}"
            data-src="{{ asset('dist/images/web/default_logo.png') }}"
            alt="Klaipėda Aš Su Tavim Logotipas">
       
      </a>
    </div>

  </div>
  <!-- .branding -->

  <!-- Menu container -->
  <div class="menu-container">
    
      <nav id="page-navigation" class="main-nav" role="navigation">
        @include('web.layout.partials.menu')
      </nav>

      <div id="burgerBtn" class="burger">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <div id="mobileNav" class="mobile-nav">
        <div class="mobile-logo">
          <a href="{{ route('home') }}">
            @if(!empty($page['logo']))
              <img
                class="lazyload"
                src="{{ asset('storage_old/page/' . $page['logo']) }}"
                data-src="{{ asset('storage_old/page/' . $page['logo']) }}"
                alt="Klaipėda Aš Su Tavim logotipas">
            @elseif(!empty($page['title']))
              <h1>{{ $page['title'] }}</h1>
            @else
              <img
                class="lazyload"
                src="{{ asset('dist/images/web/default_logo.png') }}"
                data-src="{{ asset('dist/images/web/default_logo.png') }}"
                alt="Klaipėda Aš Su Tavim logotipas">
            @endif
          </a>
        </div>
        
        @include('web.layout.partials.menu')
      </div>

  </div>
  <!-- .menu -->
  
</div>
<!-- .header -->
    
