<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Comment::with('user')->get());
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
            'comment' => 'required',
            'note' => 'required',
            'user_id' => 'required',
            'book_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->note = $request->note;
        $comment->user_id = $request->user_id;
        $comment->book_id = $request->book_id;

        $comment->save();

        return response()->json(
            $comment
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Comment::with('user')->where('id', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'comment' => 'required',
            'note' => 'required',
            'user_id' => 'required',
            'book_id' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->note = $request->note;
        $comment->user_id = $request->user_id;
        $comment->book_id = $request->book_id;

        $comment->save();

        return response()->json(
            $comment
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();

        return 'Comment with id ' . $id . ' has been successfully deleted!';
    }
}
