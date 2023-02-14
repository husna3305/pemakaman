<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Suku extends My_Controller
{
  var $title  = "Suku";

  public function __construct()
  {
    parent::__construct();
    if (!logged_in()) redirect('auth/login');
    $this->load->model('Suku_model', 'suku_m');
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
        'get'   => "id = " . $rs->id_suku
      ];
      $aktif = '';
      if ($rs->aktif == 1) {
        $aktif = '<i class="fa fa-check"></i>';
      }

      $sub_array   = array();
      $sub_array[] = $no;
      $sub_array[] = $rs->nama_suku_latin;
      $sub_array[] = $rs->nama_suku_mandarin;
      $sub_array[] = $aktif;
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
      'limit'  => $limit,
      'order'  => isset($_POST['order']) ? $_POST['order'] : '',
      'search' => $this->input->post('search')['value'],
      'order_column' => 'view',
      'deleted' => false
    ];
    if ($recordsFiltered == true) {
      return $this->suku_m->getSuku($filter)->num_rows();
    } else {
      return $this->suku_m->getSuku($filter)->result();
    }
  }

  public function insert()
  {
    $data['title']    = $this->title;
    $data['file']     = 'form';
    $data['form']     = 'saveData';
    $data['mode']     = 'insert';
    $this->template_portal($data);
  }

  public function saveData()
  {
    $user = user();
    extract($this->input->post());

    $insert = [
      'nama_suku_latin'       => strtoupper($nama_suku_latin),
      'nama_suku_mandarin'    => $nama_suku_mandarin,
      'aktif'                 => isset($aktif) ? 1 : 0,
      'created_at'            => waktu(),
      'created_by'            => $user->id_user,
    ];

    $tes = ['insert' => $insert];
    // send_json($tes);
    $this->db->trans_begin();
    $this->db->insert('suku', $insert);
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
    $filter['id_suku']  = $this->input->get('id');
    $row = $this->suku_m->getSuku($filter)->row();
    if ($row != NULL) {
      $data['row'] = $row;
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

    $update = [
      'nama_suku_latin'       => strtoupper($nama_suku_latin),
      'nama_suku_mandarin'    => $nama_suku_mandarin,
      'aktif'         => isset($aktif) ? 1 : 0,
      'updated_at'    => waktu(),
      'updated_by'    => $user->id_user,
    ];

    $tes = ['update' => $update];
    // send_json($tes);
    $this->db->trans_begin();
    $fg = ['id_suku'=>$id_suku];
    $this->db->update('suku', $update, $fg);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $response = msg_wrong();
    } else {
      $this->db->trans_commit();
      $response = [
        'status' => 1,
        'url' => site_url(get_slug())
      ];
      $this->session->set_flashdata(msg_sukses_update());
    }
    send_json($response);
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

    $filter =['suku'=>$id];
    $row = $this->suku_m->getSuku($filter)->row();
    if ($row==null) {
      send_json(msg_error("Suku ".strtoupper($suku)." tidak ditemukan"));
    }

    $this->db->trans_begin();
    $fg = ['id_suku'=>$id];
    $this->db->delete('suku', $fg);
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
}
