<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Expense extends Model
{
    use \App\Models\Concerns\HasAttachments;

    public const ATTACHMENT_TYPE = 'expense';

    protected $guarded = [];
}
