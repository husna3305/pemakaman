<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Create_pemakaman extends CI_Migration

{

    public function up()

    {

        $this->dbforge->add_field(array(
            'id_pemakaman'                  => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE, 'auto_increment' => true],
            'blok'                          => ['type' => 'VARCHAR', 'constraint' => 2],
            'no_urut'                       => ['type' => 'INT', 'constraint' => 3],
            'nama_mendiang_latin'           => ['type' => 'VARCHAR', 'constraint' => 60],
            'nama_mendiang_mandarin'        => ['type' => 'VARCHAR', 'constraint' => 60],
            'marga_latin'                   => ['type' => 'VARCHAR', 'constraint' => 60],
            'marga_mandarin'                => ['type' => 'VARCHAR', 'constraint' => 60],
            'kampung_kelahiran_latin'       => ['type' => 'VARCHAR', 'constraint' => 60],
            'kampung_kelahiran_mandarin'    => ['type' => 'VARCHAR', 'constraint' => 60],
            'tgl_wafat_masehi'              => ['type' => 'date'],
            'tgl_wafat_imlek'               => ['type' => 'date'],
            'id_suku'                       => ['type' => 'TINYINT', 'constraint' => 3, 'unsigned'=>true],
            'foto_makam'                    => ['type' => 'VARCHAR', 'constraint' => 300],
            'created_at'                    => ['type' => 'DATETIME'],
            'created_by'                    => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE],
            'updated_at'                    => ['type' => 'DATETIME', 'null' => true],
            'updated_by'                    => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => true],
        ));
        $this->dbforge->add_key('id_pemakaman', TRUE);
        $this->dbforge->add_key('blok');
        $this->dbforge->add_key('id_suku');
        $this->dbforge->add_key('no_urut');
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('pemakaman', FALSE, $attributes);
        $this->db->query("ALTER TABLE pemakaman ADD UNIQUE( `blok`, `no_urut`);");

        $this->dbforge->add_field(array(
            'id'                        => ['type' => 'INT', 'constraint' => 10, 'unsigned' => TRUE, 'auto_increment' => true],
            'id_pemakaman'              => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE],
            'id_hubungan'               => ['type' => 'INT', 'constraint' =>3, 'unsigned' => TRUE],
            'nama_keluarga_latin'       => ['type' => 'VARCHAR', 'constraint' => 60],
            'nama_keluarga_mandarin'    => ['type' => 'VARCHAR', 'constraint' => 60],
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id_pemakaman');
        $this->dbforge->add_key('id_hubungan');
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('pemakaman_keluarga', FALSE, $attributes);


    }



    public function down()

    {
        $this->dbforge->drop_table('blok');
    }

}