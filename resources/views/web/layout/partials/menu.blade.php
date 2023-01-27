<div class="menu-main-container">
	<div class="event-button-container">
		<a href="{{ route('user.add-event') }}" class="btn-add-event {{ Request::is('ikelti-rengini') ? 'active' : '' }}">
			+ įkelti renginį nemokamai
		</a>
	</div>
	<ul class="menu">
    <li class="{{ Request::is('/') ? 'active' : '' }}">
      <a href="{{ route('home') }}">Pradžia</a>
    </li>
    <li class="{{ Request::is('renginiai/*') || Request::is('renginiai')  ? 'active' : '' }}">
      <a href="{{ route('events.page') }}">Renginiai</a>
    </li>
    <li class="{{ Request::is('naujienos/*') || Request::is('naujienos')  ? 'active' : '' }}">
      <a href="{{ route('news.page') }}">Naujienos</a>
    </li>
    <li class="{{ Request::is('bureliai/*') || Request::is('bureliai')  ? 'active' : '' }}">
      <a href="{{ route('activities.page') }}">Būreliai</a>
    </li>
    <li class="{{ Request::is('galerija/*') || Request::is('galerija')  ? 'active' : '' }}">
      <a href="{{ route('gallery.page') }}">Galerija</a>
    </li>
    <li class="{{ Request::is('apie-mus') ? 'active' : '' }}">
      <a href="{{ route('aboutUs') }}">Apie Mus</a>
    </li>
    <li class="{{ Request::is('kontaktai') ? 'active' : '' }}">
      <a href="{{ route('contacts') }}">Kontaktai</a>
    </li>
    <li>
      <a href="https://www.facebook.com/Klaipedaassutavim/" target='_blank' class="social-link">
        <i class="fab fa-facebook-square"></i>
      </a>
      <a href="https://www.instagram.com/klaipedaassutavim/" target='_blank' class="social-link">
          <i class="fab fa-instagram"></i>
       </a>
    </li>
	</ul>
</div>

