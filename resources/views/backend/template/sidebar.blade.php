<div class="layout-sidebar">
  <div class="layout-sidebar-backdrop"></div>
  <div class="layout-sidebar-body">
    <div class="custom-scrollbar">
      <nav id="sidenav" class="sidenav-collapse collapse">
        <ul class="sidenav">
          <li class="sidenav-heading">Navigations</li>
          <li class="sidenav-item {{ Request::route()->getName() == "dashboard" ? "active": "" }}">
            <a href="{{ route('dashboard') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-dashboard"></span>
              <span class="sidenav-label">Dashboard</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'configuration') !== false ? "active": "" }}">
            <a href="{{ route('configuration.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-globe"></span>
              <span class="sidenav-label">Web Configurations</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'faq') !== false ? "active": "" }}">
            <a href="{{ route('faq.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-info-circle"></span>
              <span class="sidenav-label">F.A.Q</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'speaker') !== false ? "active": "" }}">
            <a href="{{ route('speaker.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-user"></span>
              <span class="sidenav-label">Speakers</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'sponsor') !== false ? "active": "" }}">
            <a href="{{ route('sponsor.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-angellist"></span>
              <span class="sidenav-label">Sponsor</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'location') !== false ? "active": "" }}">
            <a href="{{ route('location.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-map"></span>
              <span class="sidenav-label">Locations</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'event') !== false ? "active": "" }}">
            <a href="{{ route('event.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-calendar"></span>
              <span class="sidenav-label">Events</span>
            </a>
          </li>

          <li class="sidenav-item {{ strpos(Request::route()->getName(), 'gallery') !== false ? "active": "" }}">
            <a href="{{ route('gallery.index') }}">
              {{-- <span class="badge badge-success">26</span> --}}
              <span class="sidenav-icon icon icon-photo"></span>
              <span class="sidenav-label">Gallery</span>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </div>
</div>
