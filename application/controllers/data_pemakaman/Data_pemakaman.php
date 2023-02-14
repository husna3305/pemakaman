<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data_pemakaman extends My_Controller
{
  var $title  = "Data Pemakaman";

  public function __construct()
  {
    parent::__construct();
    if (!logged_in()) redirect('auth/login');
    $this->load->model('Pemakaman_model', 'pemakaman_m');
    $this->load->model('Hubungan_keluarga_model', 'hubungan_m');
  }

  public function index()
  {
    $data['title'] = $this->title;
    $data['file']  = 'view';
    $this->template_portal($data);
  }

  public function fetchData()
  {
    $fetch_data = $this->_makeQuery();
    $data = array();
    $user = user();
    $no = $this->input->post('start') + 1;
    foreach ($fetch_data as $rs) {
      $params      = [
        'get'   => "id = " . $rs->id_pemakaman
      ];

      $sub_array   = array();
      $sub_array[] = $no;
      $sub_array[] = $rs->blok;
      $sub_array[] = $rs->no_urut;
      $sub_array[] = $rs->nama_mendiang_latin;
      $sub_array[] = $rs->nama_mendiang_mandarin;
      $sub_array[] = $rs->marga_latin;
      $sub_array[] = $rs->marga_mandarin;
      $sub_array[] = $rs->marga_suami_istri_latin;
      $sub_array[] = $rs->marga_suami_istri_mandarin;
      $sub_array[] = $rs->tgl_wafat_masehi;
      $sub_array[] = $rs->tgl_wafat_imlek;
      $sub_array[] = $rs->nama_suku_latin;
      $sub_array[] = $rs->kampung_kelahiran_latin;
      $sub_array[] = $rs->kampung_kelahiran_mandarin;
      $sub_array[] = link_on_data_details($params, $user->id_user);
      $data[]      = $sub_array;
      $no++;
    }
    $output = array(
      "draw"            => intval($_POST["draw"]),
      "recordsFiltered" => $this->_makeQuery(true),
      "data"            => $data
    );
    echo json_encode($output);
  }

  function _makeQuery($recordsFiltered = false)
  {
    $start  = $this->input->post('start');
    $length = $this->input->post('length');
    $limit  = "LIMIT $start, $length";
    if ($recordsFiltered == true) $limit = '';

    $filter = [
      'limit'                       => $limit,
      'order'                       => isset($_POST['order']) ? $_POST['order'] : '',
      'search'                      => $this->input->post('search')['value'],
      'order_column'                => 'view',
      'deleted'                     => false,
      'blok_multi'                  => isset($_POST['blok_multi']) ? $_POST['blok_multi'] : '', //
      'no_urut'                     => isset($_POST['no_urut']) ? $_POST['no_urut'] : '', //
      'id_suku_multi'               => isset($_POST['id_suku_multi']) ? $_POST['id_suku_multi'] : '', //
      'periode_tgl_wafat_masehi'    => isset($_POST['periode_tgl_wafat_masehi']) ? $_POST['periode_tgl_wafat_masehi'] : '', //
      'nama_mendiang_latin'         => isset($_POST['nama_mendiang_latin']) ? $_POST['nama_mendiang_latin'] : '', //
      'nama_mendiang_mandarin'      => isset($_POST['nama_mendiang_mandarin']) ? $_POST['nama_mendiang_mandarin'] : '', //
      'marga_latin'                 => isset($_POST['marga_latin']) ? $_POST['marga_latin'] : '', //
      'marga_mandarin'              => isset($_POST['marga_mandarin']) ? $_POST['marga_mandarin'] : '', //
      'kampung_kelahiran_latin'     => isset($_POST['kampung_kelahiran_latin']) ? $_POST['kampung_kelahiran_latin'] : '', //
      'kampung_kelahiran_mandarin'  => isset($_POST['kampung_kelahiran_mandarin']) ? $_POST['kampung_kelahiran_mandarin'] : '', //
    ];
    if ($recordsFiltered == true) {
      return $this->pemakaman_m->getPemakaman($filter)->num_rows();
    } else {
      return $this->pemakaman_m->getPemakaman($filter)->result();
    }
  }

  public function insert()
  {
    $data['title']    = $this->title;
    $data['file']     = 'form';
    $data['form']     = 'saveData';
    $data['mode']     = 'insert';
    $fh = ['select' => 'dropdown'];
    $data['option_hubungan'] = $this->hubungan_m->getHubunganKeluarga($fh)->result();
    $this->template_portal($data);
  }

  public function saveData()
  {
    $user = user();
    extract($this->input->post());

    $filter = ['blok' => $blok, 'no_urut' => $no_urut];
    $row = $this->pemakaman_m->getPemakaman($filter)->row();
    if ($row != null) {
      send_json(msg_error("Blok : $blok, No. Urut : $no_urut sudah digunakan. Nama Mendiang : $row->nama_mendiang_latin"));
      log_message('error', "Blok : $blok, No. Urut : $no_urut sudah digunakan. Nama Mendiang : $row->nama_mendiang_latin");
    }

    $id_pemakaman = next_auto_incr('pemakaman') + 1;

    $this->load->library('upload');
    $ym   = date('Y');
    $y_m  = date('Y-m');
    $path = "./uploads/foto_makam/" . $ym;
    if (!is_dir($path)) {
      mkdir($path, 0777, true);
    }

    $config['upload_path']   = $path;
    $config['allowed_types'] = 'jpg|png|jpeg|bmp|gif';
    $config['max_size']      = '5024';
    // $config['max_width']     = '3000';
    // $config['max_height']    = '3000';
    $config['remove_spaces'] = TRUE;
    $config['overwrite']     = TRUE;
    $config['file_name']     = $y_m . '-' . $id_pemakaman;
    $this->upload->initialize($config);

    $foto = null;
    if ($this->upload->do_upload('foto_makam')) {
      $new_path = substr($path, 2, 40);
      $filename = $this->upload->file_name;
      $foto = $new_path . '/' . $filename;
    } else {
      send_json(msg_error($this->upload->display_errors()));
    }


    $insert = [
      'id_pemakaman'                  => $id_pemakaman,
      'nama_mendiang_latin'           => strtoupper($nama_mendiang_latin),
      'nama_mendiang_mandarin'        => $nama_mendiang_mandarin,
      'kampung_kelahiran_latin'       => strtoupper($kampung_kelahiran_latin),
      'kampung_kelahiran_mandarin'    => $kampung_kelahiran_mandarin,
      'marga_latin'                   => strtoupper($marga_latin),
      'marga_mandarin'                => $marga_mandarin,
      'marga_suami_istri_latin'       => strtoupper($marga_suami_istri_latin),
      'marga_suami_istri_mandarin'    => $marga_suami_istri_mandarin,
      'foto_makam'                    => $foto,
      'blok'                          => $blok,
      'no_urut'                       => $no_urut,
      'id_suku'                       => $id_suku,
      'tgl_wafat_masehi'              => $tgl_wafat_masehi,
      'jk'              => $jk,
      'tgl_wafat_imlek'               => $tgl_wafat_imlek_tahun . '-' . $tgl_wafat_imlek_bulan . '-' . $tgl_wafat_imlek_tanggal,
      'created_at'                    => waktu(),
      'created_by'                    => $user->id_user,
    ];

    // Hubungan Keluarga
    foreach (json_decode($hubungan_keluarga, true) as $key => $dtl) {
      $ins_hubungan[] = [
        'id_pemakaman'              => $id_pemakaman,
        'nama_keluarga_latin'       => $dtl['nama_keluarga_latin'],
        'nama_keluarga_mandarin'    => $dtl['nama_keluarga_mandarin'],
        'id_hubungan'               => $dtl['id_hubungan']['id'],
      ];
    }

    $tes = [
      'insert' => $insert,
      // 'ins_hubungan' => isset($ins_hubungan) ? $ins_hubungan : ''
    ];
    // send_json($tes);
    $this->db->trans_begin();
    $this->db->insert('pemakaman', $insert);
    if (isset($ins_hubungan)) {
      $this->db->insert_batch('pemakaman_keluarga', $ins_hubungan);
    }
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $response = msg_wrong();
    } else {
      $this->db->trans_commit();
      $response = [
        'status' => 1,
        'url' => site_url(get_slug())
      ];
      $this->session->set_flashdata(msg_sukses_simpan());
    }
    send_json($response);
  }

  public function edit()
  {
    $data['title']    = $this->title;
    $data['file']     = 'form';
    $data['form']     = 'saveEdit';
    $data['mode']     = 'edit';
    $filter['id_pemakaman']  = $this->input->get('id');
    $row = $this->pemakaman_m->getPemakaman($filter)->row();
    if ($row != NULL) {
      $data['row'] = $row;
      $fh = ['select' => 'dropdown'];
      $data['option_hubungan'] = $this->hubungan_m->getHubunganKeluarga($fh)->result();
      $data['hubungan_keluarga'] = $this->pemakaman_m->getPemakamanHubunganKeluargaPages($filter);
      // send_json($data);
      $this->template_portal($data);
    } else {
      $this->session->set_flashdata(msg_not_found());
      redirect(get_slug());
    }
  }

  public function saveEdit()
  {
    $user = user();
    extract($this->input->post());
    $filter = ['id_pemakaman' => $id_pemakaman];

    $row = $this->pemakaman_m->getPemakaman($filter)->row();
    if ($row == null) {
      send_json(msg_error('ID Pemakaman : ' . $id_pemakaman . ' tidak ditemukan'));
    }

    if ($row->blok != $blok  || $row->no_urut != $no_urut) {
      $filter = ['blok' => $blok, 'no_urut' => $no_urut];
      $cr = $this->pemakaman_m->getPemakaman($filter)->row();
      if ($cr != null) {
        send_json(msg_error("Blok : $blok, No. Urut : $no_urut sudah digunakan. Nama Mendiang : $cr->nama_mendiang_latin"));
      }
    }

    $this->load->library('upload');
    $ym   = date('Y');
    $y_m  = date('Y-m');
    $path = "./uploads/foto_makam/" . $ym;
    if (!is_dir($path)) {
      mkdir($path, 0777, true);
    }

    $config['upload_path']   = $path;
    $config['allowed_types'] = 'jpg|png|jpeg|bmp|gif';
    $config['max_size']      = '5024';
    // $config['max_width']     = '3000';
    // $config['max_height']    = '3000';
    $config['remove_spaces'] = TRUE;
    $config['overwrite']     = TRUE;
    $config['file_name']     = $y_m . '-' . $id_pemakaman;
    $this->upload->initialize($config);

    $foto = $row->foto_makam;
    if ($this->upload->do_upload('foto_makam')) {
      $new_path = substr($path, 2, 40);
      $filename = $this->upload->file_name;
      $foto = $new_path . '/' . $filename;
    } else {
      // send_json(msg_error($this->upload->display_errors()));
    }

    $update = [
      'nama_mendiang_latin'           => strtoupper($nama_mendiang_latin),
      'nama_mendiang_mandarin'        => $nama_mendiang_mandarin,
      'kampung_kelahiran_latin'       => strtoupper($kampung_kelahiran_latin),
      'kampung_kelahiran_mandarin'    => $kampung_kelahiran_mandarin,
      'marga_latin'                   => strtoupper($marga_latin),
      'marga_mandarin'                => $marga_mandarin,
      'marga_suami_istri_latin'       => strtoupper($marga_suami_istri_latin),
      'marga_suami_istri_mandarin'    => $marga_suami_istri_mandarin,
      'blok'                          => $blok,
      'foto_makam'                    => $foto,
      'no_urut'                       => $no_urut,
      'id_suku'                       => $id_suku,
      'tgl_wafat_masehi'              => $tgl_wafat_masehi,
      'jk'                            => $jk,
      'tgl_wafat_imlek'               => $tgl_wafat_imlek_tahun . '-' . $tgl_wafat_imlek_bulan . '-' . $tgl_wafat_imlek_tanggal,
      'updated_at'                    => waktu(),
      'updated_by'                    => $user->id_user,
    ];

    // Hubungan Keluarga
    foreach (json_decode($hubungan_keluarga, true) as $key => $dtl) {
      $ins_hubungan[] = [
        'id_pemakaman'              => $id_pemakaman,
        'nama_keluarga_latin'       => $dtl['nama_keluarga_latin'],
        'nama_keluarga_mandarin'    => $dtl['nama_keluarga_mandarin'],
        'id_hubungan'               => $dtl['id_hubungan']['id'],
      ];
    }

    $tes = [
      'update' => $update,
      // 'ins_hubungan' => isset($ins_hubungan) ? $ins_hubungan : ''
    ];
    // send_json($tes);
    $this->db->trans_begin();
    $this->db->update('pemakaman', $update, $filter);
    $this->db->delete('pemakaman_keluarga', $filter);
    if (isset($ins_hubungan)) {
      $this->db->insert_batch('pemakaman_keluarga', $ins_hubungan);
    }
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $response = msg_wrong();
    } else {
      $this->db->trans_commit();
      $response = [
        'status' => 1,
        'url' => site_url(get_slug())
      ];
      $this->session->set_flashdata(msg_sukses_simpan());
    }
    send_json($response);
  }

  public function detail()
  {
    $data['title']    = $this->title;
    $data['file']     = 'form';
    $data['form']     = '';
    $data['mode']     = 'detail';
    $filter['id_pemakaman']  = $this->input->get('id');
    $row = $this->pemakaman_m->getPemakaman($filter)->row();
    if ($row != NULL) {
      $data['row'] = $row;
      $fh = ['select' => 'dropdown'];
      $data['option_hubungan'] = $this->hubungan_m->getHubunganKeluarga($fh)->result();
      $data['hubungan_keluarga'] = $this->pemakaman_m->getPemakamanHubunganKeluargaPages($filter);
      // send_json($data);
      $this->template_portal($data);
    } else {
      $this->session->set_flashdata(msg_not_found());
      redirect(get_slug());
    }
  }

  public function delete()
  {
    $user = user();
    extract($this->input->get());
    extract($this->input->post());

    if (!isset($hapus)) {
      $response = [
        'status' => 0,
        'url' => site_url(get_slug())
      ];
      send_json($response);
    }

    $filter = ['id_pemakaman' => $id];
    $row = $this->pemakaman_m->getPemakaman($filter)->row();
    if ($row == null) {
      send_json(msg_error("Data pemakaman dengan ID : " . strtoupper($id_pemakaman) . " tidak ditemukan"));
    }

    $this->db->trans_begin();
    $fg = ['id_pemakaman' => $id];
    $this->db->delete('pemakaman', $fg);
    $this->db->delete('pemakaman_keluarga', $fg);
    if (!file_exists(base_url($row->foto_makam))) {
      unlink($row->foto_makam);
    }
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $response = msg_wrong();
    } else {
      $this->db->trans_commit();
      $response = [
        'status' => 1,
        'url' => site_url(get_slug())
      ];
      $this->session->set_flashdata(msg_sukses_hapus());
    }
    send_json($response);
  }

  function xlsx_download()
  {
    if ($this->input->post() != null) {
      $spreadsheet    = new Spreadsheet();
      $sheet          = $spreadsheet->getActiveSheet();
      $result         = $this->pemakaman_m->getPemakaman($_POST)->result();
      $sheet->setCellValue('A1', NAMA_SISTEM);
      $row = 3;
      $header = [
        ['A', 'No.', 5],
        ['B', 'Blok', 5],
        ['C', 'No. Urut', 5],
        ['D', 'Nama Mendiang (Latin)', 5],
        ['E', 'Nama Mendiang (Mandarin)', 5],
        ['F', 'Marga Mendiang (Latin)', 5],
        ['G', 'Marga Mendiang (Mandarin)', 5],
        ['H', 'Marga Suami/Istri (Latin)', 5],
        ['I', 'Marga Suami/Istri (Mandarin)', 5],
        ['J', 'Tanggal Wafat (Masehi)', 5],
        ['K', 'Tanggal Wafat (Imlek)', 5],
        ['L', 'Suku (Latin)', 5],
        ['M', 'Suku (Mandarin)', 5],
        ['N', 'Kampung Kelahiran (Latin)', 5],
        ['O', 'Kampung Kelahiran (Mandarin)', 5],
      ];
      foreach ($header as $val) {
        $sheet->setCellValue($val[0] . $row, $val[1]);
        $sheet->getColumnDimension($val[0])->setAutoSize(true);
      }

      $styleArray = array(
        'borders' => array(
          'allBorders' => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            // 'color' => array('argb' => 'FFFF0000'),
          ),
        ),
      );
      $sheet->getStyle("A$row:O$row")->applyFromArray($styleArray);
      $sheet->getStyle("A$row:O$row")->getFont()->setBold(true);

      $row = 4;
      $no = 1;
      foreach ($result as $rs) {
        $sheet->setCellValue("A$row", $no);
        $sheet->setCellValue("B$row", $rs->blok);
        $sheet->setCellValue("C$row", $rs->no_urut);
        $sheet->setCellValue("D$row", $rs->nama_mendiang_latin);
        $sheet->setCellValue("E$row", $rs->nama_mendiang_mandarin);
        $sheet->setCellValue("F$row", $rs->marga_latin);
        $sheet->setCellValue("G$row", $rs->marga_mandarin);
        $sheet->setCellValue("H$row", $rs->marga_suami_istri_latin);
        $sheet->setCellValue("I$row", $rs->marga_suami_istri_mandarin);
        $sheet->setCellValue("J$row", $rs->tgl_wafat_masehi);
        $sheet->setCellValue("K$row", $rs->tgl_wafat_imlek);
        $sheet->setCellValue("L$row", $rs->nama_suku_latin);
        $sheet->setCellValue("M$row", $rs->nama_suku_mandarin);
        $sheet->setCellValue("N$row", $rs->kampung_kelahiran_latin);
        $sheet->setCellValue("O$row", $rs->kampung_kelahiran_mandarin);
        $sheet->getStyle("A$row:O$row")->applyFromArray($styleArray);
        $row++;
        $no++;
      }

      $writer = new Xlsx($spreadsheet);
      // $writer->save('hello world.xlsx');
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="laporan_pemakaman.xlsx"');
      $writer->save('php://output');
    } else {
      redirect(get_controller());
    }
  }
}
