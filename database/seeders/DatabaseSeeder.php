<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookVersion;
use App\Models\Comment;
use App\Models\Edition;
use App\Models\Library;
use App\Models\Publisher;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wishlist;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Tag::factory(10)->create();
        // Author::factory(10)->create();
        // Edition::factory(10)->create();
        // Publisher::factory(10)->create();
        // Book::factory(10)->create();
        // BookVersion::factory(10)->create();
        Comment::factory(10)->create();
        Library::factory(10)->create();
        Wishlist::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
