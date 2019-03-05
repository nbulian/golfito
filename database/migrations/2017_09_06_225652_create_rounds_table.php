<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$table = "CREATE TABLE rounds(
                    `id_rounds` INTEGER PRIMARY KEY AUTOINCREMENT,
                    `id_tournaments` INTEGER NOT NULL,
                    `round` INTEGER DEFAULT 1 NOT NULL,
                    UNIQUE (`id_tournaments`, `id_rounds`)
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
        Schema::drop('rounds');
    }
}
