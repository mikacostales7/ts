<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'items_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'size' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unsigned' => false,
                'null' => true,
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'null' => false,
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false,
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
