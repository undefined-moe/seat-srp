<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MigrateDenngarr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('seat_srp_srp')) {
            DB::statement('INSERT cryptatech_seat_srp_srp SELECT * FROM seat_srp_srp');
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TODO: make this delete the settings, dont truncate tables as we dont know what else was added.
        return;
    }
}
