@extends('frontend.theme.app')
@section('title', App\Http\Controllers\Controller::getConfig('site_name')." - ".App\Http\Controllers\Controller::getConfig('title'))

@section('content')

  @include('frontend.theme.intro')

  <main id="main">
    <!--==========================
      About Section
    ============================-->
    <section id="about">
      <div class="container">
        @if ($event_this_weekend)
          <div class="row">
            <div class="col-lg-3">
              @if ($event_this_weekend->picture)
                <a
                  @if ($event_this_weekend->video_url)
                    href="{{ $event_this_weekend->video_url }}"
                    data-vbtype="video"
                    data-autoplay="true"
                    data-gall="kajian-gallery"
                    class="venobox"
                  @elseif ($event_this_weekend->url)
                    href="{{ $event_this_weekend->url }}"
                    target="_blank"
                  @else
                    href="{{ asset($event_this_weekend->picture->file) }}"
                    data-gall="kajian-gallery"
                    class="venobox"
                  @endif
                >
                  <img src="{{ asset($event_this_weekend->picture->file) }}" alt="{{ $event_this_weekend->name }}" class="img-fluid">
                </a>
              @endif
            </div>
            <div class="col-lg-6">
              <h2>
                {{ $event_this_weekend->name }}
              </h2>
              @if ($event_this_weekend->url || $event_this_weekend->video_url)
                <h4>
                  @if ($event_this_weekend->url)
                    <a target="_blank" href="{{ $event_this_weekend->url }}"><i class="fa fa-instagram"></i></a>
                  @endif
                  &nbsp;
                  @if ($event_this_weekend->video_url)
                    <a target="_blank" href="{{ $event_this_weekend->video_url }}"><i class="fa fa-youtube"></i></a>
                  @endif
                </h4>
              @endif
              {!! $event_this_weekend->description !!}
            </div>
            <div class="col-lg-3">
              <h3>Dimana?</h3>
              <p>
                @if ($event_this_weekend->location)
                  @if ($event_this_weekend->location->google_map_address)
                    <a target="_blank" href="{{ $event_this_weekend->location->google_map_address }}">{{ $event_this_weekend->location->name }}</a>
                  @else
                    {{ $event_this_weekend->location->name }}
                  @endif
                @endif
              </p>

              <h3>Kapan?</h3>
              <p>
                {{ $event_this_weekend->date_from->format('l, d F Y @H:i A') }} s/d selesai
              </p>

              <h3>Sama Siapa?</h3>
              <p>
                @if ($event_this_weekend->speaker)
                  @if ($event_this_weekend->speaker->ig_url)
                    <a target="_blank" href="{{ $event_this_weekend->speaker->ig_url }}">{{ $event_this_weekend->speaker->name }}</a>
                  @else
                    {{ $event_this_weekend->speaker->name }}
                  @endif
                @endif
              </p>
            </div>
            <!-- <div class="col-lg-2">
              <h3>When</h3>
              <p>Monday to Wednesday<br>10-12 December</p>
            </div> -->
          </div>
        @else
          <div class="col-lg-12 text-center">
            <h2>Tunggu jadwal kajian berikutnya ya :)</h2>
          </div>
        @endif
      </div>
    </section>

    <!--==========================
      Venue Section
    ============================-->
    <section id="venue" class="wow fadeInUp">

      <div class="container-fluid">

        <div class="section-header">
          <h2>Lokasi tempat kajian minggu ini</h2>
          <p>Info lokasi tempat acara dan galeri</p>
        </div>

        @if ($event_this_weekend)
          @if ($event_this_weekend->location)
            <div class="row no-gutters">
              <div class="col-lg-6 venue-map">
                {!! $event_this_weekend->location->google_map_embed !!}
              </div>

              <div
                class="col-lg-6 venue-info"
                @if ($event_this_weekend->location->picture)
                  style="background: url({{ asset($event_this_weekend->location->picture->file) }});background-size: cover;"
                @endif
              >
                <div class="row justify-content-center">
                  <div class="col-11 col-lg-8">
                    <h3>{{ $event_this_weekend->location->name }}</h3>
                    <p>{{ $event_this_weekend->location->address }}</p>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endif

      </div>

      <div class="container-fluid venue-gallery-container">
        <div class="row no-gutters">

          @foreach ($galleries_location as $key => $gallery_location)
            @if ($gallery_location->picture)
              <div class="col-lg-3 col-md-4">
                <div class="venue-gallery">
                  <a href="{{ asset($gallery_location->picture->file) }}" class="venobox" data-gall="venue-gallery">
                    <img src="{{ asset($gallery_location->picture->file) }}" alt="{{ $gallery_location->name }}" class="img-fluid">
                  </a>
                </div>
              </div>
            @endif
          @endforeach

        </div>
      </div>

    </section>

    <!--==========================
      About Us Section
    ============================-->
    <section id="history" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Tentang Kami</h2>
        </div>

        <div class="content-history">
          {!! nl2br(App\Http\Controllers\Controller::getConfig('aboutus')) !!}
        </div>

      </div>

    </section>

    <!--==========================
      Speakers Section
    ============================-->
    <section id="speakers" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Pembicara</h2>
          <p>Berikut beberapa pembicara kami</p>
        </div>

        <div class="row">
          @foreach ($speakers as $key => $speaker)
            <div class="col-lg-4 col-md-6">
              <div class="speaker">
                @if ($speaker->picture)
                  <img src="{{ asset($speaker->picture->file) }}" alt="{{ $speaker->name }}" class="img-fluid">
                @else
                  <img src="{{ asset('noimage.jpg') }}" alt="No Image" class="img-fluid">
                @endif
                <div class="details">
                  <h3><a target="_blank" href="{{ $speaker->ig_url }}">{{ $speaker->name }}</a></h3>
                  <p>{{ $speaker->address }}</p>
                  <div class="social">
                    <a target="_blank" href="{{ $speaker->ig_url }}"><i class="fa fa-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </section>

    <!--==========================
      Schedule Section
    ============================-->
    <section id="schedule" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Jadwal Kajian</h2>
          <p>Inilah jadwal acara kami</p>
        </div>

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#this-month" role="tab" data-toggle="tab">Bulan ini</a>
          </li>
        </ul>

        <h3 class="sub-heading">Waktu, tempat dan tanggal sewaktu-waktu dapat berubah. Terus ikuti kami untuk update kabar terbaru.</h3>

        <div class="tab-content row justify-content-center">

          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="this-month">

            <!-- <div class="row schedule-item">
              <div class="col-md-2"><time>09:30 AM</time></div>
              <div class="col-md-10">
                <h4>Registration</h4>
                <p>Fugit voluptas iusto maiores temporibus autem numquam magnam.</p>
              </div>
            </div> -->

            @foreach ($events as $key => $event)
              <div class="row schedule-item">
                <div class="col-md-2"><time>{{ $event->date_from->format('l, d F Y @H:i A') }} s/d selesai</time></div>
                <div class="col-md-10">
                  @if ($event->speaker)
                    <div class="speaker">
                      @if ($event->speaker->picture)
                        <img src="{{ asset($event->speaker->picture->file) }}" alt="{{ $event->speaker->name }}">
                      @endif
                    </div>
                    <h4>{{ $event->speaker->name }} <span>{{ $event->speaker->address }}</span></h4>
                  @endif
                  <p>Tema "
                    @if ($event->url)
                      <a target="_blank" href="{{ $event->url }}">{{ $event->name }}</a>
                    @else
                      {{ $event->name }}
                    @endif
                    "
                  </p>
                  <p>Lokasi:
                    @if ($event->location)
                      @if ($event->location->google_map_address)
                        <a target="_blank" href="{{ $event->location->google_map_address }}">{{ $event->location->name }}</a>
                      @else
                        {{ $event->location->name }}
                      @endif
                    @endif
                  </p>
                </div>
              </div>
            @endforeach

          </div>
          <!-- End Schdule Day 1 -->

        </div>

      </div>

    </section>

    <!--==========================
      Hotels Section
    ============================-->
    <section id="hotels" class="section-with-bg wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Lokasi lainnya</h2>
          <p>Berikut beberapa tempat kajian lainnya</p>
        </div>

        <div class="row">
          @foreach ($locations as $key => $location)
            <div class="col-lg-4 col-md-6">
              <div class="hotel">
                <div class="hotel-img">
                  @if ($location->picture)
                      <img src="{{ asset($location->picture->file) }}" alt="{{ $location->name }}" class="img-fluid">
                  @endif
                </div>
                <h3><a target="_blank" href="{{ $location->google_map_address }}">{{ $location->name }}</a></h3>
                <p>{{ $location->address }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </section>

    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery" class="wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Galeri</h2>
          <p>Lihat galeri kami dari acara baru-baru ini</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
        @foreach ($galleries as $key => $gallery)
          @if ($gallery->picture)
            <a href="{{ asset($gallery->picture->file) }}" class="venobox" data-gall="gallery-carousel"><img src="{{ asset($gallery->picture->file) }}" alt="{{ $gallery->name }}"></a>
          @endif
        @endforeach
      </div>

    </section>

    <!--==========================
      Sponsors Section
    ============================-->
    <section id="sponsors" class="section-with-bg wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Sponsor</h2>
        </div>

        <div class="row no-gutters sponsors-wrap clearfix">
          @foreach ($sponsors as $key => $sponsor)
            @if ($sponsor->picture)
              <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="sponsor-logo">
                  <img src="{{ asset($sponsor->picture->file) }}" class="img-fluid" alt="{{ $sponsor->name }}">
                </div>
              </div>
            @endif
          @endforeach
        </div>

      </div>

    </section>

    <!--==========================
      F.A.Q Section
    ============================-->
    <section id="faq" class="wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>F.A.Q </h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-9">
              <ul id="faq-list">
                @foreach ($faqs as $key => $faq)
                  <li>
                    <a data-toggle="collapse" class="collapsed" href="#faq{{ $loop->index }}">{{ $faq->name }} <i class="fa fa-minus-circle"></i></a>
                    <div id="faq{{ $loop->index }}" class="collapse" data-parent="#faq-list">
                      {!! $faq->value !!}
                    </div>
                  </li>
                @endforeach
              </ul>
          </div>
        </div>

      </div>

    </section>

    <!--==========================
      Subscribe Section
    ============================-->
    <!-- <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Apa Kata Mereka?</h2>
          <p>Pendapat mereka tentang kajian di P.I.S</p>
        </div>

        <form method="POST" action="#">
          <div class="form-row justify-content-center">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Enter your Email">
            </div>
            <div class="col-auto">
              <button type="submit">Subscribe</button>
            </div>
          </div>
        </form>

      </div>
    </section> -->

    <!--==========================
      Buy Ticket Section
    ============================-->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Kontak Kami</h2>
          <p>Apabila ada pertanyaan/masukan/sekedar sharing, silahkan hubungi kami di kontak berikut.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Alamat</h3>
              <address>{!! nl2br(App\Http\Controllers\Controller::getConfig('address')) !!}</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Telepon</h3>
              <p><a href="tel:{{ App\Http\Controllers\Controller::getConfig('phone') }}">{{ App\Http\Controllers\Controller::getConfig('phone') }}</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:{{ App\Http\Controllers\Controller::getConfig('email') }}">{{ App\Http\Controllers\Controller::getConfig('email') }}</a></p>
            </div>
          </div>

        </div>

        <!-- <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div> -->

      </div>
    </section><!-- #contact -->

  </main>
@endsection
