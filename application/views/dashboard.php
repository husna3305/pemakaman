    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_mendiang; ?></h3>
                <p>Total Semua Mendiang</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_keluarga_mendiang; ?></h3>
                <p>Total Semua Keluarga Mendiang</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="card">
              <div class="card-header border-0">
                <div class="text-center">
                  <h4>Blok Pemakaman</h4>
                  <hr>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Blok</th>
                      <th>Total Mendiang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($per_blok as $blk) { ?>
                      <tr>
                        <td>Blok <?= $blk->blok; ?></td>
                        <td><?= $blk->total_mendiang; ?> Orang</td>
                      </tr>
                    <?php }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->