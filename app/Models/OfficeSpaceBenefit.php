<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSpaceBenefit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'office_space_id',
    ];
    
}
