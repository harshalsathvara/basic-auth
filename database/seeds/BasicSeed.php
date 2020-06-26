<?php

use Illuminate\Database\Seeder;

class BasicSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert([
    		'name' => 'Admin User',
    		'email' => 'admin@admin.com',
    		'password' => \Hash::make('123456')
    	]);

    	\DB::table('users')->insert([
    		'name' => 'User',
    		'email' => 'user@user.com',
    		'password' => \Hash::make('123456')
    	]);
    }
}
