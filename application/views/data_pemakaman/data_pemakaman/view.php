    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                &nbsp;<?= link_on_data_top(user()->id_group); ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card collapsed-card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Pencarian Data</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form class="form-horizontal" id="search_form" method="POST">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Blok</label>
                            <div class="form-input">
                              <select class="form-control" style="width: 100%;" id='blok' name='blok' multiple>
                                <option value=''>- Pilih -</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>No. Urut</label>
                            <div class="form-input">
                              <input type="text" id="no_urut" name="no_urut" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Periode Tgl. Wafat (Masehi)</label>
                            <div class="form-input">
                              <input type="text" id="periode_tgl_wafat_masehi" name="periode_tgl_wafat_masehi" class="form-control">
                            </div>
                          </div>
                          <script>
                            $(function() {
                              $('#periode_tgl_wafat_masehi').daterangepicker({
                                // opens: 'left',
                                autoUpdateInput: false,
                                locale: {
                                  format: 'YYYY-MM-DD'
                                }
                              }, function(start, end, label) {}).on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' s/d ' + picker.endDate.format('YYYY-MM-DD'));
                              }).on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                              });
                            });
                          </script>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Nama Mendiang (Latin)</label>
                            <div class="form-input">
                              <input type="text" id="nama_mendiang_latin" name="nama_mendiang_latin" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Nama Mendiang (Mandarin)</label>
                            <div class="form-input">
                              <input type="text" id="nama_mendiang_mandarin" name="nama_mendiang_mandarin" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Marga Suami/Istri (Latin)</label>
                            <div class="form-input">
                              <input type="text" id="marga_latin" name="marga_latin" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Marga Suami/Istri (Mandarin)</label>
                            <div class="form-input">
                              <input type="text" id="marga_mandarin" name="marga_mandarin" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Suku</label>
                            <div class="form-input">
                              <select class="form-control" style="width: 100%;" id='id_suku' name='id_suku' multiple>
                                <option value=''>- Pilih -</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Kampung Kelahiran (Latin)</label>
                            <div class="form-input">
                              <input type="text" id="kampung_kelahiran_latin" name="kampung_kelahiran_latin" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Kampung Kelahiran (Mandarin)</label>
                            <div class="form-input">
                              <input type="text" id="kampung_kelahiran_mandarin" name="kampung_kelahiran_mandarin" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php
                  $this->load->view('additionals/dropdown_blok');
                  $this->load->view('additionals/dropdown_suku');
                  ?>
                  <!-- /.card-body -->
                  <div class="card-footer" align="center">
                    <button class='btn btn-primary' type="button" onclick="search()"><i class="fa fa-search"></i></button>
                    <button class='btn btn-default' type="button" onclick="location.reload(true)"><i class="fa fa-undo"></i></button>
                    <button class='btn btn-success' type="button" onclick="xlsxDownload()"><i class="fa fa-download"></i> .xlsx</button>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class='table table-condensed table-bordered table-striped serverside-tables' style="width:100%">
                    <thead>
                      <th width='5%'>#</th>
                      <th>Blok</th>
                      <th>No. Urut</th>
                      <th>Nama Mendiang (Latin)</th>
                      <th>Nama Mendiang (Mandarin)</th>
                      <th>Marga Mendiang (Latin)</th>
                      <th>Marga Mendiang (Latin)</th>
                      <th>Marga Suami/Istri (Mandarin)</th>
                      <th>Marga Suami/Istri (Mandarin)</th>
                      <th>Tgl. Wafat (Masehi)</th>
                      <th>Tgl. Wafat (Imlek)</th>
                      <th>Nama Suku</th>
                      <th>Kampung Kelahiran (Latin)</th>
                      <th>Kampung Kelahiran (Mandarin)</th>
                      <th width="8%">Aksi</th>
                    </thead>
                  </table>
                </div>

              </div>
              <!-- /.card-body -->
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
      $(document).ready(function() {
        var dataTable = $('.serverside-tables').DataTable({
          "processing": true,
          "serverSide": true,
          // "scrollX": true,
          "language": {
            "infoFiltered": "",
            "processing": "<p style='font-size:20pt;background:#d9d9d9b8;color:black;width:100%'><i class='fa fa-refresh fa-spin'></i></p>",
          },
          "order": [],
          "lengthMenu": [
            [10, 25, 50, 75, 100],
            [10, 25, 50, 75, 100]
          ],
          "ajax": {
            url: "<?php echo site_url(get_controller() . '/fetchData'); ?>",
            type: "POST",
            dataSrc: "data",
            data: function(d) {
              d.blok_multi                  = $("#blok").val()
              d.no_urut                     = $("#no_urut").val()
              d.periode_tgl_wafat_masehi    = $("#periode_tgl_wafat_masehi").val()
              d.nama_mendiang_latin         = $("#nama_mendiang_latin").val()
              d.nama_mendiang_mandarin      = $("#nama_mendiang_mandarin").val()
              d.marga_latin                 = $("#marga_latin").val()
              d.marga_mandarin              = $("#marga_mandarin").val()
              d.id_suku_multi               = $("#id_suku").val()
              d.kampung_kelahiran_latin     = $("#kampung_kelahiran_latin").val()
              d.kampung_kelahiran_mandarin  = $("#kampung_kelahiran_mandarin").val()
              return d;
            },
          },
          "columnDefs": [{
              "targets": [0, 12],
              "orderable": false
            },
            {
              "targets": [0, 12],
              "className": 'text-center'
            },
            // {
            //   "targets": [3],
            //   "className": 'text-right'
            // },
            // // { "targets":[0],"checkboxes":{'selectRow':true}}
            // { "targets":[4],"className":'text-right'}, 
            // // { "targets":[2,4,5], "searchable": false } 
          ],
        });
      });

      function search() {
        $('.serverside-tables').DataTable().ajax.reload();
      }

      function hapusData(el, params) {
        Swal.fire({
          title: 'Apakah Anda Yakin Ingin Menghapus Data Ini Secara Permanen ?',
          showCancelButton: true,
          confirmButtonText: 'Lanjutkan',
          cancelButtonText: 'Batal',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          var values = {
            hapus: true
          }
          if (result.isConfirmed) {
            $.ajax({
              beforeSend: function() {
                $(el).html('<i class="fa fa-spinner fa-spin"></i>');
                $(el).attr('disabled', true);
              },
              url: params.url,
              type: "POST",
              data: values,
              // processData: false,
              // contentType: false,
              // cache: false,
              dataType: 'JSON',
              success: function(response) {
                $(el).html('<i class="fa fa-trash"></i>');
                if (response.status == 1) {
                  window.location = response.url;
                } else {
                  toasts(response.tipe, response.judul, '', response.pesan);
                  $(el).attr('disabled', false);
                }
              },
              error: function() {
                toasts('danger', 'Peringatan', '', 'Telah terjadi kesalahan. Silahkan refresh halaman');
                $(el).html('<i class="fa fa-trash"></i>');
                $(el).attr('disabled', false);
              },
            });
          } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
          }
        })
      }

      function xlsxDownload() {
        $('#search_form').attr('action', '<?= site_url(get_controller() . '/xlsx_download') ?>');
        $('#search_form').attr('method', 'POST');
        $('#search_form').submit();
      }
    </script>