<section class="w-full max-w-2xl p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Status Laundry</h2>

  <div class="flex items-center justify-between relative" role="progressbar" aria-valuemin="0" aria-valuemax="100">
    <!-- Background Line -->
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-300 dark:bg-gray-600 z-0 rounded"></div>

    <!-- Foreground Progress Line -->
    <div id="progress-line"
         class="absolute top-1/2 left-0 h-1 bg-blue-500 z-10 transition-all duration-700 ease-in-out rounded"
         style="width: 0%;">
    </div>

    <!-- Step Icons -->
    @php
      $steps = ['masuk', 'dicuci', 'selesai'];
      $icons = ['🧺','🧼','✅'];
      $labels = ['Masuk', 'Dicuci', 'Selesai'];
      $statusIndex = array_search($status, $steps);
    @endphp

    @foreach($steps as $i => $step)
      @php
        $active = $i <= $statusIndex;
      @endphp
      <div class="relative z-20 flex flex-col items-center" aria-label="{{ $labels[$i] }}">
        <div class="w-10 h-10 rounded-full border-4 flex items-center justify-center text-xl
          {{ $active ? 'border-blue-500 text-blue-500 bg-white dark:bg-gray-800' : 'border-gray-300 text-gray-400 bg-white dark:bg-gray-700' }}">
          {{ $icons[$i] }}
        </div>
        <span class="mt-2 text-sm text-center text-gray-700 dark:text-gray-300">{{ $labels[$i] }}</span>
      </div>
    @endforeach
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const progressLine = document.getElementById('progress-line');
    const status = @json($status);
    const stepMap = {
      masuk: '0%',
      dicuci: '50%',
      selesai: '100%'
    };
    if (progressLine && stepMap[status]) {
      progressLine.style.width = stepMap[status];
      progressLine.setAttribute('aria-valuenow', parseInt(stepMap[status]));
    }
  });
</script>
