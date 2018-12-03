<script src="{{ asset('backend/js/vendor.min.js') }}"></script>
<script src="{{ asset('backend/js/elephant.min.js') }}"></script>
<script src="{{ asset('backend/js/application.min.js') }}"></script>

<script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
<script>
  // init
  tinymce.init({
    remove_script_host : false,
    convert_urls : false,
    mode : "exact",
    selector: ".editor",
    theme: "modern",
    // update validation status on change
    onchange_callback: function(editor) {
      tinyMCE.triggerSave();
      $("#" + editor.id).valid();
    },
    entity_encoding : "raw",
    height: 350,
    plugins: [
      "example filemanager advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
      "code searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor"
     ],
     image_advtab: true,
     // content_css: "css/content.css",
     toolbar: "filemanager undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print preview code fullpage | forecolor backcolor emoticons"
  });
</script>

<script src="{{ asset('backend/fileuploader/jquery.fileuploader.min.js') }}"></script>
<script>
$(document).ready(function() {
  window.tableUpload = $('#tableUpload').DataTable({
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
      "url": "{{ route('upload.datatable') }}",
      "type": "POST",
      "data": function ( d ) {
        d._token = "{{ csrf_token() }}";

        // Retrieve dynamic parameters
        var dt_params = $('#tableUpload').data('dt_params');
        // Add dynamic parameters to the data object sent to the server
        if(dt_params){ $.extend(d, dt_params); }
      },
    },
    // "pageLength": 1,
    ordering:  false,
    columnDefs: [
        // { targets: [0], visible: false },
    ],
  });

  // Checked checkbox on datatable row selection
  $('#tableUpload tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    var status = $(this).find(':checkbox').prop("checked")
    $(this).find(':checkbox').prop("checked", !status)

    var status2 = $(this).find(':radio').prop("checked")
    $(this).find(':radio').prop("checked", !status2)
  });

  // modal
  $('#mediaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var limit = button.data('limit');
    var name = button.data('name');
    var container = button.data('container');

    var modal = $(this);
    $("#buttonUploadAddView").attr('data-name', name);
    $("#buttonUploadAddView").attr('data-container', container);

    $('#tableUpload').data('dt_params', { limit: limit });
    window.tableUpload.draw();
  });

  // button add
  $("#buttonUploadAddView").on("click", function(){
    var statusCheckbox = $('#tableUpload tbody').find(':checkbox').prop("checked");
    var statusRadio    = $('#tableUpload tbody').find(':radio').prop("checked");
    var fileLength     = $("li.file").length;
    var name           = $(this).data("name");
    var container      = $(this).data("container");

    $('#mediaModal').modal('hide');

    // if type checkbox
    if (statusCheckbox) {
      console.log('checkbox');
    } else {
        // type radio
        var id = $("input[name='radio']:checked").val();
        if (id) {
          var url = "{{ route('upload.get', ':id') }}"
          url = url.replace(':id', id);
          $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
              var render = '';
              render += '<li class="file" style="width: 25%;">';
              render += '    <div class="file-thumbnail" style="background-image: url({{asset('/')}}'+result.file+')"></div>';
              render += '    <div class="file-info">';
              render += '      <span class="file-ext">'+result.extension+'</span>';
              render += '      <span class="file-name">'+result.old_title+'.</span>';
              render += '      <input type="hidden" name="'+name+'" value="'+id+'">';
              render += '    </div>';
              render += '  <button class="file-delete-btn delete" title="Delete" type="button">';
              render += '    <span class="icon icon-remove"></span>';
              render += '  </button>';
              render += '</li>';
              if (fileLength < 1) {
                $("#"+container).append(render);
              }

              $(".file-delete-btn").on("click", function(){
                $(".file").remove();
              });
            }
          });
        }
    }
  });

  $(".file-delete-btn").on("click", function(){
    $(".file").remove();
  });

	$('input[name="files"]').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
					      '<div class="fileuploader-input-inner">' +
						      '<img src="/backend/fileuploader/images/fileuploader-dragdrop-icon.png">' +
							  '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
							  '<p>or</p>' +
							  '<div class="btn btn-info btn-pill btn-lg"><span>Browse Files</span></div>' +
						  '</div>' +
					  '</div>',
        theme: 'dragdrop',
		upload: {
            url: '{{ route('upload.up') }}',
            data: {
              "_token": "{{ csrf_token() }}"
            },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: function(item) {
				},
            onSuccess: function(result, item) {
                var data = result;
                // console.log(result);
				// if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                    window.tableUpload.draw();
                }

				// if warnings
				if (data.hasWarnings) {
					for (var warning in data.warnings) {
						alert(data.warnings);
					}

					item.html.removeClass('upload-successful').addClass('upload-failed');
					// go out from success function by calling onError function
					// in this case we have a animation there
					// you can also response in PHP with 404
					return this.onError ? this.onError(item) : null;
				}

                item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item) {
				var progressBar = item.html.find('.progress-bar2');

				if(progressBar.length > 0) {
					progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
					item.html.find('.progress-bar2').fadeOut(400);
				}

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
		onRemove: function(item) {
			$.post('{{ route('upload.down') }}', {
				file: item.name,
        "_token": "{{ csrf_token() }}"
			}).done(function(data){
        window.tableUpload.draw();
      });
		},
		captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here',
            errors: {
				filesLimit: 'Only ${limit} files are allowed to be uploaded.',
				filesType: 'Only ${extensions} files are allowed to be uploaded.',
				fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
				filesSizeAll: 'Files that you choosed are too large! Please upload files up to ${maxSize} MB.',
				fileName: 'File with the name ${name} is already selected.',
				folderUpload: 'You are not allowed to upload folders.'
			}
        },
	});

});
</script>
@yield('script')
