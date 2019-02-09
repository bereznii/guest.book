<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user'.$i.'@mail.com',
                'password' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'role' => NULL,
            ]);
        }
        
    }
}
