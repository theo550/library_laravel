<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    function BookVersion()
    {
        return $this->hasMany(BookVersion::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
