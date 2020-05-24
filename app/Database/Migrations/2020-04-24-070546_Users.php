<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration{
    public function up(){

        $this->forge->addField([
            'id'          		=> [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'email'       		=> [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password'       		=> [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'name'       		=> [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'gender'       		=> [
                'type'           => 'ENUM("L","P")',
                'null'           => TRUE,
            ],
            'address' => [
                'type'           => 'TEXT',
                'null'           => TRUE,
            ],
            'created_at' => [
                'type'           => 'DATETIME'
            ],
            'updated_at' => [
                'type'           => 'DATETIME'
            ],
            'deleted_at' => [
                'type'           => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('Users');
    }

    public function down(){
        $this->forge->dropTable('Users');
    }
}