<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Receipts used to be one path column per record. They now live in one table so a
 * reservation, expense, cash entry or kitchen order can carry any number of files.
 * The old columns are left in place, untouched, and are no longer read.
 */
class CreateAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('owner_type', 20);          // booking | expense | cash | kitchen
            $table->unsignedBigInteger('owner_id');
            $table->string('kind', 20)->default('receipt'); // booking: payment | advance
            $table->string('path');
            $table->string('name')->nullable();        // the file name as it was uploaded
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->index(['owner_type', 'owner_id']);
        });

        // Carry over every receipt that is already attached.
        $sources = [
            ['bookings', 'payment_proof_path', 'booking', 'payment'],
            ['bookings', 'advance_receipt_path', 'booking', 'advance'],
            ['expenses', 'receipt_path', 'expense', 'receipt'],
            ['cash_movements', 'receipt_path', 'cash', 'receipt'],
            ['kitchen_orders', 'payment_proof_path', 'kitchen', 'receipt'],
        ];
        foreach ($sources as [$table, $column, $type, $kind]) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
                continue;
            }
            foreach (DB::table($table)->whereNotNull($column)->where($column, '!=', '')->orderBy('id')->get(['id', $column, 'created_at']) as $row) {
                DB::table('attachments')->insert([
                    'owner_type' => $type, 'owner_id' => $row->id, 'kind' => $kind,
                    'path' => $row->{$column}, 'name' => basename($row->{$column}),
                    'created_at' => $row->created_at, 'updated_at' => $row->created_at,
                ]);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
