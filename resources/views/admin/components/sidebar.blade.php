<aside class="w-64 bg-white dark:bg-gray-900 shadow-md min-h-screen hidden md:block">
    <div class="p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">🛠️ Admin Panel</h2>
        <nav class="space-y-2">

            @php
                $routes = [
                    ['url' => '/admin/home', 'label' => 'Dashboard'],
                    ['url' => '/admin/status', 'label' => 'Laundry'],
                    ['url' => '/admin/laporan', 'label' => 'Laporan'],
                    ['url' => '/admin/notifikasi', 'label' => 'Notifikasi'],
                    ['url' => '/admin/settings', 'label' => 'Settings'],
                ];
            @endphp

            @foreach ($routes as $item)
                <a href="{{ $item['url'] }}"
                    class="block py-2 px-4 rounded-lg transition
                        {{ request()->is(ltrim($item['url'], '/').'*') 
                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-800/30 dark:text-white font-semibold'
                            : 'text-gray-700 hover:bg-indigo-50 dark:text-gray-300 dark:hover:bg-indigo-800/10' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- <a href="/logout"
                class="block py-2 px-4 rounded-lg text-red-600 hover:bg-red-100 dark:hover:bg-red-900/20">
                Logout
            </a> --}}
        </nav>
    </div>
</aside>
