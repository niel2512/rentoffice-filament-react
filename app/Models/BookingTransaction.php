<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id',
    ];

    public function generateUniqueTrxId()
    {
        $prefix = 'TRX-';
        do{
            $randomString = $prefix . mt_rand(1000, 9999); //mt_rand untuk melakukan random angka 4 digit dari 1000-9999
        }while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function officeSpace(): BelongsTo
    {
        return $this-> belongsTo(OfficeSpace::class);
    }
}
