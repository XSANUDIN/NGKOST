@extends('layouts.guest')

@section('content')
<div class="min-h-screen pt-32 pb-12 px-4 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-600 mb-4 animate-pulse">Butuh Bantuan?</h1>
            <p class="text-gray-600">Tim kami siap membantu 24/7</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300">
                <div class="bg-blue-100 w-fit p-4 rounded-full mx-auto mb-6">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Telepon</h3>
                <p class="text-gray-600 mb-4">+62 812 3456 7890</p>
                <a href="tel:+6281234567890" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">
                    Hubungi Sekarang
                </a>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300">
                <div class="bg-green-100 w-fit p-4 rounded-full mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
                <p class="text-gray-600 mb-4">Fast Response via WhatsApp</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-block bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition">
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
@endsection