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
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kode Group <span class='required'>*</span></label>
                      <div class="form-input">
                        <input type="text" class="form-control" name='kode_group' required value='<?= $row->kode_group ?>' disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama Group <span class='required'>*</span></label>
                      <div class="form-input">
                        <input type="text" class="form-control" name='nama_group' required value='<?= $row->nama_group ?>' disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <?php
                  $all_links = all_links();
                  function create_menu($data, $menus, $all_links, $id_group)
                  {
                    // send_json($data);
                    $html = '';
                    //Cek Apakah Parent Menu Atau Separated Menu
                    $url = $data['slug'] == NULL ? '#' : site_url($data['slug']);
                    $offset = $data['level'] > 1 ? $data['level'] - 1 : 0;
                    $grid = 12 - $offset;
                    $bold_text = '';
                    if ($data['controller'] == NULL || $data['tot_child'] > 0) {
                      $bold_text = 'font-weight:600';
                    }
                    $separator = '';
                    if ($data['controller'] == NULL && $data['tot_child'] == 0) {
                      $separator = ' <i>(Separator)</i>';
                    }
                    $space = '';
                    if ($data['level'] > 1) {
                      for ($i = 0; $i < $data['level']; $i++) {
                        $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                      }
                      $space .= "> ";
                    }
                    $exp_link = explode(',', $data['links_menu']);
                    $html .= "<tr>
                    <td>$space{$data['nama_menu']}</td>";
                    $set_links = [];
                    foreach ($all_links as $key => $al) {
                      if (in_array($key, $exp_link)) {
                        $checked = cekAkses($id_group, $data['id_menu'], $key) == 1 ? 'checked' : '';
                        $html .= "<td align='center'><input type='checkbox' class='$key' name='chk_{$data['id_menu']}_$key' $checked></td>";
                        $set_links[] = ['link' => $key, 'akses' => 0];
                      } else {
                        $html .= "<td></td>";
                      }
                    }
                    $html .= "</tr>";
                    if ($data['tot_child'] > 0) {
                      $level = $data['level'] + 1;
                      $child = search_array($menus, ['level' => $level, 'parent_id_menu' => $data['id_menu']]);
                      if (count($child) > 0) {
                        foreach ($child as $chld) {
                          $html .= create_menu($chld, $menus, $all_links, $id_group);
                        }
                      }
                    }
                    return $html;
                  } ?>
                  <div class="table-responsive">
                    <table class='table table-condensed table-bordered'>
                      <thead>
                        <th>List Menu</th>
                        <?php
                        foreach ($all_links as $key => $lk) { ?>
                          <th style="text-align:center"><?= $lk['deskripsi'] ?></th>
                        <?php } ?>
                      </thead>
                      <tbody>
                        <?php
                        $lvl1 = search_array($menus, ['level' => 1]);
                        foreach ($lvl1 as $l1) {
                          echo create_menu($l1, $menus, $all_links, $row->id_group);
                        } ?>
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="row justify-content-center">
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" style="width:100%" id="submitButton" @click.prevent="submitForm">Simpan Data</button>
                  </div>
                </div>
              </div>
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
            Swal.fire({
              title: 'Apakah Anda Yakin ?',
              showCancelButton: true,
              confirmButtonText: 'Simpan',
              cancelButtonText: 'Batal',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                var values = new FormData($('#'+form_name)[0]);
                values.append('id_group', <?= $row->id_group ?>);
                
                $.ajax({
                  beforeSend: function() {
                    $('#submitButton').html('<i class="fa fa-spinner fa-spin"></i> Process');
                    $('#submitButton').attr('disabled', true);
                  },
                  enctype: 'multipart/form-data',
                  url: '<?= site_url(get_controller() . '/saveRoleAkses') ?>',
                  type: "POST",
                  data: values,
                  processData: false,
                  contentType: false,
                  // cache: false,
                  dataType: 'JSON',
                  success: function(response) {
                    if (response.status == 1) {
                      window.location = response.url;
                    } else {
                      toasts(response.tipe,response.judul,'',response.pesan);
                      $('#submitButton').attr('disabled', false);
                    }
                    $('#submitButton').html('Simpan Data');
                  },
                  error: function() {
                    toasts('danger','Peringatan','','Telah terjadi kesalahan. Silahkan refresh halaman');
                    $('#submitButton').html('Simpan Data');
                    $('#submitButton').attr('disabled', false);
                  }
                });
              } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info')
              }
            })
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