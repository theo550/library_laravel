<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'published_date'
    ];

    function publishers()
    {
        return $this->hasOne(Publisher::class);
    }

    function editions()
    {
        return $this->belongsTo(Edition::class);
    }

    function libraries()
    {
        return $this->belongsToMany(Library::class);
    }

    function wishlists()
    {
        return $this->belongsTo(Wishlist::class);
    }

    function book()
    {
        return $this->belongsTo(Book::class);
    }

    function users()
    {
        return $this->belongsToMany(User::class, 'libraries', 'book_version_id');
    }
}
