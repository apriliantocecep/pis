@extends('backend.template.app')
@section('title', 'Edit Sponsor')
@section('title-bar-title', 'Edit Sponsor')
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
      <a href="{{ route('sponsor.index') }}" class="btn btn-pill btn-default">
        <span class="icon icon-arrow-left"></span>
        Back
      </a>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="demo-form-wrapper">
            <form data-toggle="validator" class="form form-horizontal" action="{{ route('sponsor.update', $sponsor->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Status</label>
                <div class="col-sm-2">
                  <select class="form-control" name="status">
                    <option value="active" {{ $sponsor->status == 'active' ? 'selected':'' }}>Active</option>
                    <option value="disabled" {{ $sponsor->status == 'disabled' ? 'selected':'' }}>Disabled</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Name</label>
                <div class="col-sm-9">
                  <input name="name" value="{{ $sponsor->name }}" class="form-control" type="text" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">URL</label>
                <div class="col-sm-9">
                  <input name="url" value="{{ $sponsor->url }}" class="form-control" type="url">
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
                      @if ($sponsor->picture)
                        <li class="file" style="width: 25%;">
                          <div class="file-thumbnail" style="background-image: url({{asset($sponsor->picture->file)}})"></div>
                          <div class="file-info">
                            <span class="file-ext">{{ $sponsor->picture->extension }}</span>
                            <span class="file-name">{{ $sponsor->picture->old_title }}.</span>
                            <input type="hidden" name="image" value="{{ $sponsor->picture->id }}">
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
