<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Notification::with(['user','question','answer'])->get());
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
            'type' => 'required|in:answer,comment,other',
            'content' => 'nullable|string|max:255',
            'is_read' => 'boolean',
        ]);
        $notification = Notification::create($validated);
        return response()->json($notification->load(['user','question','answer']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Notification::with(['user','question','answer'])->findOrFail($id));
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
        $notification = Notification::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'nullable|exists:questions,id',
            'answer_id' => 'nullable|exists:answers,id',
            'type' => 'required|in:answer,comment,other',
            'content' => 'nullable|string|max:255',
            'is_read' => 'boolean',
        ]);
        $notification->update($validated);
        return response()->json($notification->load(['user','question','answer']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
