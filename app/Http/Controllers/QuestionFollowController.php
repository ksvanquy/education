<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionFollow;

class QuestionFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(QuestionFollow::all());
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
            'question_id' => 'required|exists:questions,id',
        ]);
        $follow = QuestionFollow::create($validated);
        return response()->json($follow, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(QuestionFollow::findOrFail($id));
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
        $follow = QuestionFollow::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:questions,id',
        ]);
        $follow->update($validated);
        return response()->json($follow);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $follow = QuestionFollow::findOrFail($id);
        $follow->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
