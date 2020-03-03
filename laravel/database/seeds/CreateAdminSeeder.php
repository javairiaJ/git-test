<?php

use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'firstName' => 'Admin',
            'lastName' => 'Ivacy',
            'email' => 'admin.ivacy@yopmail.com',
            'password' => '$2y$10$QV/k6ysa9JFbD..QzffhNOKq66/.hgGVEbMn7S6fSWbXocoKW3p6W', //admin123
            'remember_token' => str_random(30),
            'role_id' => 1,
            'isConfirmed' => 1,
            'key' => str_random(30)
        ]);
    }

}
