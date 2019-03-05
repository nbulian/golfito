<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$table = "CREATE TABLE tournaments(
                    `id_tournaments` INTEGER PRIMARY KEY AUTOINCREMENT,
                    `type` INTEGER DEFAULT 1 NOT NULL,
                    `date` INTEGER NOT NULL,
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
        Schema::drop('tournaments');
    }
}
