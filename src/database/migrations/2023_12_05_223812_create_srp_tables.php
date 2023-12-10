<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSrpTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptatech_seat_srp_srp', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('character_name');
            $table->integer('kill_id')->primary();
            $table->string('kill_token');
            $table->integer('approved');
            $table->double('cost');
            $table->string('ship_type');
            $table->string('approver')->nullable();
            $table->timestamps();
        });

        Schema::create('cryptatech_srp_insurances', function (Blueprint $table) {

            $table->bigInteger('type_id');
            $table->string('name');
            $table->decimal('cost', 30, 2)->default(0.0);
            $table->decimal('payout', 30, 2)->default(0.0);

            $table->primary(['type_id', 'name']);

        });

        Schema::create('cryptatech_seat_srp_advrule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rule_type');
            $table->integer('type_id')->nullable()->unique();
            $table->integer('group_id')->nullable()->unique();
            $table->unsignedInteger('price_source');
            $table->bigInteger('base_value')->default(0);
            $table->integer('hull_percent')->default(0);
            $table->integer('fit_percent')->default(0);
            $table->integer('cargo_percent')->default(0);
            $table->boolean('deduct_insurance')->default(false);
            $table->integer('srp_price_cap')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('cryptatech_seat_quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('killmail_id')->unique();
            $table->unsignedInteger('user');
            $table->float('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cryptatech_seat_srp_srp');
        Schema::drop('cryptatech_srp_insurances');
        Schema::drop('cryptatech_seat_srp_advrule');
        Schema::drop('cryptatech_seat_quotes');
    }
}
