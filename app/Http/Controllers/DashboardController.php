<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan statistik perpustakaan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Statistik buku
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();

        // Statistik anggota
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', '!=', 'Aktif')->count();

        // Data terbaru
        $bukuTerbaru = Buku::latest()->take(5)->get();
        $anggotaTerbaru = Anggota::latest()->take(5)->get();

        // Transaksi terlambat (status Dipinjam dan sudah melewati tanggal_kembali)
        $transaksiTerlambat = Transaksi::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->whereDate('tanggal_kembali', '<', now())
            ->latest()
            ->get();

        return view('dashboard', compact(
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'bukuTerbaru',
            'anggotaTerbaru',
            'transaksiTerlambat'
        ));
    }
}
