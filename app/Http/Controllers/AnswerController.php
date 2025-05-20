<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Answer::with(['user','question'])->get());
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
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'is_accepted' => 'boolean',
        ]);
        $answer = Answer::create($validated);
        return response()->json($answer->load(['user','question']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Answer::with(['user','question'])->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        $this->authorize('update', $answer);
        $validated = $request->validate([
            'content' => 'required',
        ]);
        $answer->update($validated);
        return redirect()->route('questions.show', $answer->question_id)->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return response()->json(['message' => 'Deleted']);
    }

public function vote(Request $request, Answer $answer)
{
    $request->validate([
        'vote_type' => 'required|in:up,down',
    ]);

    $user = auth()->user();

    DB::transaction(function () use ($request, $user, $answer) {
        // Lấy bản ghi vote hiện tại của user cho answer này (khóa lại để tránh xung đột)
        $vote = $answer->votes()->where('user_id', $user->id)->lockForUpdate()->first();

        if ($vote) {
            if ($vote->vote_type === $request->vote_type) {
                // Nếu nhấn lại cùng loại vote => xóa (bỏ vote)
                $vote->delete();
            } else {
                // Nếu đổi loại vote => cập nhật
                $vote->update([
                    'vote_type' => $request->vote_type,
                ]);
            }
        } else {
            // Nếu chưa vote => tạo mới
            $answer->votes()->create([
                'user_id' => $user->id,
                'vote_type' => $request->vote_type,
            ]);
        }
    });

    return back();
}

}