<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductVariantImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'variant_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('variant_id', 'product_variants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_variant_images');
    }

    public function down()
    {
        $this->forge->dropTable('product_variant_images');
    }
}
