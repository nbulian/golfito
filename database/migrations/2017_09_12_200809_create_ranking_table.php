<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$table = "CREATE TABLE ranking(
                	`id_tournaments` INTEGER NOT NULL,
                	`id_players` INTEGER NOT NULL,
                	`points` INTEGER DEFAULT 0 NOT NULL,
                	`created_at` INTEGER NOT NULL,
                	`updated_at` INTEGER NOT NULL,
                	 PRIMARY KEY (`id_tournaments`, `id_players`)
                );";
                
		DB::connection()->statement($table);    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ranking');
    }
}
