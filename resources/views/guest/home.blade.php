@extends('layouts.layouts')
@section('home')
<div
  class="min-h-screen bg-cover bg-center bg-no-repeat"
  style="background-image: url('https://storage.googleapis.com/fastwork-static/9e7ac2a0-5faf-4085-8ce9-528855e8328b.jpg');"
>
  @auth
  <section
    class="pt-32 pb-20 px-6 bg-gradient-to-br from-blue-50 via-cyan-50 to-white dark:from-gray-900 dark:via-gray-950 dark:to-black transition-colors duration-500"
  >
    <div class="max-w-7xl mx-auto">
      <div class="text-gray-900 dark:text-gray-100 mb-12">
        <h1 class="text-5xl font-extrabold tracking-tight mb-3">
          Halo, <span class="text-primary dark:text-cyan-400">{{ Auth::user()->nama }}</span>
        </h1>
        <h2 class="text-2xl font-semibold text-primary dark:text-cyan-400">
          Akses Cepat
        </h2>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <!-- Bayar Tagihan -->
        <a
          href="/transaksi"
          class="group bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-cyan-700 text-white p-8 rounded-3xl shadow-xl flex items-center justify-between transition duration-400 transform hover:scale-[1.03]"
          aria-label="Bayar Tagihan"
        >
          <div>
            <h3 class="text-xl font-semibold mb-1 group-hover:text-blue-100 transition">
              Bayar Tagihan
            </h3>
            <p class="text-sm text-blue-100 group-hover:text-blue-200 transition">
              Lihat tagihan & lakukan pembayaran
            </p>
          </div>
          <span class="text-4xl">
            <svg class="h-8 w-8 text-neutral-500"  viewBox="0 0 24 24"  fill="none"  stroke="white"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="1" y="4" width="22" height="16" rx="2" ry="2" />  <line x1="1" y1="10" x2="23" y2="10" /></svg>
          </span>
        </a>

        <!-- Titip Laundry -->
        <a
          href="/titip"
          class="group bg-secondary hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-400 dark:focus:ring-cyan-600 text-white p-8 rounded-3xl shadow-xl flex items-center justify-between transition duration-400 transform hover:scale-[1.03]"
          aria-label="Titip Laundry"
        >
          <div>
            <h3 class="text-xl font-semibold mb-1 group-hover:text-cyan-100 transition">
              Titip Laundry
            </h3>
            <p class="text-sm text-cyan-100 group-hover:text-cyan-200 transition">
              Titip pakaian & pantau status
            </p>
          </div>
          <span class="text-4xl">
            <svg class="h-8 w-8 text-neutral-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" /></svg>
          </span>
        </a>
      </div>

      <!-- Riwayat Transaksi -->
      <div class="mt-16 bg-white dark:bg-gray-900 p-8 rounded-3xl shadow-lg transition-colors duration-500">
        <h4 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center gap-3">
        <span class="text-3xl">
        <svg class="h-8 w-8 text-gray-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 8 12 12 14 14" />  <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg>
        </span> Riwayat Transaksi Terakhir
        </h4>
        <ul class="divide-y divide-gray-200 dark:divide-gray-700 text-sm">
          @foreach ($transaksi->take(5) as $trx)
          <li class="flex justify-between items-center py-4">
            <div>
              <p class="font-semibold text-gray-900 dark:text-gray-100">
                {{ ucfirst($trx->tipe) }} - Bulan
                {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->translatedFormat('F') }}
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->translatedFormat('d F Y') }}
              </p>
            </div>
            @if ($trx->status === 'lunas')
            <span class="inline-block bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-300 text-xs px-4 py-1 rounded-full font-semibold">
                Lunas
            </span>
            @else
            <span class="inline-block bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-300 text-xs px-4 py-1 rounded-full font-semibold">
                Belum Dibayar
            </span>
            @endif
          </li>
          @endforeach
        </ul>
        <div class="text-right mt-4">
          <a
            href="{{ route('user.transaksi') }}"
            class="text-primary dark:text-cyan-400 hover:underline font-medium"
          >
            Lihat semua transaksi →
          </a>
        </div>
      </div>
    </div>
  </section>
  @endauth

  @guest
  <!-- Guest Section: Kamar Kosong -->
  <section
    class="py-24 bg-gray-100 dark:bg-gray-900 transition-colors duration-500"
  >
    <div class="max-w-7xl mx-auto px-6">
      <h2
        class="text-4xl font-extrabold text-center mb-14 text-gray-900 dark:text-gray-100"
      >
        Kamar Kosong
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        @for ($i = 1; $i <= 3; $i++)
        <div
          class="bg-white dark:bg-gray-100 rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transform transition duration-300"
        >
          <img
            src="https://assets.buildout.com/assets/plugins/photo_placeholder-623024d78d77741a2e8b3318edee992ccd44bf2abfffe503a77470578eff2a60.png"
            alt="Kamar Tipe {{ $i }}"
            class="w-full h-56 object-cover"
          />
          <div class="p-6 space-y-4">
            <h3
              class="text-2xl font-bold text-gray-900 dark:text-gray-900"
            >
              Kamar Tipe {{ $i }}
            </h3>
            <ul
              class="list-disc pl-6 text-gray-600 dark:text-gray-400 text-base space-y-1"
            >
              <li>AC</li>
              <li>Kamar Mandi Dalam</li>
              <li>Wi-Fi 100Mbps</li>
            </ul>
            <div class="flex justify-between items-center pt-5">
              <span
                class="text-3xl font-extrabold text-primary dark:text-cyan-400"
              >
                Rp {{ number_format(1200000 + ($i * 200000), 0, ',', '.') }}
              </span>
              <button
                class="bg-primary hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                aria-label="Detail Kamar Tipe {{ $i }}"
              >
                Detail
              </button>
            </div>
          </div>
        </div>
        @endfor
      </div>
    </div>
  </section>
  @endguest

  <!-- Pemberitahuan Section -->
  <section class="py-20 bg-muted dark:bg-gray-900 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-6">
      <div
        class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-10 space-y-6"
      >
        <h2
          class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-6"
        >
          Pemberitahuan
        </h2>
        <ul class="list-disc pl-8 space-y-4 text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
          <li>
            🧹 Pembersihan rutin area umum: <strong>Kamis, 20 Juni 2025 pukul 08.00 WIB</strong>.
          </li>
          <li>
            ⚠️ Batas akhir pembayaran kost: <strong>25 Juni 2025</strong>.
          </li>
          <li>
            🔌 Pemeliharaan listrik: <strong>Sabtu, 22 Juni 2025 pukul 10.00–13.00 WIB</strong>.
          </li>
          <li>
            🎉 Acara kumpul bareng: <strong>Minggu, 23 Juni 2025 pukul 19.00 WIB</strong>.
          </li>
        </ul>
      </div>
    </div>
  </section>
</div>
@endsection
