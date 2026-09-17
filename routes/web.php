<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LapanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminLapanganController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminHargaController;
use App\Http\Controllers\AdminAddOnController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminAutoCancelController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;


// ============================================================
// HALAMAN UTAMA
// ============================================================

Route::get('/', function () {

    $lapangans = \App\Models\Lapangan::where('status', 'aktif')
        ->orderBy('nama')
        ->get();

    return view('welcome', compact('lapangans'));

});


// ============================================================
// LAPANGAN
// ============================================================

Route::get(
    '/lapangan',
    [LapanganController::class, 'index']
)->name('lapangan.index');

Route::get(
    '/lapangan/{slug}',
    [LapanganController::class, 'show']
)->name('lapangan.show');


// ============================================================
// JADWAL
// ============================================================

Route::get(
    '/jadwal',
    [JadwalController::class, 'index']
)->name('jadwal.index');


// ============================================================
// DASHBOARD USER
// ============================================================

Route::get('/dashboard', function () {

    $user = auth()->user();

    $reservasis = $user->reservasis()
        ->with([
            'lapangan',
            'jadwal'
        ])
        ->latest()
        ->take(5)
        ->get();

    $stats = [

        'total' => $user->reservasis()
            ->count(),

        'menunggu_verifikasi' => $user->reservasis()
            ->where('status', 'menunggu_verifikasi')
            ->count(),

        'dikonfirmasi' => $user->reservasis()
            ->where('status', 'dikonfirmasi')
            ->count(),

        'selesai' => $user->reservasis()
            ->where('status', 'selesai')
            ->count(),

    ];

    return view(
        'dashboard',
        compact(
            'reservasis',
            'stats'
        )
    );

})->middleware([
    'auth',
    'verified'
])->name('dashboard');


// ============================================================
// RESERVASI, PEMBAYARAN & PROFILE USER
// ============================================================

Route::middleware('auth')->group(function () {


    // ========================================================
    // PILIH JADWAL
    // ========================================================

    Route::get(
        '/reservasi/{lapangan:slug}/jadwal',
        [ReservasiController::class, 'pilihJadwal']
    )->name('reservasi.pilihJadwal');


    // ========================================================
    // MEMBUAT RESERVASI
    // ========================================================

    Route::post(
        '/reservasi',
        [ReservasiController::class, 'store']
    )->name('reservasi.store');


    // ========================================================
    // DETAIL RESERVASI
    // ========================================================

    Route::get(
        '/reservasi/{reservasi}',
        [ReservasiController::class, 'detail']
    )->name('reservasi.detail');


    // ========================================================
    // RESERVASI SAYA
    // ========================================================

    Route::get(
        '/reservasi-saya',
        [ReservasiController::class, 'saya']
    )->name('reservasi.index');


    // ========================================================
    // RIWAYAT RESERVASI
    // ========================================================

    Route::get(
        '/riwayat-reservasi',
        [ReservasiController::class, 'riwayat']
    )->name('reservasi.riwayat');


    // ========================================================
    // PEMBAYARAN
    // ========================================================

    Route::get(
        '/reservasi/{reservasi}/pembayaran',
        [PembayaranController::class, 'create']
    )->name('pembayaran.create');

    Route::post(
        '/reservasi/{reservasi}/pembayaran',
        [PembayaranController::class, 'store']
    )->name('pembayaran.store');

    Route::post(
        '/reservasi/{reservasi}/pembayaran/bukti',
        [PembayaranController::class, 'uploadBukti']
    )->name('pembayaran.uploadBukti');


    // ========================================================
    // PROFILE
    // ========================================================

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


// ============================================================
// ADMIN
// ============================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        // ====================================================
        // DASHBOARD ADMIN
        // URL  : /admin
        // NAME : admin.dashboard
        // ====================================================

        Route::get(
            '/',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');


        // ====================================================
        // VALIDASI PEMBAYARAN
        // ====================================================

        Route::get(
            '/pembayaran',
            [AdminPembayaranController::class, 'index']
        )->name('pembayaran.index');

        Route::get(
            '/pembayaran/{pembayaran}',
            [AdminPembayaranController::class, 'show']
        )->name('pembayaran.show');

        // KONFIRMASI / VERIFIKASI PEMBAYARAN
        Route::post(
            '/pembayaran/{pembayaran}/terima',
            [AdminPembayaranController::class, 'terima']
        )->name('pembayaran.terima');

        // TOLAK PEMBAYARAN
        Route::post(
            '/pembayaran/{pembayaran}/tolak',
            [AdminPembayaranController::class, 'tolak']
        )->name('pembayaran.tolak');


        // ====================================================
        // KELOLA LAPANGAN
        // ====================================================

        Route::resource(
            'lapangan',
            AdminLapanganController::class
        );


        // ====================================================
        // KELOLA HARGA
        // ====================================================

        Route::get(
            'harga',
            [AdminHargaController::class, 'index']
        )->name('harga.index');

        Route::get(
            'harga/{lapangan}/edit',
            [AdminHargaController::class, 'edit']
        )->name('harga.edit');

        Route::put(
            'harga/{lapangan}',
            [AdminHargaController::class, 'update']
        )->name('harga.update');


        // ====================================================
        // KELOLA JADWAL
        // ====================================================

        Route::resource(
            'jadwal',
            AdminJadwalController::class
        );


        // ====================================================
        // KELOLA ADD-ON
        // ====================================================

        Route::resource(
            'addon',
            AdminAddOnController::class
        );


        // ====================================================
        // KELOLA RESERVASI
        // ====================================================

        Route::get(
            '/reservasi',
            [AdminReservasiController::class, 'index']
        )->name('reservasi.index');

        Route::put(
            '/reservasi/{reservasi}/status',
            [AdminReservasiController::class, 'updateStatus']
        )->name('reservasi.updateStatus');


        // ====================================================
        // LAPORAN RESERVASI
        // ====================================================

        Route::get(
            '/laporan',
            [AdminLaporanController::class, 'index']
        )->name('laporan.index');

        Route::get(
            '/laporan/pdf',
            [AdminLaporanController::class, 'pdf']
        )->name('laporan.pdf');


        // ====================================================
        // MONITOR AUTO-CANCEL
        // ====================================================

        Route::get(
            '/auto-cancel',
            [AdminAutoCancelController::class, 'index']
        )->name('auto-cancel.index');

    });


// ============================================================
// AUTHENTICATION
// ============================================================

require __DIR__.'/auth.php';