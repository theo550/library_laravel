<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'description' => fake()->text(150),
            'author_id' => Author::factory()
        ];
    }
}
