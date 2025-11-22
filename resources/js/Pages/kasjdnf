<template>
  <div class="min-h-screen bg-gradient-to-b from-white via-slate-50 to-slate-100">
    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
            Terminal Pintar
          </div>
          <div class="hidden md:flex items-center gap-8">
            <a href="#kegiatan" class="text-slate-700 hover:text-green-600 font-medium transition-colors">Kegiatan</a>
            <a href="#tentang" class="text-slate-700 hover:text-green-600 font-medium transition-colors">Tentang Kami</a>
            <a href="#kontak" class="text-slate-700 hover:text-green-600 font-medium transition-colors">Kontak</a>
          </div>
          <Link href="/login" class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-medium hover:shadow-lg hover:shadow-green-500/30 transition-all">
            Login
          </Link>
        </div>
      </nav>
    </header>

    <!-- Hero Section -->
    <section 
    class="relative overflow-hidden pt-20 pb-32 bg-cover bg-center" 
    style="background-image: url('/hero.jpg');"
    >
      <div class="absolute inset-0 bg-[#76B340] bg-opacity-70"></div>
      <div class="absolute top-20 right-10 w-72 h-72 bg-yellow-300/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-0 left-10 w-96 h-96 bg-orange-300/5 rounded-full blur-3xl"></div>
      
      <div class="px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
          <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight italic">
            Halo, Selamat Datang di <span class="bg-gradient-to-r from-yellow-500 via-green to-orange-700 bg-clip-text text-transparent">Terminal Pintar </span>
          </h1>
          <p class="text-xl text-white text-slate-600 mb-8 leading-relaxed max-w-2xl mx-auto">
            Mari bergabung bersama kami untuk belajar, berbagi inspirasi, menjadi relawan, atau berdonasi demi mendukung masa depan yang lebih baik.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#kegiatan" class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-semibold hover:shadow-xl hover:shadow-green-500/30 transition-all transform hover:-translate-y-1">
              Jelajah lebih lanjut
            </a>
            <a href="#kontribusi" class="px-8 py-3 border-2 border-white-600 text-white rounded-lg font-semibold hover:bg-green-50 transition-all">
              Mulai Berkontribusi
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Kegiatan Section -->
    <section id="kegiatan" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-slate-900 mb-4">
            Dokumentasi Kegiatan Terbaru Kami
          </h2>
          <p class="text-lg text-slate-600">Ikuti perkembangan kegiatan menarik yang sedang kami lakukan</p>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="flex justify-center items-center py-20">
          <div class="inline-block">
            <div class="w-12 h-12 border-4 border-slate-200 border-t-green-600 rounded-full animate-spin"></div>
          </div>
        </div>

        <!-- Kegiatan Cards -->
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(item, index) in kegiatan" :key="index" class="group bg-white rounded-xl border border-slate-200 overflow-hidden hover:border-green-500 hover:shadow-xl transition-all duration-300">
            <!-- Card Header with Gradient Badge -->
            <div class="h-32 bg-gradient-to-br from-green-500 to-green-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-gradient-to-br from-yellow-300/20 to-orange-300/20"></div>
              <div class="absolute top-4 right-4 px-4 py-1 bg-yellow-400 text-slate-900 text-sm font-bold rounded-full">
                {{ formatTanggal(item.tanggal_kegiatan) }}
              </div>
            </div>

            <!-- Card Content -->
            <div class="p-6">
              <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-green-600 transition-colors">
                {{ item.judul }}
              </h3>
              <p class="text-slate-600 mb-6 line-clamp-3">
                {{ item.deskripsi_singkat }}
              </p>
              <Link 
                :href="`/berita/${item.id}`"
                class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 group-hover:gap-2 gap-1 transition-all"
              >
                Baca Selengkapnya
                <span>→</span>
              </Link>
            </div>
          </div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-12">
          <Link href="/berita" class="inline-block px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-all">
            Lihat semua kegiatan
          </Link>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-gradient-to-br from-slate-50 via-white to-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-slate-900 mb-12 text-center">
          Tentang Kami
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
          <!-- Sejarah Card -->
          <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-green-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                📖
              </div>
              <h3 class="text-2xl font-bold text-slate-900">SEJARAH</h3>
            </div>
            <p class="text-slate-600 leading-relaxed">
              Dibangun pada tanggal 17 Agustus 1502 berdasarkan perintah Kaisar dari Dinasti Ming. Pendiri diberikan kewenangan untuk mengurus komunitas dengan bantuan penuh dari Kaisar dan kemudian komunitas ini makin membesar dan terkenal di masyarakat umum. Beberapa tahun setelahnya, banyak relawan yang ikut meramaikan komunitas ini dan memberi bantuan yang sangat berarti untuk mencerdasakan kehidupan bangsa.
            </p>
          </div>

          <!-- Visi Card -->
          <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-yellow-500 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                ✨
              </div>
              <h3 class="text-2xl font-bold text-slate-900">VISI</h3>
            </div>
            <p class="text-slate-600 leading-relaxed">
              Visi yang diusung adalah menjadikan Terminal Pintar sebagai "teman perjalanan" bagi anak-anak untuk menemukan kembali arti rumah, pendidikan, dan harapan. Artinya, tempat ini tidak dimaksudkan menggantikan sekolah formal, melainkan melengkapi dengan nuansa yang lebih hangat, menyenangkan, dan relevan dengan kehidupan mereka.
            </p>
          </div>
        </div>

        <!-- Team Section -->
        <div class="bg-white rounded-2xl p-12">
          <h3 class="text-2xl font-bold text-slate-900 mb-10 text-center">
            Tim Pengurus Kami
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div v-for="member in ['Nabila Nurshani', 'Andi Rahmadi', 'Hanifah Ahmad']" :key="member" class="group text-center">
              <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center text-5xl group-hover:shadow-xl group-hover:shadow-green-500/30 transition-all transform group-hover:scale-110">
                👤
              </div>
              <h4 class="text-lg font-bold text-slate-900 mb-1">{{ member }}</h4>
              <p class="text-slate-600 font-medium">Pengurus</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Kontribusi Section -->
    <section id="kontribusi" class="py-20 bg-gradient-to-br from-green-600 via-green-500 to-yellow-400">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-white mb-4">
            Mari Berkontribusi Membangun Harapan!
          </h2>
          <p class="text-lg text-white/90">Pilih cara terbaik untuk Anda berkontribusi</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Donasi Card -->
          <div class="bg-white/95 backdrop-blur rounded-2xl p-8 hover:bg-white hover:shadow-2xl transition-all transform hover:-translate-y-2">
            <div class="text-5xl mb-4">💝</div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">DONASI</h3>
            <p class="text-slate-600 mb-6 leading-relaxed">
              Mari ikut berdonasi untuk membantu mereka yang membutuhkan. Dukungan Anda sangat berarti.
            </p>
            <Link href="/donasi" class="inline-block px-6 py-2 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
              Lihat Cara Berdonasi
            </Link>
          </div>

          <!-- Relawan Card -->
          <div class="bg-white/95 backdrop-blur rounded-2xl p-8 hover:bg-white hover:shadow-2xl transition-all transform hover:-translate-y-2">
            <div class="text-5xl mb-4">🤝</div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">RELAWAN</h3>
            <p class="text-slate-600 mb-6 leading-relaxed">
              Mari ikut menjadi relawan untuk membantu mereka yang membutuhkan. Bantuan Anda sangat berarti.
            </p>
            <Link href="/relawan" class="inline-block px-6 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
              Lihat Cara Mendaftar
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact & Footer Section -->
    <footer class="bg-slate-900 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12 pb-12 border-b border-slate-800">
          <!-- Contact Info -->
          <div>
            <h3 id="kontak" class="text-2xl font-bold mb-6">Kontak Kami</h3>
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <span class="text-2xl">📞</span>
                <span class="text-slate-300">+628123456789</span>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-2xl">✉️</span>
                <span class="text-slate-300">terminalpintar@gmail.com</span>
              </div>
            </div>
          </div>

          <!-- Social Media -->
          <div>
            <h3 class="text-2xl font-bold mb-6">Media Sosial</h3>
            <div class="space-y-3">
              <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">📱 @terminalpintar_id</p>
              <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">📱 @terminalpintar</p>
              <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">👥 Terminal Pintar</p>
            </div>
          </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center text-slate-400">
          <p>&copy; 2025 Terminal Pintar. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const kegiatan = ref([]);
const isLoading = ref(true);

onMounted(async () => {
  try {
    const response = await axios.get('/api/kegiatan-terbaru');
    kegiatan.value = response.data;
  } catch (error) {
    console.error("Gagal mengambil data kegiatan:", error);
  } finally {
    isLoading.value = false;
  }
});

const formatTanggal = (dateString) => {
  if (!dateString) return '';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
};
</script>

<style scoped>
/* @import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities'; */

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Smooth scroll behavior */
html {
  scroll-behavior: smooth;
}

/* Custom animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
