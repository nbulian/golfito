<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = "INSERT INTO players VALUES (NULL, 'cristian@golf.ito', 'Cristian',  datetime('now'), datetime('now')  ), (NULL, 'erwin@golf.ito', 'Erwin',  datetime('now'), datetime('now')  ), (NULL, 'nahuel@golf.ito', 'Nahuel',  datetime('now'), datetime('now')  ), (NULL, 'martin@golf.ito', 'Martin',  datetime('now'), datetime('now')  ), (NULL, 'pablo@golf.ito', 'Pablo',  datetime('now'), datetime('now')  ), (NULL, 'jose.pablo@golf.ito', 'José Pablo',  datetime('now'), datetime('now') ), (NULL, 'diego@golf.ito', 'Diego',  datetime('now'), datetime('now')  ), (NULL, 'sebastian@golf.ito', 'Sebastian',  datetime('now'), datetime('now') );";
        
		DB::connection()->insert( $query );
		
		$this->command->info("Players table seeded :)");
    }
}
