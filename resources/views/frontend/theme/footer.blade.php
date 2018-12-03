<!--==========================
  Footer
============================-->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-info">
          <img src="{{ App\Http\Controllers\Controller::getLogoUrl() }}" alt="PIS">
          <p>{{ App\Http\Controllers\Controller::getConfig('title') }}</p>
          <p>{!! nl2br(App\Http\Controllers\Controller::getConfig('description')) !!}</p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Sitemap 1</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#intro">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#about">Kajian</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#venue">Lokasi</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#history">Tentang Kami</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#speakers">Pembicara</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Sitemap 2</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#schedule">Jadwal Kajian</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#hotels">Lokasi lainnya</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#gallery">Galeri</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#sponsors">Sponsor</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#contact">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Kontak Kami</h4>
          <p>
            {!! nl2br(App\Http\Controllers\Controller::getConfig('address')) !!}<br>
            <strong>Phone:</strong> <a href="tel:{{ App\Http\Controllers\Controller::getConfig('phone') }}">{{ App\Http\Controllers\Controller::getConfig('phone') }}</a> <br>
            <strong>Email:</strong> <a href="mailto:{{ App\Http\Controllers\Controller::getConfig('email') }}">{{ App\Http\Controllers\Controller::getConfig('email') }}</a> <br>
          </p>

          <div class="social-links">
            <!-- <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> -->
            <!-- <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> -->
            <a target="_blank" href="{{ App\Http\Controllers\Controller::getConfig('ig_url') }}" class="instagram"><i class="fa fa-instagram"></i></a>
            <!-- <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a> -->
            <!-- <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a> -->
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Hak cipta 2018 <strong>Pemuda Ingin Surga</strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
      <small>Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></small>
    </div>
  </div>
</footer><!-- #footer -->
