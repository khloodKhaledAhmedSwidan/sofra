<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Client::create([
            'name' => 'Omar',
            'email' => 'omarSwidan@yahoo.com',
            'phone'=>'01234567896',
            'region_id'=>1,
            'photo'=>'uploads/auth/157953848182394.jpg',
            'password' => bcrypt(123456789),
            'remember_token' => Str::random(10),

        ]);
    }
}
