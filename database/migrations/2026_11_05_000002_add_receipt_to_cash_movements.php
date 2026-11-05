<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Optional receipt for a cash entry: a transfer screenshot, deposit slip or PDF. */
return new class extends Migration
{
    public function up()
    {
        Schema::table('cash_movements', function (Blueprint $table) {
            $table->string('receipt_path')->nullable()->after('note');
        });
    }

    public function down()
    {
        Schema::table('cash_movements', function (Blueprint $table) {
            $table->dropColumn('receipt_path');
        });
    }
};
