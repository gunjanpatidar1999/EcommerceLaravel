<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
             'firstname'=>'Admin',
             'lastname'=>'admin',
             'email'=>'Admin@1999',
             'password'=>Hash::make('12345678'),
             'status'=>'1', // 1 = Active and 0 = Inactive
             'role_id'=>'2'

        ]);

    }
}
