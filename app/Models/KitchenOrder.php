<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** One restaurant bill. Sales figures count paid, non-complimentary orders only. */
class KitchenOrder extends Model
{
    use \App\Models\Concerns\HasAttachments;

    public const ATTACHMENT_TYPE = 'kitchen';

    protected $guarded = [];

    public const TYPES = ['walk_in' => 'Walk-in', 'room_guest' => 'Room Guest', 'complimentary' => 'Complimentary'];

    public function items()
    {
        return $this->hasMany(KitchenOrderItem::class);
    }

    /** Orders that are real income: paid for, and not on the house. */
    public function scopeSales($query)
    {
        return $query->where('payment_status', 'paid')->where('type', '!=', 'complimentary');
    }
}
