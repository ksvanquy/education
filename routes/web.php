<?php

use Illuminate\Support\Facades\Route;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\User;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang chủ với filter, phân trang, truyền biến cho home.blade.php
Route::get('/', function () {
    $query = Question::with(['subject','grade','user','tags'])->orderBy('created_at','desc');
    if ($gradeId = request('grade_id')) {
        $query->where('grade_id', $gradeId);
    }
    if ($subjectId = request('subject_id')) {
        $query->where('subject_id', $subjectId);
    }
    if ($status = request('status')) {
        $query->where('status', $status);
    }
    $questions = $query->paginate(5)->appends(request()->query());
    $questionCount = Question::count();
    $answeredCount = Question::where('status', 'answered')->count();
    $subjects = Subject::all();
    $grades = Grade::all();
    $topUsers = User::select('id','name','email')->take(5)->get();
    return view('home', compact('questions','questionCount','answeredCount','subjects','grades','topUsers'));
});

Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{id}', [QuestionController::class, 'show'])->name('questions.answer');
Route::post('/questions', [QuestionController::class, 'store'])->middleware('auth')->name('questions.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

    Route::get('/answers/{answer}/edit', [AnswerController::class, 'edit'])->name('answers.edit');
    Route::put('/answers/{answer}', [AnswerController::class, 'update'])->name('answers.update');

    Route::post('/questions/{question}/vote', [QuestionController::class, 'vote'])->name('questions.vote');
    Route::post('/answers/{answer}/vote', [AnswerController::class, 'vote'])->name('answers.vote');
});

require __DIR__.'/auth.php';