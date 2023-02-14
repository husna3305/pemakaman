<?php
class Hubungan_keluarga_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getHubunganKeluarga($filter = null)
  {
    $where = 'WHERE 1=1';
    $select = '';
    if ($filter != null) {
      $filter = $this->db->escape_str($filter);
     
      if (isset($filter['id_hubungan'])) {
        if ($filter['id_hubungan'] != '') {
          $where .= " AND sk.id_hubungan='{$this->db->escape_str($filter['id_hubungan'])}'";
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
          $where .= " AND ( sk.nama_hubungan_mandarin LIKE'%{$filter['search']}%'
                            OR sk.nama_hubungan_latin LIKE'%{$filter['search']}%'
          )";
        }
      }

      if (isset($filter['select'])) {
        if ($filter['select'] == 'dropdown') {
          $select = "id_hubungan id, CONCAT(nama_hubungan_latin,' ( ',nama_hubungan_mandarin,' )') text";
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
    FROM hubungan_keluarga AS sk
    $where
    $order_data
    $limit
    ");
  }  
}
