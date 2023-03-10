<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Create_blok extends CI_Migration

{

    public function up()

    {

        $this->dbforge->add_field(array(
            'blok'          => ['type' => 'VARCHAR', 'constraint' => 2],
            'aktif'         => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'    => ['type' => 'DATETIME'],
            'created_by'    => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_by'    => ['type' => 'INT', 'constraint' => 8, 'unsigned' => TRUE, 'null' => true],
        ));
        $this->dbforge->add_key('blok', TRUE);
        $attributes = array('ENGINE' => 'InnoDB');
        $this->dbforge->create_table('blok', FALSE, $attributes);

    }



    public function down()

    {
        $this->dbforge->drop_table('blok');
    }

}