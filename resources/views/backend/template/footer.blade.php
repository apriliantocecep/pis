<div class="layout-footer">
  <div class="layout-footer-body">
    <small class="version">Thank you fo using our services. Made with <span class="icon icon-heart text-danger"></span> by us. </small>
    <small class="copyright">2018 &copy; Sibatur By <a href="http://www.sibatur.com/">Sibatur.com</a></small>
  </div>
</div>

<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 0px solid #fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="mediaModalLabel">Media</h4>
      </div>
      <div class="modal-body" style="padding: 0;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Gallery</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Upload</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding: 15px;max-height:500px;overflow:scroll;">
          <div role="tabpanel" class="tab-pane active" id="home">
            <table class="table table-striped" id="tableUpload">
              <thead>
                <tr>
                  <th style="width: 50px;" class="">Image</th>
                  <th style="width: 230px;">Name</th>
                  <th style="width: 55px;"> </th>
                </tr>
              </thead>

              <tbody>
              </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
            <input type="file" name="files" accept="image/*">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="buttonUploadAddView" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
