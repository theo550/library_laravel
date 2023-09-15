<?php

namespace Database\Factories;

use App\Models\BookVersion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library>
 */
class LibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reading_state' => 'non lu',
            'book_version_id' => BookVersion::factory(),
            'user_id' => User::factory()
        ];
    }
}
