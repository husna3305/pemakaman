  <?php 
  $disabled_preview = '';
  if ($mode=='insert') {
    $disabled_preview = 'disabled';
  }
  $disabled = '';
  if ($mode=='detail') {
    $disabled = 'disabled';
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
                          <label>User Groups <span class='required'>*</span></label>
                          <div class="form-input">
                            <select class="form-control" style="width: 100%;" id='id_group' name='id_group' required <?=$disabled?>>
                              <?php if (isset($row)) { ?>
                                <option value='<?=$row->id_group?>'><?=$row->nama_group?></option>
                              <?php }else{ ?>
                                <option value=''>- Pilih -</option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Username <span class='required'>*</span></label>
                          <div class="form-input">
                          <input type="text" class="form-control" id="username" name='username' required value="<?= isset($row)?$row->username:''?>" <?=$disabled?>>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Email <span class='required'>*</span></label>
                          <div class="form-input">
                            <input type="email" class="form-control" id="email" name='email' required value="<?= isset($row)?$row->email:''?>" <?=$disabled?>>
                          </div>
                        </div>
                        <?php if ($mode!='detail') {?>
                          <div class="form-group">
                            <label>Password <?= $mode=='insert'?"<span class='required'>*</span>":''?></label>
                            <div class="form-input">
                              <input type="password" class="form-control" name='password' id='password' <?= $mode=='insert'?'required':''?>>
                              <?php if ($mode=='edit') { ?>
                                <label class="label-text-info"><i>Kosongkan jika tidak ingin mengganti password</i></label>
                              <?php } ?>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="form-group">
                          <label>Nama Lengkap <span class='required'>*</span></label>
                          <div class="form-input">
                            <input type="text" class="form-control" name='nama_lengkap' required value="<?= isset($row)?$row->nama_lengkap:''?>" <?=$disabled?>>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>No. HP <span class='required'>*</span></label>
                          <div class="form-input">
                            <input type="text" class="form-control" name='no_hp' required onkeypress="only_number(event)" value="<?= isset($row)?$row->no_hp:''?>" <?=$disabled?>>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Images <span class='required'>*</span></label>
                          <div class="form-input">
                              <div class="input-group">
                                <input type="file" class="form-control" name="images" <?=$disabled?>>
                                <span class="input-group-append">
                                  <?php 
                                    $url = "";
                                    if (isset($row)) {
                                      $url = $row->img_big;
                                    }
                                  ?>
                                  <button type="button" class="btn btn-info" onclick="showModalPreviewImage('<?=base_url($url)?>')" <?=$disabled_preview?>>Lihat</button>
                                </span>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-input">
                            <label>Aktif</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" class="flat-red" name="aktif" <?= isset($row)?$row->aktif==1?'checked':'':'checked'?> <?=$disabled?>>
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
  <?php 
    $data['data'] = ['selectUserGroup'];
    $this->load->view('additionals/dropdown_user_group', $data); 
    $this->load->view('additionals/modal_preview_image'); 
  ?>
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
              values.append('id_user', '<?= $row->id_user ?>');
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