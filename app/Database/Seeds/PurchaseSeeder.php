<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'name' => 'dung thu',
                'price' =>'100$',
                'email_address' =>'asdf',
                'storage'=>'12gb',
                'databases'=>'234',
                'domains'=>'23',
                'suppor'=>'24/24',
            ],
            [
                'name' => 'dung thu 12',
                'price' =>'100$',
                'email_address' =>'asdf',
                'storage'=>'12gb',
                'databases'=>'234',
                'domains'=>'23',
                'suppor'=>'24/24',
            ],
            [
                'name' => 'dung thu 1 ',
                'price' =>'100$',
                'email_address' =>'asdf',
                'storage'=>'12gb',
                'databases'=>'234',
                'domains'=>'23',
                'suppor'=>'24/24',
            ]
        ];
        $this->db->table('purchases')->insertBatch($data);
    }
}
