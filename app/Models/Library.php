<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    function bookVersions()
    {
        return $this->hasMany(BookVersion::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
