<?php
class Suku_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getSuku($filter = null)
  {
    $where = 'WHERE 1=1';
    $select = '';
    if ($filter != null) {
      $filter = $this->db->escape_str($filter);
     
      if (isset($filter['id_suku'])) {
        if ($filter['id_suku'] != '') {
          $where .= " AND sk.id_suku='{$this->db->escape_str($filter['id_suku'])}'";
        }
      }
    
      if (isset($filter['aktif'])) {
        if ($filter['aktif'] != '') {
          $where .= " AND sk.aktif='{$this->db->escape_str($filter['aktif'])}'";
        }
      }

      if (isset($filter['search'])) {
        if ($filter['search'] != '') {
          $filter['search'] = $this->db->escape_str($filter['search']);
          $where .= " AND ( sk.nama_suku_latin LIKE'%{$filter['search']}%' OR sk.nama_suku_mandarin LIKE'%{$filter['search']}%'
          )";
        }
      }

      if (isset($filter['select'])) {
        if ($filter['select'] == 'dropdown') {
          $select = "id_suku id, CONCAT(nama_suku_latin,' ( ',nama_suku_mandarin,' )') text";
        }else {
          $select = $filter['select'];
        }
      } else {
        $select = "sk.*";
      }
    }

    $order_data = '';
    if (isset($filter['order'])) {
      $order = $filter['order'];
      $order_column = [null, 'suku', 'created_at', 'created_by', null];
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
    FROM suku AS sk
    $where
    $order_data
    $limit
    ");
  }  
}
