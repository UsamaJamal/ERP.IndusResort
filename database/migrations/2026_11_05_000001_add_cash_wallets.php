<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The resort keeps money in two places: income cash (what guests and diners paid) and
 * petty cash (what the owner sends for running costs). Every expense now records which
 * of the two it was paid from, and cash_movements holds the entries that are not sales
 * or expenses: owner top-ups, income-to-petty transfers and cash handed out.
 *
 * Existing expenses default to "income", which is how the system treated them before.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('paid_from', 20)->default('income')->after('amount');
        });

        Schema::create('cash_movements', function (Blueprint $table) {
            $table->id();
            // topup: owner money into petty. transfer: income cash into petty.
            // cash_out: cash leaving a wallet (handed to the owner, banked).
            $table->string('type', 20);
            // The wallet a cash_out leaves. Top-ups and transfers always land in petty.
            $table->string('wallet', 20)->default('petty');
            $table->unsignedInteger('amount');
            $table->date('date');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_movements');
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('paid_from');
        });
    }
};
