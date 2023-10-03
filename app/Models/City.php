<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
