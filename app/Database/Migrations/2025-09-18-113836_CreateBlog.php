<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'unique'     => true,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('blogs');
    }

    public function down()
    {
        $this->forge->dropTable('blogs');
    }
}
