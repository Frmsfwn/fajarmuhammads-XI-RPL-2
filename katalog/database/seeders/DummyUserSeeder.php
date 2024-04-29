<?php

namespace Database\Seeders;

use App\Models\user;
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
                'id'=>'1',
                'username'=>'adiAdmin',
                'email'=>'adi@gmail.com',
                'email_verified_status'=>'true',
                'email_verified_at'=>now(),
                'password'=>bcrypt('adi123'),
                'name'=>'Adi',
                'gender'=>'Pria',
                'number'=>'0898213514555',
                'role'=>'admin',
            ],[
                'id'=>'2',
                'username'=>'andiUser',
                'email'=>'andi@gmail.com',
                'email_verified_status'=>'true',
                'email_verified_at'=>now(),
                'password'=>bcrypt('andi123'),
                'name'=>'Andi',
                'gender'=>'Pria',
                'number'=>'0898213514555',
                'role'=>'user',
            ],
        ];
        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
