<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tag::with('books')->get();
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

        $tag = new Tag();
        $tag ->name = $request->name;

        $tag->save();

        return response()->json($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Tag::with('books')->where('id', $id)->get();
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
            'name' => 'required'
        ]);

        $tag = Tag::findOrFail($id);
        $tag ->name = $request->name;

        $tag->save();

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id)->delete();

        return 'Tag successfully deleted!';
    }
}
