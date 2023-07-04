<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username'=> 'Mera123',
                'name' => 'Merary Pineda',
                'correo' => 'patitas@gmail.com',
                'nacimiento' => '19990909',
                'identidad' => '0703200004968',
                'telefono' => '33094090',
                'password' => bcrypt('patitas'),
            ]
        );

      


    }
}
