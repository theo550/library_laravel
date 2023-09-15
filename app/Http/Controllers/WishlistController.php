<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlist = Wishlist::with('user')->get();

        return response()->json(
            $wishlist
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
            'book_version_id' => 'required',
            'user_id' => 'required'
        ]);

        $wishlist = new Wishlist();
        $wishlist->book_version_id = $request->book_version_id;
        $wishlist->user_id = $request->user_id;

        $wishlist->save();

        return response()->json(
            $wishlist
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wishlist = Wishlist::with('user')
            ->where('id', $id)
            ->get();

        return response()->json(
            $wishlist
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'book_version_id' => 'required',
            'user_id' => 'required'
        ]);

        $wishlist = Wishlist::findOrFail($id);
        $wishlist->book_version_id = $request->book_version_id;
        $wishlist->user_id = $request->user_id;

        $wishlist->save();

        return response()->json(
            $wishlist
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Wishlist::findOrFail($id)->delete();

        return 'Wishlist successfully deleted!';
    }
}
