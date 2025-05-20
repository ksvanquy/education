@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <div class="container mx-auto max-w-3xl py-6">
        <a href="/" class="inline-block mb-4 text-blue-500 hover:underline">&larr; Quay về trang chủ</a>
        <div class="bg-white rounded shadow p-6 mb-6">
            <div class="flex items-center gap-2 mb-2 text-sm text-gray-500">
                <span class="font-semibold text-blue-600">{{ $question->subject->name ?? '' }}</span>
                <span>-</span>
                <span>{{ $question->grade->name ?? '' }}</span>
                <span>-</span>
                <span>Hỏi bởi: {{ $question->user->name ?? 'Ẩn danh' }}</span>
                <span>-</span>
                <span>{{ $question->created_at->diffForHumans() }}</span>
            </div>
            @php
                $myQuestionVote = null;
                if (auth()->check()) {
                    $myQuestionVote = $question->votes->firstWhere('user_id', auth()->id());
                }
            @endphp
            <div class="flex items-center gap-2 mb-2">
                <form method="POST" action="{{ route('questions.vote', $question->id) }}">
                    @csrf
                    <input type="hidden" name="vote_type" value="up">
                    <button type="submit"
                        class="{{ $myQuestionVote && $myQuestionVote->vote_type == 'up' ? 'text-green-700 font-bold' : 'text-green-500' }}">▲</button>
                </form>
                <span>
                    {{ $question->votes->where('vote_type', 'up')->count() - $question->votes->where('vote_type', 'down')->count() }}
                </span>
                <form method="POST" action="{{ route('questions.vote', $question->id) }}">
                    @csrf
                    <input type="hidden" name="vote_type" value="down">
                    <button type="submit"
                        class="{{ $myQuestionVote && $myQuestionVote->vote_type == 'down' ? 'text-red-700 font-bold' : 'text-red-500' }}">▼</button>
                </form>
            </div>
            <h1 class="text-xl font-bold mb-2">{{ $question->title }}</h1>
            @if ($question->tags->count())
                <div class="mb-2">
                    @foreach ($question->tags as $tag)
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif
            <div class="text-gray-800 mb-4">{{ $question->content }}</div>
            <div class="text-xs text-gray-400">Trạng thái: <span class="font-semibold">{{ $question->status }}</span></div>
            @if (Auth::id() === ($question->user_id ?? null))
                <a href="{{ route('questions.edit', $question->id) }}"
                    class="text-blue-500 hover:underline text-sm ml-2">Sửa</a>
            @endif
        </div>

        <div class="bg-white rounded shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Câu trả lời</h2>
            @forelse($answers as $answer)
                <div class="mb-4 border-b pb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                        <span class="font-semibold">{{ $answer->user->name ?? 'Ẩn danh' }}</span>
                        <span>-</span>
                        <span>{{ $answer->created_at->diffForHumans() }}</span>
                        @if ($answer->is_accepted)
                            <span class="ml-2 px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs">Câu trả lời hay
                                nhất</span>
                        @endif
                        @if (Auth::id() === ($answer->user_id ?? null))
                            <a href="{{ route('answers.edit', $answer->id) }}"
                                class="text-blue-500 hover:underline text-xs ml-2">Sửa</a>
                        @endif
                        @php
                            $myVote = null;
                            if (auth()->check()) {
                                $myVote = $answer->votes->firstWhere('user_id', auth()->id());
                            }
                        @endphp
                        <form method="POST" action="{{ route('answers.vote', $answer->id) }}" class="ml-2">
                            @csrf
                            <input type="hidden" name="vote_type" value="up">
                            <button type="submit"
                                class="{{ $myVote && $myVote->vote_type == 'up' ? 'text-green-700 font-bold' : 'text-green-500' }}">▲</button>
                        </form>
                        <span>
                            {{ $answer->votes->where('vote_type', 'up')->count() - $answer->votes->where('vote_type', 'down')->count() }}
                        </span>
                        <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                            @csrf
                            <input type="hidden" name="vote_type" value="down">
                            <button type="submit"
                                class="{{ $myVote && $myVote->vote_type == 'down' ? 'text-red-700 font-bold' : 'text-red-500' }}">▼</button>
                        </form>
                    </div>
                    <div class="text-gray-800">{{ $answer->content }}</div>
                </div>
            @empty
                <div class="text-gray-500">Chưa có câu trả lời nào.</div>
            @endforelse
        </div>

        <div class="bg-white rounded shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Trả lời câu hỏi</h2>
            @if (session('success'))
                <div class="mb-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('questions.answer', $question->id) }}">
                @csrf
                <textarea name="content" rows="4" class="w-full border rounded px-3 py-2 mb-2" placeholder="Nhập câu trả lời..."></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Gửi trả
                    lời</button>
            </form>
        </div>
    </div>
@endsection
