<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>&nbsp;<?= $title ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <?php $seg = explode('/', uri_string());
          foreach ($seg as $key => $sg) {
            $set=ucwords(str_replace('-', ' ', $sg));
            $href = $set;
            $active = '';
            if ((count($seg) - 1) == $key) {
              $href = "<a href='".site_url(uri_string())."'>$set</a>";
              $active = 'active';
            }
          ?>
            <li class="breadcrumb-item"><?=$href?></li>
          <?php } ?>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>