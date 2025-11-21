<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kehadiran;
use App\Models\CatatanGuru;
use App\Models\JadwalSesi;
use Carbon\Carbon;

class DashboardOrangTuaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Orang Tua yang sedang login
        $user = $request->user();

        // 2. Jika tidak ada user login (untuk testing), ambil user pertama dengan role Orang Tua
        if (!$user) {
            $user = \App\Models\User::whereHas('role', function ($q) {
                $q->where('nama_role', 'Orang Tua');
            })->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User Orang Tua tidak ditemukan di database'
                ], 404);
            }
        }

        // 3. Cari siswa berdasarkan orang tua tersebut
        $siswa = Siswa::where('orang_tua_id', $user->id)->first();

        if (!$siswa) {
            return response()->json([
                'message' => 'Data anak tidak ditemukan untuk orang tua ini'
            ], 404);
        }

        // --- DATA RINGKASAN (CARD ATAS) ---

        // Hitung Kehadiran Bulan Ini
        $totalSesiBulanIni = Kehadiran::where('siswa_id', $siswa->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $hadirBulanIni = Kehadiran::where('siswa_id', $siswa->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'Hadir')
            ->count();

        // Hitung Catatan Baru (Bulan Ini)
        $catatanBaru = CatatanGuru::where('siswa_id', $siswa->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Cari Jadwal Berikutnya
        $jadwalBerikutnya = JadwalSesi::where('waktu_mulai', '>=', Carbon::now())
            ->orderBy('waktu_mulai', 'asc')
            ->first();

        // --- DATA LIST (BAWAH & SIDEBAR) ---

        // Ambil 5 Catatan Terbaru
        $catatanTerbaru = CatatanGuru::with('guru')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'pelajaran' => $item->topik ?? 'Topik Pembelajaran',
                    'tanggal' => Carbon::parse($item->created_at)->translatedFormat('l, d M Y'),
                    'guru' => $item->guru ? $item->guru->nama : 'Guru',
                    'isi' => $item->catatan
                ];
            });

        // Ambil 3 Jadwal Mendatang untuk Sidebar
        $jadwalMendatang = JadwalSesi::with('guru')
            ->where('waktu_mulai', '>=', Carbon::now())
            ->orderBy('waktu_mulai', 'asc')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'pelajaran' => $item->topik ?? 'Pelajaran',
                    'tanggal' => Carbon::parse($item->waktu_mulai)->translatedFormat('l, d M Y'),
                    'waktu' => Carbon::parse($item->waktu_mulai)->format('H:i') .
                        (isset($item->waktu_selesai) ? ' - ' . Carbon::parse($item->waktu_selesai)->format('H:i') : ''),
                    'guru' => $item->guru ? $item->guru->nama : 'Pengajar'
                ];
            });

        // ⭐ TAMBAHAN: Riwayat Kehadiran (yang hilang di controller lama)
        $riwayatKehadiran = Kehadiran::with(['jadwalSesi.guru'])
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'pelajaran' => $item->jadwalSesi ? $item->jadwalSesi->topik : 'Pelajaran',
                    'tanggal' => Carbon::parse($item->created_at)->translatedFormat('l, d M Y'),
                    'waktu' => $item->jadwalSesi
                        ? Carbon::parse($item->jadwalSesi->waktu_mulai)->format('H:i')
                        : '-',
                    'status' => $item->status
                ];
            });

        // Response JSON
        return response()->json([
            'nama_anak' => $siswa->nama_lengkap,
            'ringkasan' => [
                'kehadiran' => "{$hadirBulanIni}/{$totalSesiBulanIni}",
                'persentase_kehadiran' => $totalSesiBulanIni > 0
                    ? round(($hadirBulanIni / $totalSesiBulanIni) * 100)
                    : 0,
                'catatan_baru' => $catatanBaru,
                'jadwal_berikutnya' => $jadwalBerikutnya ? $jadwalBerikutnya->topik : 'Tidak ada',
                'tanggal_jadwal_berikutnya' => $jadwalBerikutnya
                    ? Carbon::parse($jadwalBerikutnya->waktu_mulai)->translatedFormat('l, d M Y')
                    : '-'
            ],
            'catatan_terbaru' => $catatanTerbaru,
            'jadwal_mendatang' => $jadwalMendatang,
            'riwayat_kehadiran' => $riwayatKehadiran // ⭐ DITAMBAHKAN
        ]);
    }
    public function getAllCatatan(Request $request)
    {
        // 1. Ambil User & Siswa (Logic sama seperti index)
        $user = $request->user();

        // Fallback untuk testing jika user null
        if (!$user) {
            $user = \App\Models\User::whereHas('role', fn($q) => $q->where('nama_role', 'Orang Tua'))->first();
        }

        $siswa = \App\Models\Siswa::where('orang_tua_id', $user->id)->first();

        if (!$siswa) {
            return response()->json([], 404);
        }

        // 2. Ambil SEMUA catatan, urutkan dari yang terbaru
        $catatan = \App\Models\CatatanGuru::with('guru')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    // Gunakan fallback jika kolom topik tidak ada/null
                    'topik' => $item->topik ?? 'Catatan Perkembangan',
                    'tanggal' => \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d M Y'),
                    'guru' => $item->guru ? $item->guru->nama : 'Guru',
                    'isi' => $item->catatan
                ];
            });

        return response()->json($catatan);
    }

    public function getAllJadwal(Request $request)
    {
        try {
            // 1. Ambil User & Siswa
            $user = $request->user();
            if (!$user) {
                $user = \App\Models\User::whereHas('role', fn($q) => $q->where('nama_role', 'Orang Tua'))->first();
            }
            
            if (!$user) throw new \Exception("User Orang Tua tidak ditemukan");

            $siswa = \App\Models\Siswa::where('orang_tua_id', $user->id)->first();
            if (!$siswa) throw new \Exception("Data Siswa tidak ditemukan untuk user ini");

            // 2. Query Data dengan Error Handling per Baris
            $jadwal = \App\Models\JadwalSesi::with(['guru', 'materi']) 
                ->orderBy('waktu_mulai', 'desc')
                ->get()
                ->map(function ($item) use ($siswa) {
                    
                    // DEBUG: Cek Tanggal
                    try {
                        $start = $item->waktu_mulai ? \Carbon\Carbon::parse($item->waktu_mulai) : now();
                        $end = $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai) : $start->copy()->addHour();
                    } catch (\Exception $e) {
                        // Jika tanggal error, pakai default
                        $start = now();
                        $end = now();
                    }
                    
                    $isPast = $end->isPast();

                    // DEBUG: Cek Kehadiran
                    $kehadiran = \App\Models\Kehadiran::where('sesi_id', $item->id)
                        ->where('siswa_id', $siswa->id)
                        ->first();

                    // DEBUG: Cek Materi (Pastikan tidak null)
                    // Menggunakan ternary check agar aman jika relasi gagal
                    $materiList = $item->relationLoaded('materi') ? $item->materi : collect([]);

                    return [
                        'id' => $item->id,
                        'tanggal' => $start->translatedFormat('d F Y'),
                        'hari' => $start->translatedFormat('l'),
                        'pelajaran' => $item->topik ?? 'Pelajaran Umum',
                        'status' => $isPast ? 'Selesai' : 'Akan Datang',
                        'waktu' => $start->format('H:i') . ' - ' . $end->format('H:i'),
                        'details' => [
                            'guru' => $item->guru ? $item->guru->nama : 'Guru',
                            'topik' => $item->topik,
                            'lokasi' => $item->lokasi ?? 'Kelas Utama',
                            'kehadiran' => $kehadiran ? $kehadiran->status : ($isPast ? 'Alpha' : '-'),
                            'catatan' => $kehadiran ? $kehadiran->catatan : '-', 
                            'deskripsi' => $item->deskripsi ?? 'Tidak ada deskripsi.',
                            'materi' => $materiList->map(function($m) {
                                return [
                                    'nama' => $m->judul ?? 'Materi',
                                    'tipe' => 'Dokumen',
                                    'ukuran' => '-',
                                    'url' => $m->file_path ?? '#' // Pastikan kolom file_path sesuai DB
                                ];
                            })
                        ]
                    ];
                });

            return response()->json($jadwal);

        } catch (\Throwable $e) {
            // INI AKAN MENAMPILKAN PENYEBAB ERROR YANG SEBENARNYA
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString() // Opsional, untuk detail lengkap
            ], 500); 
        }
    }   
}
