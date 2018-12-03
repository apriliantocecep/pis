<!--==========================
  Header
============================-->
<header id="header">
  <div class="container">

    <div id="logo" class="pull-left">
      <!-- Uncomment below if you prefer to use a text logo -->
      {{-- <h1><a href="#main">C<span>o</span>nf</a></h1> --}}
      <a href="#intro" class="scrollto"><img src="{{ App\Http\Controllers\Controller::getLogoUrl() }}" alt="" title=""></a>
    </div>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="menu-active"><a href="#intro">Home</a></li>
        <li><a href="#about">Kajian</a></li>
        <li><a href="#venue">Lokasi</a></li>
        <li><a href="#history">Tentang Kami</a></li>
        <li><a href="#speakers">Pembicara</a></li>
        <li><a href="#schedule" style="color: #e0072f">Jadwal Kajian</a></li>
        <li><a href="#hotels">Lokasi lainnya</a></li>
        <li><a href="#gallery">Galeri</a></li>
        <li><a href="#sponsors">Sponsor</a></li>
        <li><a href="#contact">Kontak</a></li>
        <!-- <li class="buy-tickets"><a href="#buy-tickets">Buy Tickets</a></li> -->
      </ul>
    </nav><!-- #nav-menu-container -->
  </div>
</header><!-- #header -->
