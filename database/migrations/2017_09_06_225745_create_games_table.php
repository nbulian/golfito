<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$table = "CREATE TABLE games(
                    `id_games` INTEGER PRIMARY KEY AUTOINCREMENT,
                    `id_rounds` INTEGER NOT NULL,
                    `id_players` INTEGER NOT NULL,
                    `shots` INTEGER NOT NULL,
                    `single_point` INTEGER DEFAULT 0 NOT NULL,
                    `two_point` INTEGER DEFAULT 0 NOT NULL,
                    `three_point` INTEGER DEFAULT 0 NOT NULL,
                    `created_at` INTEGER NOT NULL,
                    `updated_at` INTEGER NOT NULL
                );";
                
		DB::connection()->statement($table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}
