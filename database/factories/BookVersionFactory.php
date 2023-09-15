<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Edition;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookVersion>
 */
class BookVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'published_date' => now(),
            'book_id' => Book::factory(),
            'publisher_id' => Publisher::factory(),
            'edition_id' => Edition::factory(),
        ];
    }
}
