<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= NAMA_SISTEM ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/front/') ?>assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url('assets/front/') ?>css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
  <header class="masthead">
    <div class="container">
      <div class="masthead-subheading">Selamat Datang Di</div>
      <div class="masthead-heading text-uppercase"><?= NAMA_SISTEM ?></div>
      <div class="row justify-content-center">
        <div class="col-sm-2">
          <button type="button" class="btn btn-info" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#modalTentangSistem">Tentang Sistem</button>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-info" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#modalAlurSistem">Alur Sistem</button>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-info" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#modalRancanganTabel">Rancangan Tabel</button>
        </div>
        <div class="col-sm-2">
          <a href="<?= site_url('auth') ?>" class="btn btn-info" style="width: 100%;">Login Sistem</a>
        </div>
      </div>
      <!-- <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a> -->
    </div>
  </header>
  <!-- Modal -->
  <div class="modal fade" id="modalTentangSistem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTentangSistemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTentangSistemLabel">Tentang Sistem</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Tentang Sistem</h5>
            <p style="text-align: justify;text-indent: 50px;"><?= NAMA_SISTEM; ?> merupakan sistem berbasis website yang digunakan untuk mencatat data-data mendiang yang dimakamkan pada pemakaman ini. Lokasi pemakaman ini berada di Jl. Pattimura, kel.rawasari, kec. alambarajo, Kota Jambi, Prov. Jambi.</p>
            <h6>Tool Sistem</h6>
            <table>
              <tbody>
                <tr>
                  <td>Bahasa Pemrograman</td>
                  <td>: PHP 7.4</td>
                </tr>
                <tr>
                  <td>Database</td>
                  <td>: MySQL</td>
                </tr>
                <tr>
                  <td>Framework PHP</td>
                  <td>: CodeIgniter 3</td>
                </tr>
                <tr>
                  <td>Repository</td>
                  <td>: <a href="https://github.com/husna3305/pemakaman" target="_blank">https://github.com/husna3305/pemakaman</a></td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalAlurSistem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAlurSistemLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAlurSistemLabel">Alur Sistem</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalRancanganTabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRancanganTabelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRancanganTabelLabel">Rancangan Tabel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <img src="<?= base_url('assets/images/relasi-tabel.png') ?>" alt="" class="img-thumbnail" style="width:100%">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url('assets/front/') ?>js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>