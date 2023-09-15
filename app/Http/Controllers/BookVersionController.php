<?php

namespace App\Http\Controllers;

use App\Models\BookVersion;
use App\Models\Library;
use Illuminate\Http\Request;

class BookVersionController extends Controller
{
    /**
     * Add or update bookVersion method
     */
    protected function create_bookVersion(Request $request, BookVersion $bookVersion = null)
    {
        if(!$bookVersion) {
            $bookVersion = new BookVersion();
        }

        $bookVersion->published_date = $request->published_date;
        $bookVersion->book_id = $request->book_id;
        $bookVersion->publisher_id = $request->publisher_id;
        $bookVersion->edition_id = $request->edition_id;

        $bookVersion->save();

        return $bookVersion;
    }

    /**
     * BookVersion validation method
     */
    protected function validate_bookVersion_post(Request $request)
    {
        $request->validate([
            'published_date' => 'required',
            'book_id' => 'required',
            'publisher_id' => 'required',
            'edition_id' => 'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookVersion = BookVersion::with('book')->get();

        return response()->json([
            "success" => true,
            "message" => "BookVersion List",
            "data" => $bookVersion
        ]);
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
        $this->validate_bookVersion_post($request);

        $bookVersion = $this->create_bookVersion($request);

        return response()->json([
            "success" => true,
            "message" => "bookVersion created successfully.",
            "data" => $bookVersion
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return BookVersion::with('book')
            ->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookVersion $bookVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate_bookVersion_post($request);

        $bookVersion = BookVersion::findOrFail($id);
        $updated_bookVersion = $this->create_bookVersion($request, $bookVersion);

        return response()->json([
            "success" => true,
            "message" => "bookVersion created successfully.",
            "data" => $updated_bookVersion
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookVersion = BookVersion::findOrFail($id);
        $bookVersion->delete();

        return 'BookVersion successfully delete';
    }

    /**
     * Show BookVersion statistics
     * possessed_by_users: return number of time this bookversion is in user's library
     */
    public function stats(string $id)
    {
        $bookVersion = BookVersion::with('users')
            ->where('id', $id)
            ->first()
            ->users
            ->count();

        return response()->json([
            'possessed_by_users' => $bookVersion
        ]);
    }
}
