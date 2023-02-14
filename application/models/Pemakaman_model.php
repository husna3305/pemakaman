<?php
class Pemakaman_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getPemakaman($filter = null)
  {
    $where = 'WHERE 1=1';
    $select = "pmk.*,nama_suku_latin,nama_suku_mandarin,DATE_FORMAT(tgl_wafat_imlek,'%d') tgl_wafat_imlek_tanggal,DATE_FORMAT(tgl_wafat_imlek,'%m') tgl_wafat_imlek_bulan,DATE_FORMAT(tgl_wafat_imlek,'%Y') tgl_wafat_imlek_tahun";
    if ($filter != null) {
      $filter = $this->db->escape_str($filter);

      if (isset($filter['id_pemakaman'])) {
        if ($filter['id_pemakaman'] != '') {
          $where .= " AND pmk.id_pemakaman='{$this->db->escape_str($filter['id_pemakaman'])}'";
        }
      }
      if (isset($filter['no_urut'])) {
        if ($filter['no_urut'] != '') {
          $where .= " AND pmk.no_urut='{$this->db->escape_str($filter['no_urut'])}'";
        }
      }
      if (isset($filter['blok'])) {
        if ($filter['blok'] != '') {
          $where .= " AND pmk.blok='{$this->db->escape_str($filter['blok'])}'";
        }
      }
      if (isset($filter['blok_multi'])) {
        if ($filter['blok_multi'] != '') {
          $value = arr_sql($filter['blok_multi']);
          $where .= " AND pmk.blok IN($value)";
        }
      }
      if (isset($filter['id_suku_multi'])) {
        if ($filter['id_suku_multi'] != '') {
          $value = arr_sql($filter['id_suku_multi']);
          $where .= " AND pmk.id_suku IN($value)";
        }
      }
      if (isset($filter['periode_tgl_wafat_masehi'])) {
        if ($filter['periode_tgl_wafat_masehi'] != '') {
          $val = explode_periode($filter['periode_tgl_wafat_masehi']);
          $where .= " AND pmk.tgl_wafat_masehi BETWEEN '{$val[0]}' AND '{$val[1]}'";
        }
      }

      if (isset($filter['nama_mendiang_latin'])) {
        if ($filter['nama_mendiang_latin'] != '') {
          $where .= " AND pmk.nama_mendiang_latin LIKE '%{$this->db->escape_str($filter['nama_mendiang_latin'])}%'";
        }
      }

      if (isset($filter['nama_mendiang_mandarin'])) {
        if ($filter['nama_mendiang_mandarin'] != '') {
          $where .= " AND pmk.nama_mendiang_mandarin LIKE '%{$this->db->escape_str($filter['nama_mendiang_mandarin'])}%'";
        }
      }

      if (isset($filter['marga_latin'])) {
        if ($filter['marga_latin'] != '') {
          $where .= " AND pmk.marga_latin LIKE '%{$this->db->escape_str($filter['marga_latin'])}%'";
        }
      }

      if (isset($filter['marga_mandarin'])) {
        if ($filter['marga_mandarin'] != '') {
          $where .= " AND pmk.marga_mandarin LIKE '%{$this->db->escape_str($filter['marga_mandarin'])}%'";
        }
      }

      if (isset($filter['kampung_kelahiran_latin'])) {
        if ($filter['kampung_kelahiran_latin'] != '') {
          $where .= " AND pmk.kampung_kelahiran_latin LIKE '%{$this->db->escape_str($filter['kampung_kelahiran_latin'])}%'";
        }
      }

      if (isset($filter['kampung_kelahiran_mandarin'])) {
        if ($filter['kampung_kelahiran_mandarin'] != '') {
          $where .= " AND pmk.kampung_kelahiran_mandarin LIKE '%{$this->db->escape_str($filter['kampung_kelahiran_mandarin'])}%'";
        }
      }

      if (isset($filter['search'])) {
        if ($filter['search'] != '') {
          $filter['search'] = $this->db->escape_str($filter['search']);
          $where .= " AND ( 
                      pmk.nama_mendiang_latin LIKE '%{$filter['search']}%'
                      OR pmk.nama_mendiang_mandarin LIKE '%{$filter['search']}%'
          )";
        }
      }

      if (isset($filter['select'])) {
        if ($filter['select'] == 'dropdown') {
          $select = "id_suku id, CONCAT(nama_suku_latin,' ( ',nama_suku_mandarin,' )') text";
        } else {
          $select = $filter['select'];
        }
      }
    }

    $order_data = '';
    if (isset($filter['order'])) {
      $order = $filter['order'];
      $order_column = [null, 'blok', 'no_urut', 'nama_mendiang_latin', 'nama_mendiang_mandarin', 'marga_latin', 'marga_mandarin', 'tgl_wafat_masehi', 'tgl_wafat_imlek', 'nama_suku_latin', 'kampung_kelahiran_latin', 'kampung_kelahiran_mandarin', null];
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
    FROM pemakaman AS pmk
    LEFT JOIN suku sk ON sk.id_suku=pmk.id_suku
    $where
    $order_data
    $limit
    ");
  }
  function getPemakamanHubunganKeluarga($filter)
  {
    $where = "WHERE 1=1 ";
    if (isset($filter['id_pemakaman'])) {
      if ($filter['id_pemakaman'] != '') {
        $where .= " AND pmk.id_pemakaman='{$filter['id_pemakaman']}'";
      }
    }

    return $this->db->query("SELECT pmhk.*,nama_hubungan_latin,nama_hubungan_mandarin
          FROM pemakaman_keluarga pmhk
          JOIN pemakaman pmk ON pmk.id_pemakaman=pmhk.id_pemakaman
          JOIN hubungan_keluarga hk ON hk.id_hubungan=pmhk.id_hubungan
          $where
        ");
  }

  function getPemakamanHubunganKeluargaPages($filter)
  {
    $keluarga = $this->getPemakamanHubunganKeluarga($filter);
    $keluargas = [];
    foreach ($keluarga->result() as $rs) {
      $keluargas[] = [
        'id_pemakaman' => $rs->id_pemakaman,
        'nama_keluarga_latin' => $rs->nama_keluarga_latin,
        'nama_keluarga_mandarin' => $rs->nama_keluarga_mandarin,
        'id_hubungan' => ['id' => $rs->id_hubungan, 'text' => $rs->nama_hubungan_latin . ' ( ' . $rs->nama_hubungan_mandarin . ' )']
      ];
    }
    return $keluargas;
  }

  function getPemakamanPerBlok()
  {
    $blok = $this->db->get('blok')->result();
    $return = [];
    foreach ($blok as $blk) {
      $blk->total_mendiang = $this->db->get_where('pemakaman', ['blok' => $blk->blok])->num_rows();
      $return[] = $blk;
    }
    return $return;
  }
}
