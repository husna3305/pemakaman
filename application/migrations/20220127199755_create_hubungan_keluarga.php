<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Create_hubungan_keluarga extends CI_Migration

{

    public function up()

    {
        $this->dbforge->add_field(array(
            'id_hubungan'               => ['type' => 'INT', 'constraint' =>3, 'unsigned' => TRUE, 'auto_increment'=>true],
            'nama_hubungan_latin'       => ['type' => 'VARCHAR', 'constraint' => 60],
            'nama_hubungan_mandarin'    => ['type' => 'VARCHAR', 'constraint' => 60],
            'aktif'                     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'urutan'                    => ['type' => 'INT', 'constraint' =>3, 'unsigned' => TRUE],
            'created_at'                => ['type' => 'DATETIME'],
            'created_by'                => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE],
            'updated_at'                => ['type' => 'DATETIME', 'null' => true],
            'updated_by'                => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => true],
        ));
        $this->dbforge->add_key('id_hubungan', TRUE);
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('hubungan_keluarga', FALSE, $attributes);
    }



    public function down()

    {
        $this->dbforge->drop_table('hubungan_keluarga');
    }

}