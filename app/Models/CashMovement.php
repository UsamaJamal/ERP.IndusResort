<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** A cash entry that is neither a sale nor an expense: top-up, transfer or cash out. */
class CashMovement extends Model
{
    protected $guarded = [];

    public const TYPES = ['topup' => 'Petty Cash Top-up', 'transfer' => 'Income to Petty Transfer', 'cash_out' => 'Cash Out'];
}
