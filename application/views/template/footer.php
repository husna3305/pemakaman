<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?=date('Y')?></strong> <?=NAMA_SISTEM?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- bs-custom-file-input -->
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?=base_url('vendor/jquery-validation')?>/dist/jquery.validate.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/toastr/toastr.min.js"></script>
<script src="<?=base_url('assets/js/')?>toast-setting.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>dist/js/adminlte.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/sweetalert2/sweetalert2.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    // $('.select2').select2()

    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })
  })
  $(function () {
    bsCustomFileInput.init();
  });

  $(document).ready(function() {
    let flash = <?= json_encode($this->session->flashdata()) ?>;
    if (flash.tipe != undefined) {
      toasts(flash.tipe,flash.judul,'',flash.pesan);
    }
  })

  $(document).ready(function() {
    let active_url = '<?= site_url(get_slug()) ?>';
    $("a[href='" + active_url + "']").parents('li').addClass('menu-open');
    $('.menu-open').children('a').addClass('active');
  })

  function findIndexByKeyValue(arraytosearch, key, valuetosearch) {
    for (var i = 0; i < arraytosearch.length; i++) {

      if (arraytosearch[i][key] == valuetosearch) {
        return i;
      }
    }
    return null;
  }

  function number_only(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode >= 48 && charCode <= 57 || charCode == 46 || charCode == 8 || charCode == 127))
      return true;
    return false;
  }
  
  $('.datepicker').daterangepicker({
    //  timePicker: false,
    singleDatePicker: true,
    isInvalidDate: false,
    autoUpdateInput: false,
    showDropdowns: true,
    locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD',
    },
  })
  $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD'));
  });
  $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

  //Date range picker with time picker
  $('.datetimepicker').daterangepicker({
       timePicker: true,
       timePickerIncrement: 1,
       singleDatePicker: true,
       timePicker24Hour: true,
       timePickerSeconds: true,
       isInvalidDate: false,
       autoUpdateInput: false,
       startDate: moment().startOf('seconds'),
       locale: {
         cancelLabel: 'Clear',
         format: 'YYYY-MM-DD HH:mm:00',
         //  monthNames: [
         //    "Januari",
         //    "Februari",
         //    "Maret",
         //    "April",
         //    "Mei",
         //    "Juni",
         //    "Jul",
         //    "Agustus",
         //    "September",
         //    "Oktober",
         //    "November",
         //    "Desember"
         //  ]
       },

     })
     $('.datetimepicker').on('apply.daterangepicker', function(ev, picker) {
       $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00'));
     });
     $('.datetimepicker').on('cancel.daterangepicker', function(ev, picker) {
       $(this).val('');
     });
     $(".numeric-only").keypress(function (e) {
        if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
     });
</script>
</body>
</html>
