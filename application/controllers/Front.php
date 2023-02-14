<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Front extends My_Controller
{
  var $title  = "Front";

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
		if (logged_in()) redirect('dashboard');
    $data['title'] = $this->title;
    $data['file']  = '';
    $this->load->view('front/index');
    // $this->template_front($data);
  }
}
