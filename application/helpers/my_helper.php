<?php

function search_array($array, $search_list)
{

  // Create the result array 
  $result = array();

  // Iterate over each array element 
  foreach ($array as $key => $value) {

    // Iterate over each search condition 
    foreach ($search_list as $k => $v) {

      // If the array element does not meet 
      // the search condition then continue 
      // to the next element 
      if (!isset($value[$k]) || $value[$k] != $v) {

        // Skip two loops 
        continue 2;
      }
    }

    // Append array element's key to the 
    //result array 
    $result[] = $value;
  }

  // Return result  
  return $result;
}

function tanggal()
{
  return gmdate("Y-m-d", time() + 60 * 60 * 7);
}
function tahun()
{
  return gmdate("Y", time() + 60 * 60 * 7);
}
function tahun_bulan()
{
  return gmdate("Y-m", time() + 60 * 60 * 7);
}

function waktu()
{
  return gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
}
function jam()
{
  return gmdate("H:i", time() + 60 * 60 * 7);
}

function _imp($arr)
{
  $expl = explode(',', $arr);
  // $res = '';
  foreach ($expl as $val) {
    $res[] = "'$val'";
  }
  return implode(',', $res);
}

function arr_sql($arr)
{
  foreach ($arr as $val) {
    $res[] = "'$val'";
  }
  if (isset($res)) {
    return implode(',', $res);
  } else {
    return "'-'";
  }
}

function send_json($arr)
{
  echo json_encode($arr);
  die();
}

function msg_wrong()
{
  return ['status'=>0,'tipe' => 'danger', 'judul' => 'Peringatan', 'pesan' => 'Telah terjadi kesalahan !'];
}
function msg_kombinasi_login_salah()
{
  return 'Kombinasi Email atau Username dengan Password Anda salah. Mohon cek kembali';
}
function msg_not_found()
{
  return ['status'=>0,'tipe' => 'danger', 'judul' => 'Peringatan', 'pesan' => 'Data tidak ditemukan'];
}
function msg_error($pesan)
{
  return ['status'=>0, 'tipe' => 'danger', 'judul' => 'Peringatan', 'pesan' => $pesan];
}
function msg_sukses_simpan()
{
  return  ['status'=>1,'tipe' => 'success', 'judul' => 'Informasi', 'pesan' => 'Data berhasil disimpan'];
}
function msg_sukses($pesan)
{
  return  ['status'=>1,'tipe' => 'success', 'judul' => 'Informasi', 'pesan' => $pesan];
}
function msg_sukses_update()
{
  return  ['status'=>1,'tipe' => 'success', 'judul' => 'Informasi', 'pesan' => 'Data berhasil diupdate'];
}

function msg_sukses_upload()
{
  return  ['status'=>1,'tipe' => 'success', 'judul' => 'Informasi', 'pesan' => 'Upload data berhasil'];
}

function msg_sukses_hapus()
{
  return  ['status'=>1,'tipe' => 'success', 'judul' => 'Informasi', 'pesan' => 'Data berhasil dihapus permanen'];
}

function msg_no_access()
{
  return  ['status'=>0,'tipe' => 'danger', 'judul' => 'Peringatan', 'pesan' => 'Anda tidak memiliki akses'];
}

function random_numbers($digits)
{
  $min = pow(10, $digits - 1);
  $max = pow(10, $digits) - 1;
  return mt_rand($min, $max);
}

function alnum($string)
{
  return preg_replace("/[^a-zA-Z0-9]+/", "", $string);
}


function random_id()
{
  return substr(strtotime(waktu()), -6) . random_numbers(2);
}

function create_thumbs($params)
{
  $CI = &get_instance();

  $exp_file_name = explode('.', $params['file_name']);
  $file_name_thumb = $exp_file_name[0] . '-small.' . $exp_file_name[1];
  $new_image_small = $params['path'] . '/' . $file_name_thumb;

  // Image resizing config
  $config = array(
    // // Image Large
    // array(
    //   'image_library' => 'GD2',
    //   'source_image'  => './assets/images/' . $file_name,
    //   'maintain_ratio' => FALSE,
    //   'width'         => 700,
    //   'height'        => 467,
    //   'new_image'     => './assets/images/large/' . $file_name
    // ),
    // // image Medium
    // array(
    //   'image_library' => 'GD2',
    //   'source_image'  => './assets/images/' . $file_name,
    //   'maintain_ratio' => FALSE,
    //   'width'         => 600,
    //   'height'        => 400,
    //   'new_image'     => './assets/images/medium/' . $file_name
    // ),
    // Image Small
    array(
      'image_library' => 'GD2',
      'source_image'  => $params['path'] . '/' . $params['file_name'],
      'maintain_ratio' => TRUE,
      // 'create_thumb' => TRUE,
      'width'         => 250,
      // 'height'        => 200,
      // 'thumb_marker' => '_thumb',
      'new_image'     => $new_image_small
    )
  );
  // send_json($config);
  $CI->load->library('image_lib', $config[0]);
  foreach ($config as $item) {
    $CI->image_lib->initialize($item);
    if (!$CI->image_lib->resize()) {
      return false;
    }
    $CI->image_lib->clear();
  }

  return $file_name_thumb;
}


function date2min($hms)
{

  // $fromTime = strtotime($hms);
  // // send_json($fromTime);
  // $getMins = round(abs($fromTime) / 60, 2);

  // $getMins = date('i', strtotime($hms));

  $time = explode(':', $hms);
  $getMins = ($time[0] * 60) + ($time[1]) + ($time[2] / 60);

  return $getMins;
}


function get_slug()
{
  $CI = &get_instance();
  $segment =  $CI->uri->segment(1) . '/' . $CI->uri->segment(2);
  if ($CI->uri->segment(2)==null) {
    $segment  = str_replace('/','',$segment);
  }

  $cek = $CI->db->query("SELECT slug FROM ms_menu WHERE slug='$segment' OR controller='$segment' AND aktif=1")->row();
  if ($cek != NULL) {
    return $cek->slug;
  }
}

function all_links_set()
{
  $links    = array_keys(links_on_table());
  $links[]  = 'fetchData';
  $links[]  = 'saveData';
  $links[]  = 'saveEdit';
  $links[]  = 'role_akses';
  return $links;
}

function get_controller()
{
  $CI = &get_instance();
  $segment =  $CI->uri->segment(1) . '/' . $CI->uri->segment(2);
  if ($CI->uri->segment(2)==null) {
    $segment  = str_replace('/','',$segment);
  }

  $cek = $CI->db->query("SELECT controller FROM ms_menu WHERE slug='$segment' OR controller='$segment'")->row();
  if ($cek != NULL) {
    return $cek->controller;
  }
}

function all_links()
{
  $CI = &get_instance();
  $cek = $CI->db->query("SELECT link, deskripsi, ikon FROM ms_menu_links ORDER BY order_link ASC")->result();
  $ck = [];
  foreach ($cek as $c) {
    $ck[$c->link] = ['ikon' => $c->ikon, 'deskripsi' => $c->deskripsi];
  }
  return $ck;
}

function links_on_table()
{
  $links = [
    'detail' => [
      'class' => "btn btn-xs btn-info",
      'icon' => '<i class="fa fa-eye"></i>',
      'title' => 'Detail',
      'show_title' => 0,
      'tipe' => 'href',
    ],
    'edit' => [
      'class' => "btn btn-warning btn-xs",
      'icon' => '<i class="fa fa-edit"></i>',
      'title' => 'Edit',
      'show_title' => 0,
      'tipe' => 'href',
    ],
    'role_akses' => [
      'class' => "btn btn-xs btn-primary",
      'icon' => '<i class="fa fa-cogs"></i>',
      'title' => 'Role Akses',
      'show_title' => 0,
      'tipe' => 'href',
    ],
    'delete' => [
      'class'      => "btn btn-xs btn-danger",
      'icon'       => '<i class = "fa fa-trash"></i>',
      'title'      => 'Hapus',
      'show_title' => 0,
      'tipe'       => 'button',
      'function'   => 'hapusData'
    ],
  ];
  return $links;
}

function link_on_data_details($params, $id_group, $skip_if = null)
{
  $CI = &get_instance();
  $filter = [
    'controller' => get_controller()
  ];
  $links = links_on_table();
  $menu = $CI->dm->getMenus($filter)->row();
  $button = '';
  $explode_links = explode(',', $menu->links_menu);
  $get_links = cekAkasesMenuBySlug($id_group, $menu->slug);
  $explode_links = [];
  foreach ($get_links as $lks) {
    if ($id_group == 1) {
      $explode_links[] = $lks->link;
    } else {
      if ($lks->akses == 1) {
        $explode_links[] = $lks->link;
      }
    }
  }
  foreach ($links as $key => $lk) {
    if (in_array($key,  $explode_links)) {
      //Cek Skip
      if ($skip_if != null) {
        if (isset($skip_if[$key])) {
          $skpk = $skip_if[$key];
          if (in_array($skpk['cek'],$skpk['in'])) {
            continue;
          }
        }
      }
      $title = $lk['show_title'] == 1 ? $lk['title'] : '';
      $parameter = preg_replace('/\s+/', '', $params['get']);
      $url = site_url("$menu->slug/$key?$parameter");
      if ($lk['tipe'] == 'href') {
        $button .= '<a data-toggle="tooltip" title="' . $lk['title'] . '" href="' . $url . '" class="' . $lk['class'] . '" data-original-title="' . $title . '">' . $lk['icon'] . ' ' . $title . '</a>';
      } else {
        $params_delete = json_encode(['url' => $url]);
        $function = $lk['function'];
        $button .= "<button type=\"button\" class=\"{$lk['class']}\" data-toggle=\"tooltip\" title=\"{$lk['title']}\" onclick='$function(this, $params_delete)'> 
        {$lk['icon']} $title
        </button>";
      }
    }
  }
  return $button;
}

function link_on_data_top($id_group)
{
  $slug = get_slug();
  $button = '';

  $buttons['insert'] = '<a href="' . site_url($slug . '/insert') . '"> <button class="btn bg-blue btn-sm"><i class="fa fa-plus"></i> Add New</button></a>';
  $buttons['upload'] = '<a class="btn btn-info btn-sm ml-2" href="' . site_url($slug . '/upload') . '"><i class="fa fa-upload"></i> Upload</a>';
  //Cek Insert
  $links = cekAkasesMenuBySlug($id_group, $slug);
  foreach ($links as $lk) {
    if (isset($buttons[$lk->link]) && $lk->akses == 1) {
      $button .= $buttons[$lk->link];
    }
  }
  return $button;
}

function clear_removed_html($value)
{
  return str_replace('[removed]', '', $value);
}

function convert_datetime($val)
{
  $explode = explode(' ', $val);
  if (count($explode) > 1) {
    $explode[1] = sprintf('%02s', date_parse($explode[1])['month']);
    return $explode[2] . '-' . $explode[1] . '-' . $explode[0] . ' ' . $explode[3];
  } else {
    return $val;
  }
}
function convert_datetime_str($val)
{
  return date("d F Y H:i:s", strtotime($val));
}

function convert_no_hp($val)
{
  if (substr($val, 0, 1) == '+') {
    $val = '0' . substr($val, 3, 30);
  }
  return $val;
}
function convert_no_telp($val)
{
  if (substr($val, 0, 1) == '+') {
    $val = '0' . substr($val, 2, 30);
  }
  return $val;
}


function sql_convert_date($field)
{
  return "DATE_FORMAT($field,'%d %M %Y %H:%i:%s')";
}
function sql_convert_date_dmy($field)
{
  return "DATE_FORMAT($field,'%d/%m/%Y')";
}


function date_iso_8601_to_datetime($date)
{
  return date('Y-m-d H:i:s', strtotime($date));
}

function selisih_2tanggal($start, $end)
{
  $tgl1 = new DateTime(substr($start, 0, 10));
  $tgl2 = new DateTime(substr($end, 0, 10));
  return $tgl2->diff($tgl1);
}

function selisih_detik($start, $end)
{
  $tgl1 = strtotime($start);
  $tgl2 = strtotime($end);
  return $tgl2 - $tgl1;
}

function detik_ke_menit($detik)
{
  return round($detik / 60);
}

function detik_ke_jam($detik)
{
  $menit = detik_ke_menit($detik);
  return round($menit / 60);
}

function detik_ke_hari($detik)
{
  $jam = detik_ke_jam($detik);
  return round($jam / 24);
}

function convert_date($val)
{
  $date = str_replace('/', '-', $val);
  return date('Y-m-d', strtotime($date));
}

function clean_no_hp($no_hp)
{
  $no_hp = preg_replace("/[^0-9]+/", "", $no_hp);
  if (substr($no_hp, 0, 3) == '62') {
    $no_hp = '0' . substr($no_hp, 3, 30);
  } elseif (substr($no_hp, 0, 2) == '62') {
    $no_hp = '0' . substr($no_hp, 2, 30);
  }
  return $no_hp;
}

function dMYHIS_en()
{
  return gmdate("d F Y H:i:s", time() + 60 * 60 * 7);
}

function set_errors($error)
{
  $set_errors = [];
  foreach ($error as $key => $val) {
    $err = "<ul>";
    foreach ($val as $v) {
      $err .= "<li>$v</li>";
    }
    $err .= "</ul>";
    $set_errors[] = ['<b>' . $key . '</b>', $err];
  }
  return $set_errors;
}


function cek_error_no_hp($no_hp)
{
  if (strlen($no_hp) < 10) {
    return 'No. HP kurang dari 10 karakter';
  } elseif (strlen($no_hp) > 15) {
    return 'No. HP kurang dari 15 karakter';
  }
}

function cekISO8601Date($dateStr)
{
  if (preg_match('/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/', $dateStr) > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function tanggal_lebih_kecil($awal, $akhir)
{
  if (strtotime($awal) < strtotime($akhir)) {
    return true;
  } else {
    return false;
  }
}

function empty_to_min($val)
{
  return $val == '' ? '-' : $val;
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}

function next_auto_incr($tabel)
{
  $CI = &get_instance();
  $cek = $CI->db->query("SHOW TABLE STATUS LIKE '$tabel'")->row();
  if ($cek!=null) {
    if ($cek->Auto_increment!=null) {
      return $cek->Auto_increment;
    }else{
      return 1;
    }
  }
}

function only_number($value)
{
  return preg_replace("/[^0-9]/", "",$value);
}

function explode_periode($value)
{

  return explode('s/d',str_replace(' ', '', $value));
}