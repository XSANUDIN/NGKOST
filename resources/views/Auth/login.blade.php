@extends('layouts.layouts')

@section('title', 'Login')

@section('section-bg')
    relative bg-gray-900 bg-cover bg-center bg-no-repeat
@endsection

@section('home')
<div class="relative min-h-screen flex justify-center items-center px-4 py-16">

    {{-- Overlay Blur Background --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm z-0"></div>

    {{-- Login Form --}}
    <div class="relative z-10 w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-10 border ">
        <h2 class="text-4xl font-bold text-white text-center mb-8">Masuk ke Akun</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-6" novalidate>
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="example@example.com"
                    aria-describedby="emailHelp"
                    class="w-full px-4 py-3 rounded-lg bg-white/20 text-gray-900 placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white/30 transition duration-200"
                />
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-white text-sm font-medium mb-2">Kata Sandi</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    aria-describedby="passwordHelp"
                    class="w-full px-4 py-3 rounded-lg bg-white/20 text-gray-900 placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white/30 transition duration-200"
                />
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between text-white text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-500 bg-white/20 border-white/40 rounded" />
                    <span class="ml-2">Ingat saya</span>
                </label>
                <a href="#" class="text-blue-300 hover:underline transition">Lupa password?</a>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none text-white rounded-lg font-semibold transition duration-300"
            >
                Masuk
            </button>
        </form>

        {{-- <p class="mt-8 text-center text-white text-sm">
            Belum punya akun?
            <a href="#" class="text-blue-300 hover:underline font-semibold transition">Daftar sekarang</a>
        </p> --}}
    </div>
</div>
@endsection
