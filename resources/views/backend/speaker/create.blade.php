@extends('backend.template.app')
@section('title', 'Add New Speakers')
@section('title-bar-title', 'Add New Speakers')
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
      <a href="{{ route('speaker.index') }}" class="btn btn-pill btn-default">
        <span class="icon icon-arrow-left"></span>
        Back
      </a>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div class="demo-form-wrapper">
            <form data-toggle="validator" class="form form-horizontal" action="{{ route('speaker.store') }}" method="post">
              {{ csrf_field() }}
              {{-- <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Status</label>
                <div class="col-sm-2">
                  <select class="form-control" name="status">
                    <option value="active">Active</option>
                    <option value="disabled">Disabled</option>
                  </select>
                </div>
              </div> --}}

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Name</label>
                <div class="col-sm-9">
                  <input name="name" class="form-control" type="text" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Address</label>
                <div class="col-sm-9">
                  <textarea name="address" class="form-control" rows="2" required></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Instagram URL</label>
                <div class="col-sm-9">
                  <input name="ig_url" class="form-control" type="url">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label" for="form-control-1">Description</label>
                <div class="col-sm-9">
                  <textarea name="description" class="form-control editor" rows="8" cols="80"></textarea>
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
