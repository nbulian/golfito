<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = 'ALTER TABLE players ADD is_active tinyint(1) DEFAULT 1;';
        DB::connection()->statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        No es posible borrar columnas en sqlite3, en el siguiente link hay un "workaround"
        https://stackoverflow.com/questions/8442147/how-to-delete-or-add-column-in-sqlite
        */
    }
}