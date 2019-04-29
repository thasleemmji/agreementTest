<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	//creating test Admin
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'username' => 'admin',
            'password' => bcrypt('admin@123'),
            'role' => true,
            'status' => '1'
        ]);

        //creating test Agents
        for($i=1;$i<11;$i++) {
        	$agent = 'agent_'.$i;
        	DB::table('users')->insert([
	            'name' => ucwords($agent),
	            'email' => $agent.'@test.com',
	            'username' => $agent,
	            'password' => bcrypt('agent@123'),
	            'role' => false,
	            'status' => '1'
	        ]);
        }
        
    }
}
