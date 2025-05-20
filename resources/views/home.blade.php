@extends('layouts.app')

@section('title', 'Hoidap247 - Trang chủ')

@section('content')
    @include('components.left-sidebar')
    @include('sweetalert::alert')

    <section class="flex-1">
        @include('components.question-modal')

        <form method="GET" class="flex items-center mb-2 gap-3">
            <select name="grade_id" class="border rounded px-2 py-1 pr-8 appearance-none">
                <option value="">Tất cả</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="border rounded px-2 py-1 pr-8 appearance-none">
                <option value="">Tất cả trạng thái</option>
                <option value="answered" {{ request('status') == 'answered' ? 'selected' : '' }}>Đã trả lời</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chưa trả lời</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Lọc</button>
        </form>


        <div class="space-y-4">
            @foreach ($questions as $question)
                @include('components.question', [
                    'id' => $question->id,
                    'subject' => $question->subject->name ?? '',
                    'grade' => $question->grade->name ?? '',
                    'time' => $question->created_at->diffForHumans(),
                    'status' => $question->status === 'answered' ? 'Đã trả lời' : 'Chưa trả lời',
                    'question' => $question->title,
                    'tags' => $question->tags ?? [],
                    'votes' =>
                        $question->votes->where('vote_type', 'up')->count() -
                        $question->votes->where('vote_type', 'down')->count(),
                ])
            @endforeach
        </div>

        <div class="text-center mt-4">
            {{ $questions->links() }}
        </div>
    </section>

    @include('components.right-sidebar')
@endsection
