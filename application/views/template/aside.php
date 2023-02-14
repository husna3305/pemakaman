<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('vendor/almasaeed2010/adminlte/')?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=user()->username?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php
        $html = "";
        function build_menu($data, $menus)
        {
          $html = '';
          //Cek Apakah Parent Menu Atau Separated Menu
          $url = (string)$data['slug'] =='' ? '#' : site_url($data['slug']);
          if ($data['controller'] == NULL) {
            //Cek Apakah Separated Menu
            if ($data['tot_child'] == 0) {
              $html .= "<li class='nav-header'>{$data['nama_menu']}</li>";
            } else {
              $html .= "<li class='nav-item'>
              <a href='$url' class='nav-link'>
                <i class='fas {$data['fa_icon_menu']} nav-icon'></i>
                <p>
                  {$data['nama_menu']}
                  <i class='right fas fa-angle-left'></i>
                </p>
              </a>
              <ul class='nav nav-treeview'>
              ";
              $level = $data['level'] + 1;
              $child = search_array($menus, ['level' => $level, 'parent_id_menu' => $data['id_menu']]);
              if (count($child) > 0) {
                foreach ($child as $chld) {
                  $html .= build_menu($chld, $menus);
                }
              }
              $html .= "</ul></li>";
            }
          } else {
            // $html .= "<li class='nav-item'><a href='$url'><i class='far fa-circle nav-icon'></i> <p>{$data['nama_menu']}</p></a></li>";
            $icon = (string)$data['fa_icon_menu']==''?'':$data['fa_icon_menu'];
            $html .="<li class='nav-item'>
            <a href='$url' class='nav-link'>
              <i class='fas $icon nav-icon'></i>
              <p>{$data['nama_menu']}</p>
            </a>
          </li>";
          }
          return $html;
        } ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">LIST MENU</li>
        <?php
          $lvl1 = search_array($menus, ['level' => 1]);
          foreach ($lvl1 as $l1) {
            if ($l1['id_menu'] != 999) {
              echo build_menu($l1, $menus);
            }
          }
        ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
