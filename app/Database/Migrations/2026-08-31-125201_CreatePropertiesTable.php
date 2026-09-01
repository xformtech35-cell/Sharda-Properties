<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'flat',
            ],
            'purpose' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'sell',
            ],
            'property_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'residential',
            ],
            'bedrooms' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'bathrooms' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'area' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('properties');
    }

    public function down()
    {
        $this->forge->dropTable('properties');
    }
}
