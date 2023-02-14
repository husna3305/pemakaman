<?php
$disabled_preview = '';
if ($mode == 'insert') {
  $disabled_preview = 'disabled';
}
$disabled = '';
if ($mode == 'detail') {
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
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Blok <span class='required'>*</span></label>
                    <div class="form-input">
                      <select class="form-control" style="width: 100%;" id='blok' name='blok' required <?= $disabled ?>>
                        <?php if (isset($row)) { ?>
                          <option value='<?= $row->blok ?>'><?= $row->blok ?></option>
                        <?php } else { ?>
                          <option value=''>- Pilih -</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>No. Urut <span class='required'>*</span></label>
                    <div class="form-input">
                      <input type="text" class="form-control numeric-only" name='no_urut' value="<?= isset($row) ? $row->no_urut : '' ?>" <?= $disabled ?> required maxlength="3">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Mendiang (Latin)<span class='required'>*</span></label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="nama_mendiang_latin" name='nama_mendiang_latin' required value="<?= isset($row) ? $row->nama_mendiang_latin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Mendiang (Mandarin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="nama_mendiang_mandarin" name='nama_mendiang_mandarin' value="<?= isset($row) ? $row->nama_mendiang_mandarin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Marga (Latin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="marga_latin" name='marga_latin'  value="<?= isset($row) ? $row->marga_latin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Marga Mendiang (Mandarin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="marga_mandarin" name='marga_mandarin'  value="<?= isset($row) ? $row->marga_mandarin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Marga Suami/Istri (Latin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="marga_suami_istri_latin" name='marga_suami_istri_latin'  value="<?= isset($row) ? $row->marga_suami_istri_latin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Marga Suami/Istri (Mandarin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="marga_suami_istri_mandarin" name='marga_suami_istri_mandarin'  value="<?= isset($row) ? $row->marga_suami_istri_mandarin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Tanggal Wafat (Masehi)</label>
                    <div class="form-input">
                      <input type="text" class="form-control datepicker" id="tgl_wafat_masehi" name='tgl_wafat_masehi'  value="<?= isset($row) ? $row->tgl_wafat_masehi : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Tanggal Wafat (Imlek)</label>
                    <div class="">
                      <span class="form-input">
                        <input type="text" class="form-control" name='tgl_wafat_imlek_tanggal'  value="<?= isset($row) ? $row->tgl_wafat_imlek_tanggal : '' ?>" <?= $disabled ?> style="text-transform:uppercase;width:25%;display:inline" placeholder="Tanggal">
                      </span>
                      <span class="form-input">
                        <input type="text" class="form-control" name='tgl_wafat_imlek_bulan' value="<?= isset($row) ? $row->tgl_wafat_imlek_bulan : '' ?>" <?= $disabled ?> style="text-transform:uppercase;width:25%;display:inline" placeholder="Bulan">
                      </span>
                      <span class="form-input">
                        <input type="text" class="form-control" name='tgl_wafat_imlek_tahun' value="<?= isset($row) ? $row->tgl_wafat_imlek_tahun : '' ?>" <?= $disabled ?> style="text-transform:uppercase;width:45%;display:inline" placeholder="Tahun">
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="form-input">
                      <select class="form-control" style="width: 100%;" id='jk' name='jk' <?= $disabled ?>>
                        <option value=''>- Pilih -</option>
                        <option <?= isset($row)?$row->jk=='Laki-laki'?'selected':'':'';?> >Laki-laki</option>
                        <option <?= isset($row)?$row->jk=='Perempuan'?'selected':'':'';?> >Perempuan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Suku</label>
                    <div class="form-input">
                      <select class="form-control" style="width: 100%;" id='id_suku' name='id_suku' <?= $disabled ?>>
                        <?php if (isset($row)) { ?>
                          <option value='<?= $row->id_suku ?>'><?= $row->nama_suku_latin.' ( '.$row->nama_suku_mandarin.' )' ?></option>
                        <?php } else { ?>
                          <option value=''>- Pilih -</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kampung Kelahiran (Latin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="kampung_kelahiran_latin" name='kampung_kelahiran_latin'  value="<?= isset($row) ? $row->kampung_kelahiran_latin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kampung Kelahiran (Mandarin)</label>
                    <div class="form-input">
                      <input type="text" class="form-control" id="kampung_kelahiran_mandarin" name='kampung_kelahiran_mandarin'  value="<?= isset($row) ? $row->kampung_kelahiran_mandarin : '' ?>" <?= $disabled ?> style="text-transform:uppercase">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Upload Foto Makam <?=$mode=='insert'?"<span class='required'>*</span>":''?></label>
                    <div class="form-input">
                      <div class="input-group">
                        <input type="file" class="form-control" name="foto_makam" <?= $disabled ?> <?=$mode=='insert'?'required':''?>>
                        <?php if ($mode != 'insert') { ?>
                          <span class="input-group-append">
                            <?php
                            $url = "";
                            if ((string)$row->foto_makam!='') { 
                              $url = $row->foto_makam;
                            ?>
                              <button type="button" class="btn btn-info" onclick="showModalPreviewImage('<?= base_url($url) ?>')" <?= $disabled_preview ?>>Lihat</button>
                            <?php ?>
                            <?php }
                            ?>
                          </span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header-small">Keluarga / Ahli Waris</div>
                    <div class="card-body">
                      <table class='table table-bordered table-hover table-striped table-condensed'>
                        <thead>
                          <th style="width:6%">No.</th>
                          <th>Nama Keluarga / Ahli Waris (Latin)</th>
                          <th>Nama Keluarga / Ahli Waris (Mandarin)</th>
                          <th>Hubungan</th>
                          <th v-if="mode=='insert' || mode=='edit'" width='5%'>Aksi</th>
                        </thead>
                        <tbody>
                          <tr v-for="(dt, index) of hubungan_keluarga">
                            <td>{{index+1}}</td>
                            <td>
                              <input type="text" class="form-control form-control-sm" v-model="dt.nama_keluarga_latin" <?= $disabled ?>>
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm" v-model="dt.nama_keluarga_mandarin" <?= $disabled ?>>
                            </td>
                            <td>
                              <select class="form-control form-control-sm" v-model="dt.id_hubungan" <?= $disabled ?>>
                                <option v-for="option in option_hubungan" v-bind:value="option">{{ option.text }}</option>
                              </select>
                            </td>
                            <td align='center' v-if="mode=='insert' || mode=='edit'">
                              <button type='button' class='btn btn-danger btn-xs' @click.prevent="delDetails(index)"><i class='fa fa-trash'></i></button>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr v-if="mode=='insert' || mode=='edit'">
                            <td></td>
                            <td>
                              <input type="text" class="form-control form-control-sm" v-model="dtl.nama_keluarga_latin">
                            </td>
                            <td>
                              <input type="text" class="form-control form-control-sm" v-model="dtl.nama_keluarga_mandarin">
                            </td>
                            <td>
                              <select class="form-control form-control-sm" v-model="dtl.id_hubungan">
                                <option v-for="option in option_hubungan" v-bind:value="option">{{ option.text }}</option>
                              </select>
                            </td>
                            <td align='center'>
                              <button type='button' class='btn btn-primary btn-sm' @click.prevent="addDetails()"><i class='fa fa-plus'></i></button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="row justify-content-center">
                <div class="col-sm-2" v-if="mode=='edit' || mode=='insert'">
                  <button type="button" class="btn btn-primary" style="width:100%" id="submitButton" @click.prevent="submitForm">Simpan Data</button>
                </div>
                <div class="col-sm-2" v-if="mode=='kirim_request'">
                  <button type="button" class="btn btn-primary" style="width:100%" id="btnKirimRequest" @click.prevent="kirimRequest">Kirim Request</button>
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
  <?php
  $this->load->view('additionals/dropdown_blok');
  $this->load->view('additionals/dropdown_suku');
  $this->load->view('additionals/modal_preview_image');
  ?>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  var form_name = 'form_';
  var form_ = new Vue({
    el: '#' + form_name,
    data: {
      mode: '<?= $mode ?>',
      dtl: {
        nama_keluarga_latin: '',
        nama_keluarga_mandarin: '',
        id_hubungan: '',
      },
      hubungan_keluarga: <?= isset($hubungan_keluarga) ? json_encode($hubungan_keluarga) : '[]' ?>,
      option_hubungan: <?= isset($option_hubungan) ? json_encode($option_hubungan) : '[]' ?>,
    },
    methods: {
      addDetails: function() {
        if (this.dtl.nama_keluarga_latin === '' || this.dtl.nama_keluarga_mandarin === '' || this.dtl.id_hubungan === '') {
          toasts('danger', 'Peringatan', '', 'Silahkan isi data dengan lengkap');
          return false;
        }
        this.hubungan_keluarga.push(this.dtl);
        this.resetDetail();
      },
      resetDetail: function() {
        this.dtl = {
          nama_keluarga_latin: '',
          nama_keluarga_mandarin: '',
          id_hubungan: '',
        }
      },
      delDetails: function(index) {
        this.hubungan_keluarga.splice(index, 1);
      },
      submitForm: function(el) {
        $('#' + form_name).validate({
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
        if ($('#' + form_name).valid()) // check if form is valid
        {
          Swal.fire({
            title: 'Apakah Anda Yakin ?',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              var values = new FormData($('#' + form_name)[0]);
              <?php if (isset($row)) { ?>
                values.append('id_pemakaman', '<?= $row->id_pemakaman ?>');
              <?php } ?>
              values.append('hubungan_keluarga', JSON.stringify(form_.hubungan_keluarga));
              $.ajax({
                beforeSend: function() {
                  $('#submitButton').html('<i class="fa fa-spinner fa-spin"></i> Process');
                  $('#submitButton').attr('disabled', true);
                },
                enctype: 'multipart/form-data',
                url: '<?= site_url(get_controller() . '/' . $form) ?>',
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
                    toasts(response.tipe, response.judul, '', response.pesan);
                    $('#submitButton').attr('disabled', false);
                  }
                },
                error: function() {
                  toasts('danger', 'Peringatan', '', 'Telah terjadi kesalahan. Silahkan refresh halaman');
                  $('#submitButton').html('Simpan Data');
                  $('#submitButton').attr('disabled', false);
                },
              });
            } else if (result.isDenied) {
              // Swal.fire('Changes are not saved', '', 'info')
            }
          })
        } else {
          toasts('warning', 'Peringatan', '', 'Silahkan isi field required');
        }
      },
    },
  });
</script>