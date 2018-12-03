<!--==========================
  Intro Section
============================-->
<section id="intro">
  <div class="intro-container wow fadeIn">
    <h1 class="mb-4 pb-0">
      {{ App\Http\Controllers\Controller::getConfig('site_name') }}
      <br>
      <!-- <span>Marketing</span> Conference -->
      <span>{{ App\Http\Controllers\Controller::getConfig('title') }}</span>
    </h1>
    <p class="mb-4 pb-0">{{ App\Http\Controllers\Controller::getConfig('subtitle') }}</p>
    <p class="mb-4 pb-0">
      <small>
        @php
          $explodedTags = explode(',', App\Http\Controllers\Controller::getConfig('hashtags'));
        @endphp
        @foreach ($explodedTags as $key => $tag)
          <a target="_blank" href="{{ App\Http\Controllers\Controller::getConfig('hashtag_url').$tag }}">#{{ trim($tag) }}</a>
        @endforeach
      </small>
    </p>
    <a href="{{ App\Http\Controllers\Controller::getConfig('video_intro') }}" class="venobox play-btn mb-4" data-vbtype="video"
      data-autoplay="true"></a>
    <a href="#about" class="about-btn scrollto">Lihat kajian minggu ini</a>
  </div>
</section>
