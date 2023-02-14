<div class="modal fade" id="modalPreviewImage">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="file_image"></div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <script>
    function showModalPreviewImage(url) {
      $('#file_image').html('');
      $('#file_image').append('<embed id="file_image" src="' + url + '" frameborder="0" width="100%">')
      $("#modalPreviewImage").modal('show');
    }
  </script>