<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Suku extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  function selectSuku()
  {
    $this->load->model('Suku_model', 'usgm');
    $search = null;
    if (isset($_POST['searchTerm'])) {
      $search = $_POST['searchTerm'];
    }
    $filter = [
      'search' => $search,
      'select' => 'dropdown',
      'aktif' => 1
    ];
    
    $response = $this->usgm->getSuku($filter)->result();
    $res_ = [];
    foreach ($response as $rs) {
      $res_[] = [
        'id' => (string)$rs->id,
        'text' => (string)$rs->text,
      ];
    }
    send_json($res_);
  }
}
