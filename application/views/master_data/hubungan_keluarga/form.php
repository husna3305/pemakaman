  <?php 
  $disabled_preview = '';
  if ($mode=='insert') {
    $disabled_preview = 'disabled';
  }
  $disabled = '';
  if ($mode=='detail') {
    $disabled='disabled';
  }
  ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                &nbsp;<a href="<?= site_url(get_slug()) ?>" class="btn btn-danger btn-sm"><i class="fa fa-back"></i> Kembali</a>
              </div>
              <!-- /.card-header -->
              <form class="form-horizontal" id="form_">
                <div class="card-body">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nama Hubungan Keluarga (Latin) <span class='required'>*</span></label>
                          <div class="form-input">
                          <input type="text" class="form-control" id="nama_hubungan_latin" name='nama_hubungan_latin' required value="<?= isset($row)?$row->nama_hubungan_latin:''?>" <?=$disabled?> onkeypress="" style="text-transform:uppercase">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Nama Hubungan Keluarga (Mandarin) <span class='required'>*</span></label>
                          <div class="form-input">
                          <input type="text" class="form-control" id="nama_hubungan_mandarin" name='nama_hubungan_mandarin' required value="<?= isset($row)?$row->nama_hubungan_mandarin:''?>" <?=$disabled?> onkeypress="" style="text-transform:uppercase">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Urutan <span class='required'>*</span></label>
                          <div class="form-input">
                          <input type="number" class="form-control" id="urutan" name='urutan' required value="<?= isset($row)?$row->urutan:''?>" <?=$disabled?> onkeypress="" style="text-transform:uppercase">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="form-input">
                            <label>Aktif</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="flat-red" name="aktif" <?= isset($row)?$row->aktif==1?'checked':'':'checked'?>  <?=$disabled?>>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <?php  if ($mode!='detail') { ?>
                  <div class="card-footer">
                    <div class="row justify-content-center">
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" style="width:100%" id="submitButton" @click.prevent="submitForm">Simpan Data</button>
                      </div>
                    </div>
                  </div>
                <?php }?>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    var form_name = 'form_';
    var form_ = new Vue({
      el: '#'+form_name,
      data: {},
      methods: {
        submitForm: function(el) {
          $('#'+form_name).validate({
            highlight: function(element, errorClass, validClass) {
              var elem = $(element);
              if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
              } else {
                $(element).addClass('is-invalid');
              }
            },
            unhighlight: function(element, errorClass, validClass) {
              var elem = $(element);
              if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
              } else {
                $(element).removeClass('is-invalid');
              }
            },
            errorPlacement: function(error, element) {
              var elem = $(element);
              if (elem.hasClass("select2-hidden-accessible")) {
                element = $("#select2-" + elem.attr("id") + "-container").parent();
                error.insertAfter(element);
              } else {
                error.insertAfter(element);
              }
            }
          })
          if ($('#'+form_name).valid()) // check if form is valid
          {
            var values = new FormData($('#'+form_name)[0]);
            <?php if (isset($row)) { ?>
              values.append('id_hubungan', '<?= $row->id_hubungan ?>');
            <?php } ?>
            $.ajax({
              beforeSend: function() {
                $('#submitButton').html('<i class="fa fa-spinner fa-spin"></i> Process');
                $('#submitButton').attr('disabled', true);
              },
              enctype: 'multipart/form-data',
              url: '<?= site_url(get_controller().'/'.$form) ?>',
              type: "POST",
              data: values,
              processData: false,
              contentType: false,
              // cache: false,
              dataType: 'JSON',
              success: function(response) {
                $('#submitButton').html('Simpan Data');
                if (response.status == 1) {
                  window.location = response.url;
                } else {
                  toasts(response.tipe,response.judul,'',response.pesan);
                  $('#submitButton').attr('disabled', false);
                }
              },
              error: function() {
                toasts('danger','Peringatan','','Telah terjadi kesalahan. Silahkan refresh halaman');
                $('#submitButton').html('Simpan Data');
                $('#submitButton').attr('disabled', false);
              },
            });
          } else {
            toasts('warning','Peringatan','','Silahkan isi field required');
          }
        },
        showModalPreviewImages:function(el){
          alert('')
        }
      },
    });
  </script>