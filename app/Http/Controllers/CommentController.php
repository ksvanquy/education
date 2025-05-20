<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Comment::with(['user','question','answer'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Not supported'], 405);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'nullable|exists:questions,id',
            'answer_id' => 'nullable|exists:answers,id',
            'content' => 'required|string',
        ]);
        $comment = Comment::create($validated);
        return response()->json($comment->load(['user','question','answer']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Comment::with(['user','question','answer'])->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return response()->json(['message' => 'Not supported'], 405);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'nullable|exists:questions,id',
            'answer_id' => 'nullable|exists:answers,id',
            'content' => 'required|string',
        ]);
        $comment->update($validated);
        return response()->json($comment->load(['user','question','answer']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
