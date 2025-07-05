<nav class="bg-white dark:bg-gray-900 shadow-md fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('asset/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="text-lg font-semibold text-blue-600 dark:text-white">Ngkost</span>
            </a>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                {{-- If Not Logged In --}}
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Login
                    </a>
                @endguest

                {{-- If Logged In --}}
                @auth
                    {{-- Admin Panel Link --}}
                    @if(Auth::user()->role === 'pengelola')
                        <a href="{{ route('admin.home') }}" class="text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400 transition">
                            Admin Panel
                        </a>
                    @endif

                    {{-- Logout Form --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 dark:text-gray-200 hover:text-red-600 dark:hover:text-red-400 transition">
                            Logout
                        </button>
                    </form>
                @endauth

                {{-- Theme Toggle --}}
                <button id="theme-toggle" class="text-gray-500 dark:text-gray-300 hover:text-black dark:hover:text-white transition">
                    <svg id="icon-sun" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15a5 5 0 100-10 5 5 0 000 10z" />
                    </svg>
                    <svg id="icon-moon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8 8 0 1010.586 10.586z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
