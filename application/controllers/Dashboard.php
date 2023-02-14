<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends My_Controller
{
  var $title  = "Dashboard";

  public function __construct()
  {
    parent::__construct();
    if (!logged_in()) redirect('auth/login');
    $this->load->model('pemakaman_model');
  }

  public function index()
  {
    $data['title']                      = $this->title;
    $data['file']                       = '';
    $data['total_mendiang']             = $this->db->get('pemakaman')->num_rows();
    $data['total_keluarga_mendiang']    = $this->db->get('pemakaman_keluarga')->num_rows();
    $data['per_blok']        = $this->pemakaman_model->getPemakamanPerBlok();
    $this->template_portal($data);
  }
}
