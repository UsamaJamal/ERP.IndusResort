<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Who is holding the money.
 *
 * Income is received either by the manager at the resort or by the owner directly.
 * Money the manager holds reaches the owner through a handover, which lists exactly
 * which receipts it covers. Everything recorded so far counts as received by the
 * manager, so no balance moves when this runs.
 */
class AddCashHolders extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // A booking can be paid in two parts, and each part can go to a different person.
            $table->string('advance_holder', 20)->default('manager');
            $table->unsignedBigInteger('advance_handover_id')->nullable();
            $table->timestamp('advance_confirmed_at')->nullable();
            $table->string('payment_holder', 20)->default('manager');
            $table->unsignedBigInteger('payment_handover_id')->nullable();
            $table->timestamp('payment_confirmed_at')->nullable();
        });

        Schema::table('kitchen_orders', function (Blueprint $table) {
            $table->string('received_by', 20)->default('manager');
            $table->unsignedBigInteger('handover_id')->nullable();
            $table->timestamp('owner_confirmed_at')->nullable();
        });

        // What the manager spent out of the cash he holds is settled by a handover too.
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('handover_id')->nullable();
        });

        Schema::table('cash_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('handover_id')->nullable();
            // For a petty top-up: the owner's own pocket, or the business cash he holds.
            $table->string('source', 20)->nullable();
            // A handover recorded by the manager stands unconfirmed until the owner agrees.
            $table->timestamp('confirmed_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['advance_holder', 'advance_handover_id', 'advance_confirmed_at', 'payment_holder', 'payment_handover_id', 'payment_confirmed_at']);
        });
        Schema::table('kitchen_orders', function (Blueprint $table) {
            $table->dropColumn(['received_by', 'handover_id', 'owner_confirmed_at']);
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('handover_id');
        });
        Schema::table('cash_movements', function (Blueprint $table) {
            $table->dropColumn(['handover_id', 'source', 'confirmed_at']);
        });
    }
}
