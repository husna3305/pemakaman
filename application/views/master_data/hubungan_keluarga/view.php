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
                <div class="table-responsive">
                  <table class='table table-condensed table-bordered table-striped serverside-tables' style="width:100%">
                  <thead>
                    <th width='5%'>#</th>
                    <th>Nama Hubungan Keluarga (Latin)</th>
                    <th>Nama Hubungan Keluarga (Mandarin)</th>
                    <th>Urutan</th>
                    <th width="8%">Aktif</th>
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
            // d.periode = '';
            return d;
          },
        },
        "columnDefs": [{
          "targets": [0, 5],
            "orderable": false
          },
          {
            "targets": [0, 4, 5],
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
    function hapusData(el,params) {
      Swal.fire({
        title: 'Apakah Anda Yakin Ingin Menghapus Data Ini Secara Permanen ?',
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        var values ={hapus:true}
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
                toasts(response.tipe,response.judul,'',response.pesan);
                $(el).attr('disabled', false);
              }
            },
            error: function() {
              toasts('danger','Peringatan','','Telah terjadi kesalahan. Silahkan refresh halaman');
              $(el).html('<i class="fa fa-trash"></i>');
              $(el).attr('disabled', false);
            },
          });
        } else if (result.isDenied) {
          // Swal.fire('Changes are not saved', '', 'info')
        }
      })
    }
  </script>