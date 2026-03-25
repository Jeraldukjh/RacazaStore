<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsActiveToAdminsAndStaff extends Migration
{
    public function up()
    {
        $fields = [
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => false,
                'default' => 1,
            ],
        ];

        $this->forge->addColumn('admins', $fields);
        $this->forge->addColumn('staff', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('admins', 'is_active');
        $this->forge->dropColumn('staff', 'is_active');
    }
}
