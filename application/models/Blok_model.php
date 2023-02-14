<?php
class Blok_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getBlok($filter = null)
  {
    $where = 'WHERE 1=1';
    $select = '';
    if ($filter != null) {
      $filter = $this->db->escape_str($filter);
     
      if (isset($filter['blok'])) {
        if ($filter['blok'] != '') {
          $where .= " AND blk.blok='{$this->db->escape_str($filter['blok'])}'";
        }
      }
    
      if (isset($filter['aktif'])) {
        if ($filter['aktif'] != '') {
          $where .= " AND blk.aktif='{$this->db->escape_str($filter['aktif'])}'";
        }
      }
      if (isset($filter['deleted'])) {
        if ($filter['deleted']==true) {
          $where .= " AND deleted_at IS NOT NULL";
        }
      }

      if (isset($filter['search'])) {
        if ($filter['search'] != '') {
          $filter['search'] = $this->db->escape_str($filter['search']);
          $where .= " AND ( blk.blok LIKE'%{$filter['search']}%'
          )";
        }
      }

      if (isset($filter['select'])) {
        if ($filter['select'] == 'dropdown') {
          $select = "blok id, blok text";
        }else {
          $select = $filter['select'];
        }
      } else {
        $select = "blk.*";
      }
    }

    $order_data = '';
    if (isset($filter['order'])) {
      $order = $filter['order'];
      $order_column = [null, 'blok', 'created_at', 'created_by', null];
      if ($order != '') {
        $order_clm  = $order_column[$order['0']['column']];
        $order_by   = $order['0']['dir'];
        $order_data = " ORDER BY $order_clm $order_by ";
      }
    }

    $limit = '';
    if (isset($filter['limit'])) {
      $limit = $filter['limit'];
    }

    return $this->db->query("SELECT $select
    FROM blok AS blk
    $where
    $order_data
    $limit
    ");
  }  
}