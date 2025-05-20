<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Grade;
use App\Models\Subject;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Question::with(['user','subject','grade','tags'])->get());
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
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để gửi câu hỏi.');
        }
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|string',
            'moderation_status' => 'required|string',
        ]);
        $validated['user_id'] = auth()->id();

        $question = Question::create($validated);

        // Nếu có tags thì xử lý như cũ
        if ($request->has('tags')) {
            $question->tags()->sync($request->input('tags'));
        }

        Alert::success('Thành công', 'Câu hỏi của bạn đã được gửi thành công!')->autoClose(3000);
        // Redirect về trang chủ với thông báo
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $question = \App\Models\Question::with(['user','subject','grade','answers.user','tags'])->findOrFail($id);
        $answers = $question->answers;
        // Xử lý gửi trả lời
        if (request()->isMethod('post')) {
            request()->validate([
                'content' => 'required|string|min:5',
            ]);
            $userId = auth()->check() ? auth()->id() : 1; // Nếu chưa đăng nhập thì gán user_id=1 (hoặc xử lý khác tuỳ ý)
            \App\Models\Answer::create([
                'question_id' => $question->id,
                'user_id' => $userId,
                'content' => request('content'),
            ]);
            // Cập nhật trạng thái câu hỏi thành 'answered' nếu chưa phải
            if ($question->status !== 'answered') {
                $question->status = 'answered';
                $question->save();
            }
            return redirect()->route('questions.show', $question->id)->with('success', 'Đã gửi trả lời!');
        }
        return view('question_detail', compact('question', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('questions.edit', compact('question', 'grades', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $question->update($validated);
        return redirect()->route('questions.show', $question->id)->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function vote(Request $request, Question $question)
    {
        $request->validate(['vote_type' => 'required|in:up,down']);
        $user = auth()->user();
        $vote = $question->votes()->where('user_id', $user->id)->first();
        if ($vote) {
            if ($vote->vote_type === $request->vote_type) {
                $vote->delete();
            } else {
                $vote->update(['vote_type' => $request->vote_type]);
            }
        } else {
            $question->votes()->create([
                'user_id' => $user->id,
                'vote_type' => $request->vote_type
            ]);
        }
        return back();
    }
}