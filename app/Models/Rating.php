<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'rate',
        'office_space_id',
    ];


    public function officeSpace(): BelongsTo
    {
        return $this-> belongsTo(OfficeSpace::class);
    }
}