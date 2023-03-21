<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@gmail.com',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'name' => 'admin 123'
            ],
            [
                'email' => 'user@gmail.com',
                'password' => password_hash('123456', PASSWORD_BCRYPT),
                'name' => 'user 123'
            ]

        ];

        // Simple Queries
        //$this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}