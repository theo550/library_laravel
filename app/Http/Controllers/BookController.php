<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::with('author', 'tags')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author_id' => 'required'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;

        $book->save();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::with('tags', 'author')->where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author_id' => 'required'
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;

        $book->save();

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::findOrFail($id)->delete();

        return 'Book successfully deleted!';
    }

    public function getBookByTag(string $id)
    {
        return Book::with('tags')->where('id', $id)->get();
    }

    public function getBookByAuthor(string $id)
    {
        return Book::with('author')->where('author_id', $id)->get();
    }

    public function stats(string $id)
    {
        $book_comments = Book::with('comments')
            ->where('id', $id)
            ->first()
            ->comments
            ->pluck('note')
            ->avg();

        return response()->json([
            "average" => $book_comments
        ]);
    }

    public function getTopFiveBooks()
    {
        return 'oui';
    }
}
