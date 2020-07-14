<?php

namespace App\Database\Seeds\Initialize;

use \CodeIgniter\Database\Seeder;

class InsertPermission extends Seeder {

    public function run() {
        $this->db->query('DELETE FROM auth_permission');
        $this->db->query('INSERT INTO auth_permission (id_auth_group, id_sys_route) (SELECT 1, id FROM sys_route WHERE access IN (\'protected\',\'private\'))');
    }

}
