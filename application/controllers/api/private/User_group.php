<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class User_group extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  function selectUserGroup()
  {
    $this->load->model('user_groups_model', 'usgm');
    $search = null;
    if (isset($_POST['searchTerm'])) {
      $search = $_POST['searchTerm'];
    }
    $filter = [
      'search' => $search,
      'select' => 'dropdown',
      'aktif' => 1
    ];
    
    $response = $this->usgm->getUserGroups($filter)->result();
    send_json($response);
  }
}
