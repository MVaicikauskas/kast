<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li>
                    <a class="has-arrow" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-label">General page options</li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cog"></i><span class="hide-menu">General</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('page.index') }}">General</a></li>
                        {{-- <li><a href="{{ route('banner.index') }}">Banners</a></li> --}}
                        {{-- <li><a href="{{ route('social.index') }}">Social</a></li> --}}
                        <li><a href="{{ route('partners.index') }}">Partners</a></li>
                        <li><a href="{{ route('contact_us.index') }}">Contact Us Page</a></li>
                        <li><a href="{{ route('about_us.index') }}">About Us Page</a></li>
                        <li><a href="{{ route('privacy.index') }}">Privacy</a></li>
                        <li><a href="{{ route('social.index') }}">Socials</a></li>
                        <li><a href="{{ route('cache-clear') }}">Clear Cache</a></li>
                    </ul>
                </li>
                
                <li class="nav-label">Page Content</li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="far fa-calendar"></i>
                        <span class="hide-menu">
                            Events
                            @if($data['unconfirmedEvents'] > 0) 
                                <span class="label label-rouded label-warning pull-right">{{ $data['unconfirmedEvents'] }}</span>
                            @else
                                <span class="label label-rouded label-info pull-right">0</span>
                            @endif
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('event-category.index') }}">Categories</a></li>
                        <li><a href="{{ route('event-region.index') }}">Regions</a></li>
                        <li><a href="{{ route('events.index') }}">Events</a></li>
                        <li>
                            <a href="{{ route('events-unapproved') }}">Unapproved
                                @if($data['unconfirmedEvents'] > 0) 
                                    <span class="label label-rouded label-warning pull-right">{{ $data['unconfirmedEvents'] }}</span>
                                @else
                                    <span class="label label-rouded label-info pull-right">0</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Posts --}}
                <li>
                    <a class="has-arrow" href="#" aria-expanded="true">
                        <i class="far fa-newspaper"></i>
                        <span class="hide-menu">Posts</span>
                    </a>
                    <ul aria-expanded="false" class="in collapse">
                        <li><a href="{{ route('posts.index') }}"><span class="hide-menu">Posts</span></a>
                        <li><a href="{{ route('categories.index') }}"><span class="hide-menu">Categories</span></a>
                        <li><a href="{{ route('tags.index') }}"><span class="hide-menu">Tags</span></a></li>
                        <li><a href="{{ route('tags.trash') }}"><span class="hide-menu">Tags trash</span></a></li>
                    </ul>
                </li>
                {{-- Activities --}}
                <li>
                    <a class="has-arrow" href="{{ route('activities.index') }}" aria-expanded="false">
                        <i class="fa fa-campground"></i>
                        <span class="hide-menu">Activities</span>
                    </a>
                </li>

                {{-- Gallery --}}
                <li>
                    <a class="has-arrow" href="{{ route('gallery.index') }}" aria-expanded="false">
                        <i class="fa fa-image"></i>
                        <span class="hide-menu">Gallery</span>
                    </a>
                </li>


                <li class="nav-label">Advertising</li>
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cog"></i><span class="hide-menu">Advertisement</span></a>
                  <ul aria-expanded="false" class="collapse">
                      <li><a href="{{ route('advertisements.index') }}">Ads List</a></li>
                      <li><a href="{{ route('advertisement-settings.index') }}">Settings</a></li>
                      <li><a href="{{ route('advertisement-page-settings.index') }}">Page Settings</a></li>
                  </ul>
                </li>
                <li><a class="has-arrow" href="{{ route('ads.index') }}"><i class="fa fa-images"></i>Ads (new)</a></li>
            </ul>
        </nav>
    </div>
</div>