<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionTag;

class QuestionTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(QuestionTag::all());
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
            'question_id' => 'required|exists:questions,id',
            'tag_id' => 'required|exists:tags,id',
        ]);
        $qt = QuestionTag::create($validated);
        return response()->json($qt, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(QuestionTag::findOrFail($id));
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
        $qt = QuestionTag::findOrFail($id);
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'tag_id' => 'required|exists:tags,id',
        ]);
        $qt->update($validated);
        return response()->json($qt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $qt = QuestionTag::findOrFail($id);
        $qt->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
