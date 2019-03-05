<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('UsersTableSeeder');
        $this->command->info("Users table seeded :)");
        $this->call('PlayersTableSeeder');
        $this->command->info("Players table seeded :)");
        $this->call('TournamentsTableSeeder');
        $this->command->info("Tournaments table seeded :)");
        $this->call('RoundsTableSeeder');
        $this->command->info("Rounds table seeded :)");
        $this->call('GamesTableSeeder');
        $this->command->info("Game table seeded :)");
        $this->call('RankingTableSeeder');
        $this->command->info("Ranking table seeded :)");
    }
}
