<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert([
            ['role' => 'Admin', 'code' => 'admin'],
            ['role' => 'User', 'code' => 'user'],
            ['role' => 'HR', 'code' => 'hr'],
            ['role' => 'Marketing', 'code' => 'marketing']
        ]);
    }

}
