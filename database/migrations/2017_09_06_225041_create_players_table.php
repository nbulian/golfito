<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$table = "CREATE TABLE players(
                    `id_players` INTEGER PRIMARY KEY AUTOINCREMENT,
                    `email` TEXT NOT NULL,
                    `name` TEXT NOT NULL,
                    `created_at` INTEGER NOT NULL,
                    `updated_at` INTEGER NOT NULL,
                    UNIQUE (`email`)
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
        Schema::drop('players');
    }
}
