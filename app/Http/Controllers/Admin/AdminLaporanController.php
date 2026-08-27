<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
    // Helper privat untuk menyatukan logika filter data laporan
    private function getLaporanData(Request $request)
    {
        $tipe = $request->get('tipe', 'bulanan');
        $bulanInput = $request->get('bulan');
        $tahunInput = $request->get('tahun', date('Y'));

        $daftarBulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
        $query = Pembayaran::query();

        if ($tipe === 'bulanan') {
            if ($bulanInput) {
                $parts = explode('-', $bulanInput);
                $namaBulan = $parts[0];
                $tahun = $parts[1] ?? date('Y');
            } else {
                $namaBulan = $daftarBulan[date('n') - 1];
                $tahun = date('Y');
            }

            $angkaBulan = array_search(strtolower($namaBulan), $daftarBulan) + 1;
            $query->whereMonth('tanggal_bayar', $angkaBulan)->whereYear('tanggal_bayar', $tahun);
            $periodeAktif = ucfirst($namaBulan) . ' ' . $tahun;
        } else {
            $query->whereYear('tanggal_bayar', $tahunInput);
            $periodeAktif = 'Tahun ' . $tahunInput;
        }

        // Urutkan query dasar
        $baseQuery = $query->orderBy('tanggal_bayar', 'desc')->orderBy('created_at', 'desc');

        // Ambil SEMUA data transaksi untuk perhitungan total & ringkasan keuangan
        $allTransaksi = (clone $baseQuery)->get();

        // Ambil data transaksi khusus untuk list tampilan yang dibatasi per halaman (misal: 5 data per halaman)
        $transaksiPaginated = $baseQuery->paginate(4)->withQueryString();

        return [
            'allTransaksi' => $allTransaksi,
            'transaksi' => $transaksiPaginated,
            'periodeAktif' => $periodeAktif,
            'tipe' => $tipe
        ];
    }

    public function index(Request $request)
    {
        $dataLaporan = $this->getLaporanData($request);
        $transaksi = $dataLaporan['transaksi']; // Ini data yang sudah di-paginate
        $allTransaksi = $dataLaporan['allTransaksi']; // Ini semua data untuk sum nominal
        $periodeAktif = $dataLaporan['periodeAktif'];
        $tipe = $dataLaporan['tipe'];

        // Menggunakan $allTransaksi agar kalkulasi total mencakup semua data, bukan hanya data halaman aktif
        $totalPendapatanRaw = $allTransaksi->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaranRaw = $allTransaksi->where('jenis', 'pengeluaran')->sum('nominal');
        $selisihBersihRaw = $totalPendapatanRaw - $totalPengeluaranRaw;

        $transaksiMasukCount = $allTransaksi->where('jenis', 'pemasukan')->count();
        $maintenanceCount = $allTransaksi->where('jenis', 'pengeluaran')->count();

        $totalPendapatan = 'Rp ' . number_format($totalPendapatanRaw, 0, ',', '.');
        $totalPengeluaran = 'Rp ' . number_format($totalPengeluaranRaw, 0, ',', '.');
        $selisihBersih = ($selisihBersihRaw < 0 ? '- Rp ' : 'Rp ') . number_format(abs($selisihBersihRaw), 0, ',', '.');

        $targetPendapatan = 1;
        $progressPemasukan = $targetPendapatan > 0 ? min(round(($totalPendapatanRaw / $targetPendapatan) * 100), 100) : 0;

        $budgetPengeluaran = 1;
        $progressPengeluaran = $budgetPengeluaran > 0 ? min(round(($totalPengeluaranRaw / $budgetPengeluaran) * 100), 100) : 0;

        return view('admin.laporan', compact(
            'transaksi',
            'totalPendapatan',
            'totalPengeluaran',
            'selisihBersih',
            'periodeAktif',
            'progressPemasukan',
            'progressPengeluaran',
            'transaksiMasukCount',
            'maintenanceCount'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Pembayaran::create([
            'jenis' => $request->jenis,
            'tanggal_bayar' => $request->tanggal,
            'nama' => $request->nama,
            'nominal' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'status' => 'disetujui',
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
    }

    // METHOD BARU: EXPORT PDF
    public function exportPdf(Request $request)
    {
        $dataLaporan = $this->getLaporanData($request);
        $transaksi = $dataLaporan['transaksi'];
        $periodeAktif = $dataLaporan['periodeAktif'];

        $totalPendapatan = $transaksi->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('nominal');
        $selisihBersih = $totalPendapatan - $totalPengeluaran;

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('transaksi', 'periodeAktif', 'totalPendapatan', 'totalPengeluaran', 'selisihBersih'));

        return $pdf->download('Laporan_Keuangan_' . str_replace(' ', '_', $periodeAktif) . '.pdf');
    }

    // METHOD BARU: EXPORT EXCEL
    // public function exportExcel(Request $request)
    // {
    //     $dataLaporan = $this->getLaporanData($request);
    //     $transaksi = $dataLaporan['transaksi'];
    //     $periodeAktif = $dataLaporan['periodeAktif'];

    //     return Excel::download(new LaporanExport($transaksi), 'Laporan_Keuangan_' . str_replace(' ', '_', $periodeAktif) . '.xlsx');
    // }
}
