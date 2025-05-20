@extends('layouts.app')

@section('title', 'Chỉnh sửa câu trả lời')

@section('content')
    <div class="container mx-auto max-w-2xl py-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Chỉnh sửa câu trả lời</h2>
        <form method="POST" action="{{ route('answers.update', $answer->id) }}">
            @csrf
            @method('PUT')
            <textarea name="content" rows="6"
                class="w-full border rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>{{ old('content', $answer->content) }}</textarea>
            <div class="text-right">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded font-semibold transition">Cập
                    nhật</button>
            </div>
        </form>
    </div>
@endsection
