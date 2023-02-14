<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=NAMA_SISTEM?> | <?=$title?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/daterangepicker/daterangepicker.css">
  <style>
    .required{
      color:red
    }
    .error{
      color: #dc3545;
      font-size: 80%;
      margin-top: 0.25rem;
    }
    .label-text-info{
      font-size:10pt;
      color: #9d8686;
    }
    .card-header-small{
      padding: .5rem 1.25rem;
      margin-bottom: 0;
      background-color: rgba(0,0,0,.03);
      border-bottom: 0 solid rgba(0,0,0,.125);
      font-size:13pt;
      font-weight:bold;
    }
  </style>
  <!-- jQuery -->
  <script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url('vendor/almasaeed2010/adminlte/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('vendor/vue/')?>vue.min.js"></script>
  <script src="<?= base_url() ?>vendor/vue/accounting.js"></script>
  <script src="<?=base_url('vendor/vue/')?>vue-numeric.min.js"></script>
  <script>
    Vue.use(VueNumeric.default);
    Vue.filter('toCurrency', function(value) {
      return accounting.formatMoney(value, "", 0, ".", ",");
      return value;
    });
  </script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">