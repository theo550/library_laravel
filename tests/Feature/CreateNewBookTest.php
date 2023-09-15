<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateNewBookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return
     * Test book creation
     */
    public function create_new_book_test()
    {
        $author = Author::factory()->create();

        $response = $this->post('api/books', [
            'title' => 'Test',
            'description' => 'Test test test',
            'author_id' => $author->id
        ]);

        $response->assertStatus(200);
        $this->assertCount(1, Book::all());
        $this->assertEquals('Test', Book::first()->title);
    }
}
