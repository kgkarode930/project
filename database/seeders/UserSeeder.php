<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return $this->createUsers();
    }

    /**
     * Function for create users
     */
    public function createUsers()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Create Admin User
        User::updateOrCreate(['id' => 1], [
            'name'     => 'ADMIN USER',
            'email'    => 'admin.user@yopmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'mobile_number' => '1234567890',
            'country_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
        ]);
        return true;
    }
}
