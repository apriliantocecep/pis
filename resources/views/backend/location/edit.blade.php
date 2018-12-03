@extends('backend.template.app')
@section('title', 'EditLocation')
@section('title-bar-title', 'EditLocation')
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
      <a href="{{ route('location.index') }}" class="btn btn-pill btn-default">
        <span class="icon icon-arrow-left"></span>
        Back
      </a>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="demo-form-wrapper">
            <form data-toggle="validator" class="form form-horizontal" action="{{ route('location.update', $location->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Status</label>
                <div class="col-sm-2">
                  <select class="form-control" name="status">
                    <option value="active" {{ $location->status == 'active' ? 'selected':'' }}>Active</option>
                    <option value="disabled" {{ $location->status == 'disabled' ? 'selected':'' }}>Disabled</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Name</label>
                <div class="col-sm-9">
                  <input name="name" value="{{ $location->name }}" class="form-control" type="text" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Address</label>
                <div class="col-sm-9">
                  <textarea name="address" class="form-control" rows="3" required>{{ $location->address }}</textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Google Maps Address</label>
                <div class="col-sm-9">
                  <textarea name="google_map_address" class="form-control" rows="3" required>{{ $location->google_map_address }}</textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Google Maps Embed</label>
                <div class="col-sm-9">
                  <textarea name="google_map_embed" class="form-control" rows="3" required>{{ $location->google_map_embed }}</textarea>
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
                      @if ($location->picture)
                        <li class="file" style="width: 25%;">
                          <div class="file-thumbnail" style="background-image: url({{asset($location->picture->file)}})"></div>
                          <div class="file-info">
                            <span class="file-ext">{{ $location->picture->extension }}</span>
                            <span class="file-name">{{ $location->picture->old_title }}.</span>
                            <input type="hidden" name="image" value="{{ $location->picture->id }}">
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

@endsection
