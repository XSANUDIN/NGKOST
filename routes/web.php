<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Route::get('/',[UserController::class, 'home'])->name('guest.home');
Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ----------------------------
// Rute untuk Pengelola (Admin)
// ----------------------------
Route::middleware(['auth', 'role:pengelola'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/', [UserController::class, 'admin'])->name('admin.home');
    Route::get('/home', [UserController::class, 'admin']);

    // Laporan
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('admin.laporan');

    // Notifikasi
    Route::prefix('notifikasi')->group(function () {
        Route::get('/', [NotifikasiController::class, 'index'])->name('admin.notifikasi');
        Route::get('/edit', [NotifikasiController::class, 'edit'])->name('notifikasi.edit');
        Route::post('/', [NotifikasiController::class, 'update'])->name('notifikasi.update');
    });

    // Status Laundry
    Route::prefix('status')->group(function () {
        Route::get('/', [LaundryController::class, 'updateStatus'])->name('admin.status');
        Route::put('/update/{id}', [LaundryController::class, 'edit'])->name('status.edit');
        Route::get('/delete/{id}', [LaundryController::class, 'destroy'])->name('status.destroy');
    });
});


// -------------------------
// Rute untuk Penghuni (User)
// -------------------------
Route::middleware(['auth', 'role:penghuni'])->group(function () {

    // Laundry (Titip)
    Route::prefix('titip')->group(function () {
        Route::get('/', [LaundryController::class, 'index'])->name('laundry.dashboard');
        Route::post('/', [LaundryController::class, 'store'])->name('laundry.store');
    });

    // Status Laundry Pengguna
    Route::get('/status', [LaundryController::class, 'showStatus'])->name('laundry.status');

    // Transaksi Pengguna
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('user.transaksi');
        Route::post('/{id}/bayar', [TransaksiController::class, 'bayar'])->name('user.bayar');
    });
});


// Route::get('/admin',[UserController::class, 'admin'])->name('admin.home');
// Route::get('/admin/home',[UserController::class, 'admin'])->name('admin.home');

// Route::get('/admin/laporan',[TransaksiController::class, 'laporan'])->name('admin.laporan');
// Route::get('/admin/notifikasi',[NotifikasiController::class, 'index'])->name('admin.notifikasi');
// Route::get('/admin/notifikasi',[NotifikasiController::class, 'edit'])->name('notifikasi.edit');
// Route::post('/admin/notifikasi',[NotifikasiController::class, 'update'])->name('notifikasi.update');

// Route::get('/admin/status',[LaundryController::class, 'updateStatus'])->name('admin.status');

// Route::put('/admin/status/update/{id}',[LaundryController::class, 'edit'])->name('status.edit');
// Route::get('/admin/status/delete/{id}',[LaundryController::class, 'destroy'])->name('status.destroy');


// Route::get('/titip',[LaundryController::class, 'index'])->name('laundry.dashboard');
// Route::post('/titip',[LaundryController::class, 'store'])->name('laundry.store');
// Route::get('/status',[LaundryController::class, 'showStatus'])->name('laundry.status');


// Route::get('/transaksi',[TransaksiController::class, 'index'])->name('user.transaksi');
// Route::post('/transaksi/{id}/bayar',[TransaksiController::class, 'bayar'])->name('user.bayar');
















Route::post('/transaksi', function (Request $request) {
    if ($request->isMethod('post')) {
        $accessToken = 'EAAKkdiJESPcBOxBuBAZC79ZC2AZB4uQ0bWBOhUGcZBfdDHwFDkwHS72ZAQBlq2KZAU1vsiVQsiElfjrP1nV8dgWA69zp3uM4lCaigN7PomhHxCnIWdZBK4TtZAv0wuKi0JdFWVjvPKFqMjQe9GoJPCTD5ZCpkob1ubWoxq4msx1oCR1tTZA02pH8xDS7R4m1LZBH7vm7MEKHFav0el1TvHrno8JFE9lz7j3e4AZD';      // ganti dengan token akses dari Meta Developer

        $user = "Ini gwa";
        $message = "Pembayaran berhasil";
        $url = "https://graph.facebook.com/v22.0/665255710004083/messages";

        $response = Http::withToken($accessToken)
            ->post($url, [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => '6281932695520',
                'type' => 'text',
                'text' => [
                    'preview_url' => false,
                    'body' => $message
                ],
        ]);

        if ($response->successful()) {
            return redirect('/transaksi')->with('status', 'Pesan WhatsApp terkirim!');
        } else {
            return redirect('/transaksi')->with('error', 'Gagal mengirim pesan: ' . $response->body());
        }
    }

    
    return view('user.transaksi');
    
})->name('transaksi');


Route::match(['get', 'post'], '/test', function(Request $request) {

    if ($request->isMethod('post')) {
        $accessToken = '';      

        $user = "Test";
        $message = "*Perbarui data kost";
        $url = "https://graph.facebook.com/v22.0/{id}/messages";

        $response = Http::withToken($accessToken)
            ->post($url, [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => '{target}',
                'type' => 'text',
                'text' => [
                    'preview_url' => false,
                    'body' => $message
                ],
        ]);

        if ($response->successful()) {
            return redirect('/test')->with('status', 'Pesan WhatsApp terkirim!');
        } else {
            return redirect('/test')->with('error', 'Gagal mengirim pesan: ' . $response->body());
        }
    }

    return view('laundry.test');
});
