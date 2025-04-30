<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSpacePhoto extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'photo',
        'office_space_id',
    ];
}
