<?php

namespace App\Http\Controllers;

use App\Models\BookVersion;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $library = Library::with('user')->get();

        return response()->json(
            $library
        );
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
            'reading_state' => 'required',
            'book_version_id' => 'required',
            'user_id' => 'required'
        ]);

        $library = new Library();
        $library->reading_state = $request->reading_state;
        $library->book_version_id = $request->book_version_id;
        $library->user_id = $request->user_id;

        $library->save();

        return response()->json(
            $library
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $library = Library::with('user')->where('id', $id)->get();

        return response()->json(
            $library
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'reading_state' => 'required',
            'book_version_id' => 'required',
            'user_id' => 'required'
        ]);

        $library = Library::findOrFail($id);
        $library->reading_state = $request->reading_state;
        $library->book_version_id = $request->book_version_id;
        $library->user_id = $request->user_id;

        $library->save();

        return response()->json(
            $library
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Library::findOrFail($id)->delete();

        return 'Library successfully deleted!';
    }
}
