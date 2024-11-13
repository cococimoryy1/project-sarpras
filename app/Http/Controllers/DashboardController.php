<?php

namespace App\Http\Controllers;

use App\Models\TransaksiHarian;
use App\Models\Emiten;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // pastikan ada file dashboard.blade.php di resources/views
    }

    public function dashboard()
    {
        $sb_menu = 'dashboard'; // Inisialisasi $sb_menu
        $sb_submenu = 'dashboard'; // Inisialisasi $sb_menu
        return view('dashboard', compact('sb_menu','sb_submenu'));
    }

    public function profile()
    {
        $sb_menu = 'profile'; // Inisialisasi $sb_menu
        return view('dashboard', compact('sb_menu'));
    }
    public function chart()
{
    $sb_menu = 'dashboard'; // Inisialisasi $sb_menu
    $sb_submenu = 'dashboard'; // Inisialisasi $sb_submenu

    // Ambil data transaksi harian dengan agregasi per bulan dan STOCK_CODE
    $data = TransaksiHarian::selectRaw('DATE_FORMAT(DATE_TRANSACTION, "%Y-%m") as bulan, STOCK_CODE, SUM(VOLUME) as total_volume, SUM(VALUE) as total_value, SUM(FREQUENCY) as frequency')
    ->groupBy('bulan', 'STOCK_CODE') // Mengelompokkan berdasarkan bulan dan STOCK_CODE
    ->orderBy('bulan') // Mengurutkan berdasarkan bulan
    ->paginate(5); // Menggunakan paginate untuk mendapatkan data per halaman

    $chartData = TransaksiHarian::selectRaw('STOCK_CODE, SUM(VALUE) as total_value')
    ->groupBy('STOCK_CODE') // Mengelompokkan berdasarkan STOCK_CODE
    ->orderBy('STOCK_CODE') // Mengurutkan berdasarkan STOCK_CODE
    ->get();

     // Persiapkan data untuk chart
     $stockCodes = $chartData->pluck('STOCK_CODE')->toArray();
     $totalValues = $chartData->pluck('total_value')->toArray();

    // Menghitung frekuensi bulanan
    $frequencies = TransaksiHarian::selectRaw('DATE_FORMAT(DATE_TRANSACTION, "%Y-%m") as bulan, SUM(FREQUENCY) as total_frequency')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

     $hargaCloseData = TransaksiHarian::selectRaw('DATE_FORMAT(DATE_TRANSACTION, "%Y-%m") as bulan, AVG(close) as average_close') // Ganti `harga_close` dengan nama kolom yang sesuai
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        // Dapatkan label dan data harga close
    $closePrices = $hargaCloseData->pluck('average_close')->toArray();
    $bulanLabels = $hargaCloseData->pluck('bulan')->toArray();

    // Menghitung informasi yang dibutuhkan untuk tampilan
    $emitenCount = Emiten::count();
    $transaksiVolume = TransaksiHarian::sum('VOLUME');
    $transaksiValue = TransaksiHarian::sum('VALUE');
    $transaksiFrequency = TransaksiHarian::count(); // Hitung total frekuensi transaksi

    // Format angka sebelum dikirim ke view
    $emitenCount = $this->formatCurrency($emitenCount);
    $transaksiVolume = $this->formatCurrency($transaksiVolume);
    $transaksiValue = $this->formatCurrency($transaksiValue);
    $transaksiFrequency = $this->formatCurrency($transaksiFrequency);

     // Dapatkan daftar bulan yang tersedia
     $availableMonths = TransaksiHarian::selectRaw('DATE_FORMAT(DATE_TRANSACTION, "%Y-%m") as bulan')
     ->distinct()
     ->orderBy('bulan')
     ->pluck('bulan')
     ->toArray();

    return view('dashboard2', compact('sb_menu', 'sb_submenu', 'data', 'emitenCount', 'transaksiVolume', 'transaksiValue', 'transaksiFrequency', 'frequencies',  'closePrices', 'bulanLabels', 'availableMonths'));
}
    function formatCurrency($number) {
        if ($number >= 1000000000000) { // Triliun
            return number_format($number / 1000000000000, 1) . ' T';
        } elseif ($number >= 1000000000) { // Miliar
            return number_format($number / 1000000000, 1) . ' B';
        } elseif ($number >= 1000000) { // Juta
            return number_format($number / 1000000, 1) . ' J';
        } elseif ($number >= 1000) { // Ribu
            return number_format($number / 1000, 0) . ' R';
        } else {
            return number_format($number, 0); // Tanpa format
        }
    }
    // public function transaksi()
    // {
    //     // Ambil data transaksi harian dengan agregasi
    //     $data = TransaksiHarian::selectRaw('STOCK_CODE, DATE_FORMAT(DATE_TRANSACTION, "%Y-%m") as bulan, SUM(VOLUME) as total_volume, SUM(VALUE) as total_value, COUNT(*) as frequency')
    //         ->groupBy('STOCK_CODE', 'bulan')
    //         ->get();

    //     return view('dashboard2', compact('data'));
    // }
}
