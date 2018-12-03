@extends('backend.template.app')
@section('title', 'Web Configuration')
@section('title-bar-title', 'Web Configuration')
{{-- @section('title-bar-description', 'Web Configuration') --}}

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="demo-form-wrapper">
        <form data-toggle="validator" action="{{ route('configuration.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label">Site Name</label>
            <input class="form-control" type="text" name="site_name" value="{{ old('site_name') ? old('site_name') : App\Http\Controllers\Controller::getConfig('site_name') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') ? old('title') : App\Http\Controllers\Controller::getConfig('title') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">Sub Title</label>
            <input class="form-control" type="text" name="subtitle" value="{{ old('subtitle') ? old('subtitle') : App\Http\Controllers\Controller::getConfig('subtitle') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">URL Video Intro</label>
            <input class="form-control" type="text" name="video_intro" value="{{ old('video_intro') ? old('video_intro') : App\Http\Controllers\Controller::getConfig('video_intro') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">URL Hashtag</label>
            <input class="form-control" type="text" name="hashtag_url" value="{{ old('hashtag_url') ? old('hashtag_url') : App\Http\Controllers\Controller::getConfig('hashtag_url') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">Hashtags</label>
            <input class="form-control" type="text" name="hashtags" value="{{ old('hashtags') ? old('hashtags') : App\Http\Controllers\Controller::getConfig('hashtags') }}" required>
            <span class="help-block">Pisahkan dengan koma</span>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') ? old('email') : App\Http\Controllers\Controller::getConfig('email') }}" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label">Phone</label>
            <input class="form-control" type="text" name="phone" value="{{ old('phone') ? old('phone') : App\Http\Controllers\Controller::getConfig('phone') }}" required>
          </div>
          <div class="form-group">
            <label class="control-label">Address</label>
            <textarea class="form-control" name="address" rows="3" required>{{ old('address') ? old('address') : App\Http\Controllers\Controller::getConfig('address') }}</textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required>{{ old('description') ? old('description') : App\Http\Controllers\Controller::getConfig('description') }}</textarea>
          </div>
          <div class="form-group">
            <label class="control-label">About Us</label>
            <textarea class="form-control" name="aboutus" rows="10" required>{{ old('aboutus') ? old('aboutus') : App\Http\Controllers\Controller::getConfig('aboutus') }}</textarea>
          </div>
          <hr>
          <div class="form-group">
            <label class="control-label">URL Instagram</label>
            <input class="form-control" type="text" name="ig_url" value="{{ old('ig_url') ? old('ig_url') : App\Http\Controllers\Controller::getConfig('ig_url') }}" required>
          </div>
          <hr>
          <div class="form-group">
            <label class="control-label">Logo</label>
            <button
              type="button" class="btn btn-danger btn-pill"
              data-toggle="modal" data-target="#mediaModal"
              data-limit="1"
              data-name="image"
              data-container="view"
            >
              <span class="icon icon-image"></span>
              Add Image
            </button>
              <ul id="view" class="file-list view" style="margin-top: 20px;">
                @if ($image)
                  <li class="file" style="width: 25%;">
                    <div class="file-thumbnail" style="background-image: url({{asset($image->file)}})"></div>
                    <div class="file-info">
                      <span class="file-ext">{{ $image->extension }}</span>
                      <span class="file-name">{{ $image->old_title }}.</span>
                      <input type="hidden" name="image" value="{{ $image->id }}">
                    </div>
                    <button class="file-delete-btn delete" title="Delete" type="button">
                      <span class="icon icon-remove"></span>
                    </button>
                  </li>
                @endif
              </ul>
            <span class="help-block">Header and Footer Icon</span>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
