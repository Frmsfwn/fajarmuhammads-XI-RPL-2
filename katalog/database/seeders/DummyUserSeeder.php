<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'id'=>'1111',
                'username'=>'adiAdmin',
                'email'=>'adi@gmail.com',
                'password'=>'adi123',
                'nama'=>'Adi',
                'jk'=>'Pria',
                'notelp'=>'0898213514555',
                'role'=>'admin',
            ],
            [
                'id'=>'1112',
                'username'=>'andiUser',
                'email'=>'andi@gmail.com',
                'password'=>'andi123',
                'nama'=>'Andi',
                'jk'=>'Pria',
                'notelp'=>'0898213514555',
                'role'=>'user',
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
