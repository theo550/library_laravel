<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::all();
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
            'name' => 'required'
        ]);

        $author = new Author();
        $author ->name = $request->name;

        $author->save();

        return response()->json($author);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Author::with('books')->where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $author = Author::findOrFail($id);
        $author ->name = $request->name;

        $author->save();

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id)->delete();

        return 'Author successfully deleted!';
    }

    public function getAuthorBooks(string $id)
    {
        return Author::with('books', 'books.tags')->find($id);
    }

    public function stats(string $id)
    {
        $author = Author::with('books')
            ->where('id', $id)
            ->first()
            ->books
            ->count();

        return response()->json([
            "number_of_books" => $author
        ]);
    }
}
