<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Kost XYZ') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-600 flex flex-col min-h-screen ">
    
    @include('layouts.components.navbar')

<div class="flex-grow">
    @hasSection('home')
        <section class="pt-0 @yield('section-bg', 'bg-white')" style="background-image: url('{{ asset('asset/login.png') }}');">
            @yield('home')
        </section>
    @elseif(View::hasSection('admin'))
        <section class="pt-10 @yield('section-bg', 'bg-gradient-to-r from-blue-50 to-indigo-50')">
            @yield('admin')
        </section>
    @else
        <section class="pt-0 pb-16 pt-32 @yield('section-bg', 'bg-gradient-to-r from-blue-50 to-indigo-50')">
            @yield('content')
        </section>
    @endif
</div>


    <style>
        .nav-link {
            @apply transition-all duration-300 hover:scale-105;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
        <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const iconSun = document.getElementById('icon-sun');
        const iconMoon = document.getElementById('icon-moon');

        function updateThemeIcons() {
            if (document.documentElement.classList.contains('dark')) {
                iconMoon.classList.remove('hidden');
                iconSun.classList.add('hidden');
            } else {
                iconSun.classList.remove('hidden');
                iconMoon.classList.add('hidden');
            }
        }

        if (localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
        updateThemeIcons();

        themeToggle?.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            updateThemeIcons();
        });

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    @include('layouts.components.footer')
</body>
</html>