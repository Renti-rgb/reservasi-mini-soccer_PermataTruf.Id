<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    /**
     * Menampilkan halaman pembayaran.
     */
    public function create(Reservasi $reservasi)
    {
        // Pastikan reservasi milik user yang sedang login
        if ($reservasi->user_id !== Auth::id()) {
            abort(403);
        }

        // Ambil data yang dibutuhkan
        $reservasi->load([
            'lapangan',
            'jadwal',
            'pembayaran',
        ]);

        // Ambil data pembayaran jika sudah ada
        $pembayaran = $reservasi->pembayaran;

        return view('pembayaran.create', compact(
            'reservasi',
            'pembayaran'
        ));
    }


    /**
     * Menyimpan data pembayaran.
     */
    public function store(Request $request, Reservasi $reservasi)
    {
        // Pastikan reservasi milik user yang sedang login
        if ($reservasi->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan reservasi memang menunggu pembayaran
        if ($reservasi->status !== 'menunggu_pembayaran') {
            return back()->with(
                'error',
                'Reservasi ini tidak dapat melakukan pembayaran.'
            );
        }

        // Validasi metode pembayaran
        $request->validate([
            'metode' => [
                'required',
                'in:transfer_bank,qris',
            ],
        ]);

        // Jika pembayaran sudah ada,
        // jangan membuat pembayaran kedua
        if ($reservasi->pembayaran) {
            return redirect()
                ->route('pembayaran.create', $reservasi->id)
                ->with(
                    'error',
                    'Pembayaran untuk reservasi ini sudah dibuat.'
                );
        }

        // Buat kode pembayaran unik
        do {
            $kodePembayaran = 'PAY-' . strtoupper(Str::random(8));
        } while (
            Pembayaran::where(
                'kode_pembayaran',
                $kodePembayaran
            )->exists()
        );

        // Buat data pembayaran
        Pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'kode_pembayaran' => $kodePembayaran,
            'jumlah' => $reservasi->total_harga,
            'metode' => $request->metode,
            'status' => 'menunggu',
        ]);

        // Kembali ke halaman pembayaran
                // Kembali ke halaman pembayaran
        return redirect()
            ->route('pembayaran.create', $reservasi->id)
            ->with(
                'success',
                'Metode pembayaran berhasil dipilih. Silakan lanjutkan pembayaran.'
            );
    }

    /**
     * Menyimpan bukti pembayaran yang diunggah user.
     */
    public function uploadBukti(Request $request, Reservasi $reservasi)
    {
        // Pastikan reservasi milik user yang sedang login
        if ($reservasi->user_id !== Auth::id()) {
            abort(403);
        }

        $pembayaran = $reservasi->pembayaran;

        // Pastikan pembayaran (metode) sudah dipilih sebelumnya
        if (!$pembayaran) {
            return redirect()
                ->route('pembayaran.create', $reservasi->id)
                ->with(
                    'error',
                    'Silakan pilih metode pembayaran terlebih dahulu.'
                );
        }

        // Jika sudah diverifikasi, tidak boleh upload ulang
        if ($pembayaran->status === 'diverifikasi') {
            return redirect()
                ->route('pembayaran.create', $reservasi->id)
                ->with(
                    'error',
                    'Pembayaran ini sudah diverifikasi dan tidak dapat diubah.'
                );
        }

        // Validasi file bukti pembayaran
        $request->validate([
            'bukti_pembayaran' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);

        // Hapus file lama jika ada (kasus upload ulang setelah ditolak)
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete(
                $pembayaran->bukti_pembayaran
            );
        }

        // Simpan file baru
        $path = $request->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        // Update data pembayaran
        $pembayaran->update([
            'bukti_pembayaran' => $path,
            'status' => 'menunggu',
            'catatan' => null,
        ]);

        // Update status reservasi jadi menunggu verifikasi
        $reservasi->update([
            'status' => 'menunggu_verifikasi',
        ]);

        return redirect()
            ->route('pembayaran.create', $reservasi->id)
            ->with(
                'success',
                'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.'
            );
    }
}