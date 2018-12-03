@extends('backend.template.app')
@section('title', 'Edit Event')
@section('title-bar-title', 'Edit Event')
{{-- @section('title-bar-description', 'Frequently Asked Questions') --}}

@section('content')
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
  @endif
  <div class="panel">
    <div class="panel-body text-right">
      <a href="{{ route('event.index') }}" class="btn btn-pill btn-default">
        <span class="icon icon-arrow-left"></span>
        Back
      </a>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="demo-form-wrapper">
            <form data-toggle="validator" class="form form-horizontal" action="{{ route('event.update', $event->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Status</label>
                <div class="col-sm-2">
                  <select class="form-control" name="status">
                    <option value="active" {{ $event->status == 'active' ? 'selected':'' }}>Active</option>
                    <option value="disabled" {{ $event->status == 'disabled' ? 'selected':'' }}>Disabled</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Location</label>
                <div class="col-sm-5">
                  <select class="form-control" name="location_id" required>
                    <option value="">Choose</option>
                    @foreach ($locations as $key => $location)
                      <option value="{{ $location->id }}"
                        {{ $event->location_id == $location->id ? 'selected':'' }}
                        >{{ $location->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Speaker</label>
                <div class="col-sm-5">
                  <select class="form-control" name="speaker_id" required>
                    <option value="">Choose</option>
                    @foreach ($speakers as $key => $speaker)
                      <option value="{{ $speaker->id }}"
                        {{ $event->speaker_id == $speaker->id ? 'selected':'' }}
                        >{{ $speaker->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Sponsor</label>
                <div class="col-sm-5">
                  <select class="form-control" name="sponsor_id">
                    <option value="">Choose</option>
                    @foreach ($sponsors as $key => $sponsor)
                      <option value="{{ $sponsor->id }}"
                        {{ $event->sponsor_id == $sponsor->id ? 'selected':'' }}
                        >{{ $sponsor->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Name</label>
                <div class="col-sm-9">
                  <input name="name" value="{{ $event->name }}" class="form-control" type="text" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">URL</label>
                <div class="col-sm-9">
                  <input name="url" value="{{ $event->url }}" class="form-control" type="url">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Video URL</label>
                <div class="col-sm-9">
                  <input name="video_url" value="{{ $event->video_url }}" class="form-control" type="url">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Dates</label>
                <div class="col-sm-9">
                  <div id="demo-timepicker-event" class="row gutter-xs">
                    <div class="col-xs-7 m-b">
                      <div class="input-with-icon">
                        <input name="date_from_date" value="{{ $event->date_from->format('Y-m-d') }}" class="form-control date start" type="text" autocomplete="off" placeholder="From date" required>
                        <span class="icon icon-calendar input-icon"></span>
                      </div>
                    </div>
                    <div class="col-xs-5 m-b">
                      <div class="input-with-icon">
                        <input name="date_from_time" value="{{ $event->date_from->format('H:i:s') }}" class="form-control time start" type="text" autocomplete="off" placeholder="From time" required>
                        <span class="icon icon-clock-o input-icon"></span>
                      </div>
                    </div>
                    <div class="col-xs-7">
                      <div class="input-with-icon">
                        <input name="date_to_date" value="{{ $event->date_to->format('Y-m-d') }}" class="form-control date end" type="text" autocomplete="off" placeholder="Until date">
                        <span class="icon icon-calendar input-icon"></span>
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="input-with-icon">
                        <input name="date_to_time" value="{{ $event->date_to->format('H:i:s') }}" class="form-control time end" type="text" autocomplete="off" placeholder="Until time">
                        <span class="icon icon-clock-o input-icon"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Description</label>
                <div class="col-sm-9">
                  <textarea name="description" class="form-control editor" rows="8" cols="80" required>{{ $event->description }}</textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Image</label>
                <div class="col-sm-9">
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
                      @if ($event->picture)
                        <li class="file" style="width: 25%;">
                          <div class="file-thumbnail" style="background-image: url({{asset($event->picture->file)}})"></div>
                          <div class="file-info">
                            <span class="file-ext">{{ $event->picture->extension }}</span>
                            <span class="file-name">{{ $event->picture->old_title }}.</span>
                            <input type="hidden" name="image" value="{{ $event->picture->id }}">
                          </div>
                          <button class="file-delete-btn delete" title="Delete" type="button">
                            <span class="icon icon-remove"></span>
                          </button>
                        </li>
                      @endif
                    </ul>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">&nbsp;</label>
                <div class="col-sm-9">
                  <button type="submit" class="btn btn-info btn-pill"><span class="icon icon-save"></span> Save</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('backend/js/demo.min.js') }}"></script>
  <script>
    var $datepair = $('#demo-timepicker-event'),
        $timepicker = $datepair.find('.time'),
        $datepicker = $datepair.find('.date');

    $timepicker.timepicker({
      'showDuration': true,
      'timeFormat': 'H:i:s',
      'scrollDefault': '15:30:00',
    });

    $datepicker.datepicker({
      'format': 'yyyy-mm-dd',
      'autoclose': true,
      'todayHighlight': true,
    });

    $datepair.datepair();
  </script>
@endsection
