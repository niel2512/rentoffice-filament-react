<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeSpace extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'thumbnail',
        'is_open',
        'is_full_booked',
        'price',
        'duration',
        'address',
        'about',
        'slug',
        'city_id',
    ];

    //assessors untuk menampilkan data
    //set attribute untuk mengubah data sebelum disimpan ke database
    public function setNameAttribute($value)
    {
        //atribut name diisi dengan value
        $this->attributes['name'] = $value; //misal value = 'Kantor 1'
        //method str untuk mengubah string menjadi slug
        //atribut slug diisi dengan slug dari value
        $this->attributes['slug'] = Str::slug($value); //maka slug jadi = 'kantor-1'
    }

    public function photos(): HasMany
    {
        return $this->hasMany(OfficeSpacePhoto::class);
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(OfficeSpaceBenefit::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function booking()
    // {
    //     return $this->hasMany(BookingTransaction::class);
    // }
}
