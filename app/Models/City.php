<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'photo',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        //atribut name diisi dengan value
        $this->attributes['name'] = $value; //misal value = 'Kantor 1'
        //method str untuk mengubah string menjadi slug
        //atribut slug diisi dengan slug dari value
        $this->attributes['slug'] = Str::slug($value); //maka slug jadi = 'kantor-1'
    }

    //ORM relationship
    public function officeSpaces(): HasMany
    {
        return $this->hasMany(OfficeSpace::class);
    }
}
