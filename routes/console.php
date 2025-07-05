<?php

use Illuminate\Support\Facades\Schedule;
use App\Models\Notifikasi;
use App\Models\User;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $notifs = Notifikasi::all();
    $wa = new WhatsappService();

    foreach ($notifs as $notif) {
        $intervalDays = match ($notif->frekuensi) {
            'mingguan' => 7,
            'bulanan' => 30,
            default => 0,
        };

        if ($intervalDays === 0) continue;

        $nextReminderDate = Carbon::parse($notif->jadwal)->addDays($intervalDays);

        if (Carbon::today()->greaterThanOrEqualTo($nextReminderDate)) {
            $user = User::find($notif->user_id);

            // Hanya kirim ke user yang merupakan admin
            if ($user && $user->no_hp && $user->role === 'pengelola') {
                $message = "*Reminder*\n\nNote:{$notif->catatan}\n\nData kost belum diperbarui.";
                $wa->sendMessage($user->no_hp, $message);

                Log::info("Pesan WA berhasil dikirim ke pengelola ({$user->no_hp}) | Catatan: {$notif->catatan}");
            } else {
                Log::warning("Gagal mengirim pesan: user bukan pengelola, tidak memiliki nomor HP, atau data user_id {$notif->user_id} tidak ditemukan.");
            }


            // update jadwal baru
            // $notif->jadwal = Carbon::today()->toDateString();
            $notif->save();
        }
    }
})->everyMinute();
