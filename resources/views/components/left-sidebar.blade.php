<!-- Sidebar trái -->
<aside class="w-1/6 hidden lg:block">
    <nav class="bg-white rounded shadow p-4">
        <ul class="space-y-2">
            <li>
                <a href="/" class="block px-2 py-1 rounded {{ !request('subject_id') ? 'font-bold text-yellow-500 bg-yellow-50' : '' }}">Tất cả môn</a>
            </li>
            @foreach($subjects as $subject)
                <li>
                    <a href="/?subject_id={{ $subject->id }}" class="block px-2 py-1 rounded {{ request('subject_id') == $subject->id ? 'font-bold text-yellow-500 bg-yellow-50' : '' }}">
                        {{ $subject->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
