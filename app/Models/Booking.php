<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use \App\Models\Concerns\HasAttachments;

    public const ATTACHMENT_TYPE = 'booking';

    protected $guarded = [];

    protected $casts = [
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    /** Every @json($bookings) payload carries the labels the tables print. */
    protected $appends = ['arrival_time', 'departure_time', 'arrival_date', 'departure_date', 'arrival_is_actual', 'departure_is_actual'];

    public function getArrivalTimeAttribute(): ?string
    {
        return $this->arrivalLabel();
    }

    public function getDepartureTimeAttribute(): ?string
    {
        return $this->departureLabel();
    }

    /** Once the desk stamps a moment, the date shown must come from it too, or the row
     *  mixes a booked date with a real time. */
    public function getArrivalDateAttribute(): ?string
    {
        return $this->checked_in_at ? $this->checked_in_at->toDateString() : $this->check_in;
    }

    public function getDepartureDateAttribute(): ?string
    {
        return $this->checked_out_at ? $this->checked_out_at->toDateString() : $this->check_out;
    }

    public function getArrivalIsActualAttribute(): bool
    {
        return $this->hasArrivalTime();
    }

    public function getDepartureIsActualAttribute(): bool
    {
        return $this->hasDepartureTime();
    }

    /**
     * When the stay started and ended, as the desk recorded it.
     * Falls back to the booked date with the standard 12:00 PM desk time, so a booking
     * that has not been checked in yet still reads sensibly.
     */
    public function arrivalLabel(): ?string
    {
        return $this->stampLabel($this->checked_in_at, $this->check_in);
    }

    public function departureLabel(): ?string
    {
        return $this->stampLabel($this->checked_out_at, $this->check_out);
    }

    /** True once the desk has stamped the moment, rather than falling back to the booked date. */
    public function hasArrivalTime(): bool
    {
        return (bool) $this->checked_in_at;
    }

    public function hasDepartureTime(): bool
    {
        return (bool) $this->checked_out_at;
    }

    private function stampLabel($stamp, $bookedDate): ?string
    {
        if ($stamp) {
            return $stamp->format('g:i A');
        }

        return $bookedDate ? '12:00 PM' : null;
    }
}
