@extends('layouts.app')

@section('title', 'Chỉnh sửa câu hỏi')

@section('content')
    <div class="container mx-auto max-w-2xl py-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Chỉnh sửa câu hỏi</h2>
        <form method="POST" action="{{ route('questions.update', $question->id) }}">
            @csrf
            @method('PUT')
            <div class="flex flex-col sm:flex-row gap-2 mb-4">
                <select name="grade_id"
                    class="border rounded px-3 py-2 bg-white flex-1 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    required>
                    <option value="">Chọn lớp</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $question->grade_id == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }}</option>
                    @endforeach
                </select>
                <select name="subject_id"
                    class="border rounded px-3 py-2 bg-white flex-1 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    required>
                    <option value="">Chọn môn</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $question->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <input name="title" type="text"
                class="w-full border rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Nhập tiêu đề câu hỏi" maxlength="255" value="{{ old('title', $question->title) }}" required>
            <textarea name="content" rows="4"
                class="w-full border rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                placeholder="Nhập nội dung câu hỏi..." required>{{ old('content', $question->content) }}</textarea>
            <div class="text-right">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded font-semibold transition">Cập
                    nhật</button>
            </div>
        </form>
    </div>
@endsection
