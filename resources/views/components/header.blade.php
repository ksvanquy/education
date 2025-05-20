<!-- Header -->
<header class="bg-white shadow sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between py-2 px-4 max-w-7xl">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
            <a href="{{ url('/') }}" class="font-bold text-lg text-blue-600 ml-2">Hoidap247</a>
        </div>
        <form class="flex-1 mx-6 max-w-xl flex" method="GET" action="#">
            <input type="text" placeholder="Câu hỏi của bạn là gì?"
                class="w-full border rounded-full px-3 py-2 focus:outline-none">
            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 ml-2 rounded-full">Tìm</button>
        </form>
        <div class="flex items-center gap-4">
            @auth
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                        class="h-8 w-8 rounded-full" alt="User">
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline">Đăng xuất</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đăng nhập</a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Đăng ký</a>
            @endauth
        </div>
    </div>
</header>
