<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // KITA SATUKAN SEMUA DATA PALSU DI SINI
    private $beritaData = [
        [
            'id' => 1,
            'judul' => 'Perpustakaan Mini Kini Dibuka',
            'slug' => 'perpustakaan-mini-kini-dibuka',
            'tanggal_publikasi' => '2025-12-31',
            'gambar_url' => '/dokumentasi.jpg',
            'gambar_header' => ['/dokumentasi.jpg', '/dokumentasi2.jpg'],
            'subtitle' => 'Subtitle untuk Perpustakaan...',
            'konten' => '<p>Konten detail untuk Perpustakaan Mini...</p>'
        ],
        [
            'id' => 2,
            'judul' => 'Workshop Coding untuk Anak',
            'slug' => 'workshop-coding-untuk-anak',
            'tanggal_publikasi' => '2025-12-15', // Sesuai mockup
            'gambar_url' => '/hero.jpg', // Path gambar lokal
            'gambar_header' => ['/hero.jpg', '/dokumentasi2.jpg'],
            'subtitle' => 'Mengenal Dunia Digital Sejak Dini, Anak-Anak Antusias Ikuti Workshop Coding Perdana',
            // INI ADALAH STRING YANG SUDAH DIPERBAIKI (PAKAI TANDA SAMBUNG '.')
            'konten' => '<p><strong>Terminal Pintar</strong> - Di tengah pesatnya perkembangan teknologi, puluhan anak-anak usia sekolah dasar menunjukkan antusiasme luar biasa dalam acara "Workshop Coding untuk Anak" yang diselenggarakan pada hari Sabtu, 14 Desember 2025, di Aula Serbaguna Inovasi Mandiri. Acara ini bertujuan untuk memperkenalkan dasar-dasar logika pemrograman dan computational thinking kepada generasi muda dengan cara yang menyenangkan dan interaktif.</p>' .
                        '<p>Sejak pagi, para peserta yang didampingi orang tua sudah memadati area registrasi. Mereka datang dengan rasa penasaran tinggi untuk belajar bagaimana cara membuat game sederhana, animasi, dan cerita digital interaktif. Workshop ini menggunakan platform pemrograman visual berbasis blok, yang memungkinkan anak-anak menyusun perintah layaknya bermain puzzle tanpa perlu menulis kode yang rumit. "Tujuan utama kami adalah untuk menanamkan pemahaman bahwa mereka tidak hanya bisa menjadi pengguna teknologi, tetapi juga pencipta," ujar Budi Santoso, ketua panitia penyelenggara. "Kami ingin memantik rasa ingin tahu mereka dan menunjukkan bahwa coding itu seru, kreatif, dan bisa menjadi alat untuk mewujudkan imajinasi mereka."</p>' .
                        '<p>Suasana workshop berlangsung meriah dan penuh energi. Dipandu oleh para mentor yang berpengalaman, anak-anak diajak untuk membuat proyek pertama mereka. Tawa dan sorak gembira terdengar setiap kali mereka berhasil membuat karakter di layar bergerak atau mengeluarkan suara sesuai perintah yang mereka susun. Salah satu peserta, Aira (9), berhasil membuat animasi sederhana tentang seekor kucing yang mengejar bola.</p>' .
                        '<p>"Awalnya aku kira susah, ternyata seru banget! Aku jadi bisa bikin kartun sendiri," katanya sambil tersenyum bangga.</p>' .
                        '<p>Acara yang berlangsung selama tiga jam ini tidak hanya memberikan manfaat bagi anak-anak, tetapi juga membuka wawasan bagi para orang tua yang hadir. Mereka melihat langsung bagaimana pendidikan teknologi sejak dini dapat melatih kemampuan memecahkan masalah, kreativitas, dan berpikir logis. Melihat tingginya minat masyarakat, panitia berencana untuk menjadikan workshop ini sebagai program rutin. "Ini adalah langkah awal. Kami berharap dapat menggelar acara serupa dengan materi yang lebih beragam di masa mendatang untuk mempersiapkan talenta-talenta digital Indonesia di masa depan," tutup Budi.</p>'
        ],
        [
            'id' => 3,
            'judul' => 'Kelas Bahasa Interaktif',
            'slug' => 'kelas-bahasa-interaktif',
            'tanggal_publikasi' => '2025-12-12',
            'gambar_url' => '/dokumentasi2.jpg',
            'gambar_header' => ['/dokumentasi2.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Kelas Bahasa...',
            'konten' => '<p>Konten detail untuk Kelas Bahasa...</p>'
        ],
        [
            'id' => 4,
            'judul' => 'Kelas Green Environment',
            'slug' => 'kelas-green-environment',
            'tanggal_publikasi' => '2025-12-08',
            'gambar_url' => '/dokumentasi3.jpg',
            'gambar_header' => ['/dokumentasi3.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Green Environment...',
            'konten' => '<p>Konten detail untuk Green Environment...</p>'
        ],
        [
            'id' => 5,
            'judul' => 'Kelas Mental Health & Education',
            'slug' => 'kelas-mental-health',
            'tanggal_publikasi' => '2025-12-07',
            'gambar_url' => '/dokumentasi4.jpg',
            'gambar_header' => ['/dokumentasi4.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Mental Health...',
            'konten' => '<p>Konten detail untuk Mental Health...</p>'
        ],
        [
            'id' => 6,
            'judul' => 'Kelas Science & Technology',
            'slug' => 'kelas-science-technology',
            'tanggal_publikasi' => '2025-11-20',
            'gambar_url' => '/dokumentasi5.jpg',
            'gambar_header' => ['/dokumentasi5.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Science...',
            'konten' => '<p>Konten detail untuk Science...</p>'
        ],
        [
            'id' => 7,
            'judul' => 'Kelas Public Speaking',
            'slug' => 'kelas-public-speaking',
            'tanggal_publikasi' => '2025-10-25',
            'gambar_url' => '/dokumentasi6.jpg',
            'gambar_header' => ['/dokumentasi6.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Public Speaking...',
            'konten' => '<p>Konten detail untuk Public Speaking...</p>'
        ],
        [
            'id' => 8,
            'judul' => 'Kunjungan ke Kebun Binatang',
            'slug' => 'kunjungan-kebun-binatang',
            'tanggal_publikasi' => '2025-10-10',
            'gambar_url' => '/dokumentasi8.jpg',
            'gambar_header' => ['/dokumentasi8.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Kunjungan...',
            'konten' => '<p>Konten detail untuk Kunjungan...</p>'
        ],
        [
            'id' => 9,
            'judul' => 'Pelatihan Pertanian Organik',
            'slug' => 'pelatihan-pertanian-organik',
            'tanggal_publikasi' => '2025-09-05',
            'gambar_url' => '/dokumentasi9.jpg',
            'gambar_header' => ['/dokumentasi9.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Pertanian...',
            'konten' => '<p>Konten detail untuk Pertanian...</p>'
        ],
        [
            'id' => 10,
            'judul' => 'Lomba Mewarnai Anak-Anak',
            'slug' => 'lomba-mewarnai-anak-anak',
            'tanggal_publikasi' => '2025-08-17',
            'gambar_url' => '/dokumentasi10.jpg',
            'gambar_header' => ['/dokumentasi10.jpg', '/hero.jpg'],
            'subtitle' => 'Subtitle untuk Lomba Mewarnai...',
            'konten' => '<p>Konten detail untuk Lomba Mewarnai...</p>'
        ],
    ];

    /**
     * Sediakan data kegiatan terbaru untuk LandingPage.
     */
    public function getKegiatanTerbaru()
    {
        // Ambil 3 data pertama
        $kegiatanTerbaru = array_slice($this->beritaData, 0, 3);
        
        // Kita hanya butuh data simpel untuk card
        $simpleData = array_map(function($item) {
            return [
                'id' => $item['id'],
                'judul' => $item['judul'],
                'slug' => $item['slug'],
                'tanggal_kegiatan' => $item['tanggal_publikasi'], // ganti nama field
                'deskripsi_singkat' => $this->getExcerpt($item['konten']), // Ambil 10 kata pertama
                'gambar_url' => $item['gambar_url']
            ];
        }, $kegiatanTerbaru);

        return response()->json($simpleData);
    }

    /**
     * Sediakan SEMUA data berita untuk halaman daftar berita.
     */
    public function getAllBerita(Request $request)
    {
        $allBerita = $this->beritaData;
        $perPage = 7;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $items = array_slice($allBerita, $offset, $perPage);
        $total = count($allBerita);

        // Hitung "waktu lalu" untuk setiap item
        foreach ($items as &$item) {
            $item['waktu_lalu'] = $this->getTimeAgo($item['tanggal_publikasi']);
        }

        return response()->json([
            'data' => $items,
            'current_page' => (int)$currentPage,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
        ]);
    }

    /**
     * METHOD BARU: Sediakan data untuk SATU berita
     */
    public function getBeritaDetail($slug)
    {
        // Cari berita di data palsu berdasarkan slug
        $berita = null;
        foreach ($this->beritaData as $item) {
            if ($item['slug'] === $slug) {
                $berita = $item;
                break;
            }
        }

        if ($berita) {
            // Jika ditemukan, kembalikan sebagai JSON
            return response()->json($berita);
        } else {
            // Jika tidak, kembalikan error 404
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }
    }

    /**
     * Helper function untuk menghitung "waktu lalu"
     */
    private function getTimeAgo($dateString)
    {
        $date = new \DateTime($dateString);
        $now = new \DateTime();
        $interval = $now->diff($date);

        if ($interval->y > 0) return $interval->y . ' tahun lalu';
        if ($interval->m > 0) return $interval->m . ' bulan lalu';
        if ($interval->d > 0) return $interval->d . ' hari lalu';
        if ($interval->h > 0) return $interval->h . ' jam lalu';
        if ($interval->i > 0) return $interval->i . ' menit lalu';
        return 'baru saja';
    }

    /**
     * Helper function untuk mengambil ringkasan konten
     */
    private function getExcerpt($html, $word_limit = 15)
    {
        $text = strip_tags($html); // Hapus tag HTML
        $words = explode(' ', $text);
        if (count($words) > $word_limit) {
            return implode(' ', array_slice($words, 0, $word_limit)) . '...';
        }
        return $text;
    }
}