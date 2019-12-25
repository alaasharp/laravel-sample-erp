<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'Name' => 'Administrator',
            'Password' => bcrypt('password'),
            'isAdmin' => 1
            ]);
    }
}
