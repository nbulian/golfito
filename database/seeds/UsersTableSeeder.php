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
        DB::table('users')->insert([
            'name' => 'Golfito',
            'email' => 'hello@golf.ito',
            'password' => bcrypt('Qaz11qaz'),
        ]);
        
		$this->command->info("Users table seeded :)");
    }
}
