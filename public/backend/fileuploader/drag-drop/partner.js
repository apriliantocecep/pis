$(document).ready(function() {

	var base_url = $("#base_url").data('url');

	// partner
	$('input[name="files"].partner').fileuploader({
        changeInput: '<div class="fileuploader-input">' +
					      '<div class="fileuploader-input-inner">' +
						      '<img src="'+base_url+'assets/backend/plugins/fileuploader/images/fileuploader-dragdrop-icon.png">' +
							  '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
							  '<p>or</p>' +
							  '<div class="btn btn-info btn-pill btn-lg"><span>Browse Files</span></div>' +
						  '</div>' +
					  '</div>',
        theme: 'dragdrop',
		upload: {
            url: base_url+'uploader/partner',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function(result, item) {
                var data = JSON.parse(result);
                
				// if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
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
			$.post(base_url+'uploader/partner_delete', {
				file: item.name
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