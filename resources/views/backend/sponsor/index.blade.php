@extends('backend.template.app')
@section('title', 'Sponsors')
@section('title-bar-title', 'Sponsors')
{{-- @section('title-bar-description', 'Pembicara') --}}

@section('content')
  <div class="panel">
    <div class="panel-body text-right">
      <a href="{{ route('sponsor.create') }}" class="btn btn-pill btn-success">
        <span class="icon icon-plus"></span>
        Add New
      </a>
    </div>
    <div class="panel-body">
      <table class="table table-striped" id="table">
        <thead>
          <tr>
            <th style="width: 100px;">Image</th>
            <th>Name</th>
            <th>URL</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      window.table = $('#table').DataTable({
        autoWidth: false,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Search...',
            lengthMenu: '<span>Show:</span> _MENU_',
            // paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "{{ route('sponsor.datatable') }}",
          "type": "POST",
          "data": {
            "_token": "{{ csrf_token() }}"
          },
        },
        // "pageLength": 1,
        ordering:  false,
        columnDefs: [
            // { targets: [0], visible: false },
        ],
      });
    });

    function deleteItem(id) {
    var items = [];
    items.push(id);

    if ( confirm("Delete item?") ) {
      $.ajax({
        type: "POST",
        url: "{{ route('sponsor.delete') }}",
        data: {
          data_ids:items,
          _token: "{{ csrf_token() }}"
        },
        success: function(result) {
          table.draw(); // redrawing datatable
          // window.reload();
        },
        error: function(e) {
          alert("Error " + e.status + " - " + e.statusText)
        },
        async:false
      });
    } else {
      return false;
    }
  }
  </script>
@endsection
