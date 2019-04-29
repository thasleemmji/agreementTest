<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //creating test agreements
        for($i=1;$i<5;$i++) {
        	$now = date('Y-m-d H:i:s');
        	DB::table('agreements')->insert([
	            'title' => Str::random(10),
	            'content' => Str::random(700),
	            'created_by' => 1,
	            'status' => true,
	            'created_at' => $now,
	            'updated_at' => $now
	        ]);
        }
    }
}
