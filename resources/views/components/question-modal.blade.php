<div x-data="{ showModal: false }">
    <div class="bg-white rounded shadow p-6 mb-4 text-center">
        <h1 class="text-2xl font-bold">{{ number_format($answeredCount) }} câu hỏi đã được trả lời</h1>
        <button @click="showModal = true"
            class="mt-2 bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded font-semibold">
            ĐẶT CÂU HỎI
        </button>
    </div>

    <div x-show="showModal" x-transition @keydown.escape.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="showModal = false" class="max-w-4xl mx-auto bg-white p-6 rounded shadow relative">
            <button @click="showModal = false"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

            <h2 class="text-xl font-bold mb-4 text-center">Đặt câu hỏi về bài tập của bạn</h2>

            <form method="POST" action="/questions">
                @csrf
                <div class="flex flex-col sm:flex-row gap-2 mb-4">
                    <select name="grade_id"
                        class="border rounded px-3 py-2 bg-white flex-1 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                        <option value="">Lớp</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    <select name="subject_id"
                        class="border rounded px-3 py-2 bg-white flex-1 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                        <option value="">Chọn môn</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input name="title" type="text"
                    class="w-full border rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Nhập tiêu đề câu hỏi" maxlength="255" required>

                <textarea name="content" rows="4"
                    class="w-full border rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Nhập nội dung câu hỏi..." required></textarea>

                <input type="hidden" name="status" value="pending">
                <input type="hidden" name="moderation_status" value="pending">

                <div class="text-right">
                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded font-semibold transition">
                        Gửi câu hỏi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
