<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - <?=NAMA_SISTEM?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte')?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/toastr/toastr.min.css">
	<style>
		.login-page{
			box-shadow: inset 0 0 0 1000px rgba(0,0,0,0.5);
			background-image: url("<?=base_url('assets/images/bg_login.png')?>");
		}
	</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><?=NAMA_SISTEM?></h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan login untuk masuk ke dalam sistem</p>

      <form id="form_login">
        <div class="form-input">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Username/Email" required>
            <!-- <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div> -->
          </div>
        </div>
        <div class="form-input">
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <!-- <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div> -->
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="signInButton" class="btn btn-primary btn-block" @click.prevent="submitLogin(this)">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('vendor/almasaeed2010/adminlte')?>/dist/js/adminlte.min.js"></script>
<script src="<?=base_url('vendor/jquery-validation')?>/dist/jquery.validate.js"></script>
<script src="<?=base_url('vendor/almasaeed2010/adminlte')?>/plugins/toastr/toastr.min.js"></script>
<script src="<?=base_url('assets/js/')?>toast-setting.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script>
  var form_name = 'form_login';
  var form_ = new Vue({
    el: '#'+form_name,
    data: {},
    methods: {
      submitLogin: function(el) {
        $('#'+form_name).validate({
          highlight: function(element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
              $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
            } else {
              $(element).parents('.form-input').addClass('has-error');
            }
          },
          unhighlight: function(element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
              $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
            } else {
              $(element).parents('.form-input').removeClass('has-error');
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
          $.ajax({
            beforeSend: function() {
              $('#signInButton').html('<i class="fa fa-spinner fa-spin"></i> Process');
              $('#signInButton').attr('disabled', true);
            },
            url: '<?= site_url('auth/login') ?>',
            type: "POST",
            data: values,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(response) {
              $('#signInButton').html('Sign In');
              if (response.status == 1) {
                window.location = response.url;
              } else {
                toasts(response.tipe,response.judul,'',response.pesan);
                $('#signInButton').attr('disabled', false);
              }
            },
            error: function() {
              toasts('danger','Peringatan','','Telah terjadi kesalahan. Silahkan refresh halaman');
              $('#signInButton').html('Sign In');
              $('#signInButton').attr('disabled', false);
            },
          });
        } else {
          toasts('warning','Peringatan','','Silahkan isi field required');
        }
      }
    },
  });
</script>
</body>
</html>