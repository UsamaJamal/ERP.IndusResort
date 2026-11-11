<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** A cash entry that is neither a sale nor an expense: top-up, transfer or cash out. */
class CashMovement extends Model
{
    use \App\Models\Concerns\HasAttachments;

    public const ATTACHMENT_TYPE = 'cash';

    protected $guarded = [];

    public const TYPES = ['topup' => 'Petty Cash Top-up', 'transfer' => 'Manager Cash to Petty Transfer', 'cash_out' => 'Cash Out', 'handover' => 'Cash Out to Owner'];

    protected $casts = ['confirmed_at' => 'datetime'];
}
