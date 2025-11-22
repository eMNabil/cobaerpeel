<template>
  <div class="min-h-screen bg-gradient-to-b from-white via-slate-50 to-slate-100">
    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200/60 shadow-sm">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-green-200">
              TP
            </div>
            <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
              Terminal Pintar
            </div>
          </div>
          <div class="hidden md:flex items-center gap-8">
            <a href="#kegiatan" class="text-slate-700 hover:text-green-600 font-medium transition-colors relative group">
              Kegiatan
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="#tentang" class="text-slate-700 hover:text-green-600 font-medium transition-colors relative group">
              Tentang Kami
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="#kontak" class="text-slate-700 hover:text-green-600 font-medium transition-colors relative group">
              Kontak
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
            </a>
          </div>
          <Link href="/login" class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-medium hover:shadow-lg hover:shadow-green-500/30 transition-all transform hover:-translate-y-0.5">
            Login
          </Link>
        </div>
      </nav>
    </header>

    <!-- Hero Section -->
    <section 
  class="relative overflow-hidden pt-32 pb-40 bg-cover bg-center"
  style="background-image: url('/images/hero.jpg');"
>

      <div class="absolute inset-0 bg-gradient-to-br from-green-600/90 via-emerald-500/85 to-green-600/90"></div>
      <div class="absolute top-20 right-10 w-96 h-96 bg-yellow-300/20 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-10 left-10 w-[30rem] h-[30rem] bg-emerald-300/15 rounded-full blur-3xl"></div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full">
        <div class="absolute top-20 left-20 w-2 h-2 bg-white/40 rounded-full animate-ping"></div>
        <div class="absolute bottom-32 right-32 w-3 h-3 bg-yellow-300/50 rounded-full animate-pulse"></div>
        <div class="absolute top-40 right-20 w-2 h-2 bg-emerald-200/40 rounded-full animate-ping" style="animation-delay: 1s;"></div>
      </div>
      
      <div class="px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto space-y-8 animate-fade-in-up">
          <div class="inline-block mb-4 px-6 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white/90 text-sm font-medium">
            ✨ Bersama Membangun Masa Depan Cerah
          </div>
          <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">
            Selamat Datang di<br/>
            <span class="bg-gradient-to-r from-yellow-200 via-yellow-100 to-white bg-clip-text text-transparent drop-shadow-lg">Terminal Pintar</span>
          </h1>
          <p class="text-xl md:text-2xl text-white/95 mb-10 leading-relaxed max-w-3xl mx-auto font-light">
            Mari bergabung bersama kami untuk belajar, berbagi inspirasi, menjadi relawan, atau berdonasi demi mendukung masa depan yang lebih baik.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="#kegiatan" class="group px-8 py-4 bg-white text-green-600 rounded-xl font-semibold hover:shadow-2xl hover:shadow-white/20 transition-all transform hover:-translate-y-1 hover:scale-105 flex items-center gap-2">
              Jelajah Lebih Lanjut
              <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
            <a href="#kontribusi" class="px-8 py-4 border-2 border-white/80 backdrop-blur-sm bg-white/5 text-white rounded-xl font-semibold hover:bg-white/10 hover:border-white transition-all transform hover:-translate-y-1">
              Mulai Berkontribusi
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Kegiatan Section -->
    <section id="kegiatan" class="py-24 bg-gradient-to-b from-white via-slate-50/50 to-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
          <div class="inline-block mb-4 px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
            Kegiatan Terkini
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-5 tracking-tight">
            Dokumentasi Kegiatan Kami
          </h2>
          <p class="text-lg text-slate-600 max-w-2xl mx-auto font-light">Ikuti perkembangan kegiatan inspiratif yang sedang kami lakukan untuk masa depan yang lebih baik</p>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="flex justify-center items-center py-20">
          <div class="inline-block">
            <div class="w-14 h-14 border-4 border-slate-200 border-t-green-600 rounded-full animate-spin"></div>
          </div>
        </div>

        <!-- Kegiatan Cards -->
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="(item, index) in kegiatan" :key="index" class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden hover:border-green-400 hover:shadow-2xl hover:shadow-green-100/50 transition-all duration-500 transform hover:-translate-y-2">
            <!-- Card Header with Gradient -->
            <div class="h-40 bg-gradient-to-br from-green-500 via-emerald-500 to-green-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-gradient-to-br from-yellow-300/10 via-transparent to-emerald-400/10"></div>
              <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent"></div>
              <div class="absolute top-4 right-4 px-4 py-2 bg-white/95 backdrop-blur-sm text-green-700 text-xs font-bold rounded-xl shadow-lg">
                {{ formatTanggal(item.tanggal_kegiatan) }}
              </div>
              <div class="absolute bottom-4 left-4 w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                📸
              </div>
            </div>

            <!-- Card Content -->
            <div class="p-7">
              <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-green-600 transition-colors leading-tight">
                {{ item.judul }}
              </h3>
              <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed text-sm">
                {{ item.deskripsi_singkat }}
              </p>
              <Link 
                :href="`/berita/${item.id}`"
                class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 gap-2 group/link"
              >
                <span>Baca Selengkapnya</span>
                <span class="group-hover/link:translate-x-1 transition-transform">→</span>
              </Link>
            </div>
          </div>
        </div>

        <!-- View All Button -->
        <div class="text-center mt-16">
          <Link href="/berita" class="inline-block px-10 py-4 border-2 border-green-600 text-green-600 rounded-xl font-semibold hover:bg-green-600 hover:text-white transition-all transform hover:-translate-y-1 hover:shadow-lg">
            Lihat Semua Kegiatan
          </Link>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-24 bg-gradient-to-br from-slate-50 via-white to-green-50/30">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
          <div class="inline-block mb-4 px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
            Profil Kami
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-5 tracking-tight">
            Tentang Kami
          </h2>
          <p class="text-lg text-slate-600 max-w-2xl mx-auto font-light">Mengenal lebih dekat perjalanan dan visi kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
          <!-- Sejarah Card -->
          <div class="group bg-white rounded-3xl p-10 border border-slate-200/80 hover:border-green-400 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-green-200 group-hover:scale-110 transition-transform">
                📖
              </div>
              <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Sejarah</h3>
            </div>
            <p class="text-slate-600 leading-relaxed text-[15px]">
              Dibangun pada tanggal 17 Agustus 1502 berdasarkan perintah Kaisar dari Dinasti Ming. Pendiri diberikan kewenangan untuk mengurus komunitas dengan bantuan penuh dari Kaisar dan kemudian komunitas ini makin membesar dan terkenal di masyarakat umum. Beberapa tahun setelahnya, banyak relawan yang ikut meramaikan komunitas ini dan memberi bantuan yang sangat berarti untuk mencerdasakan kehidupan bangsa.
            </p>
          </div>

          <!-- Visi Card -->
          <div class="group bg-white rounded-3xl p-10 border border-slate-200/80 hover:border-yellow-400 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-yellow-200 group-hover:scale-110 transition-transform">
                ✨
              </div>
              <h3 class="text-2xl font-bold text-slate-900 tracking-tight">Visi</h3>
            </div>
            <p class="text-slate-600 leading-relaxed text-[15px]">
              Visi yang diusung adalah menjadikan Terminal Pintar sebagai "teman perjalanan" bagi anak-anak untuk menemukan kembali arti rumah, pendidikan, dan harapan. Artinya, tempat ini tidak dimaksudkan menggantikan sekolah formal, melainkan melengkapi dengan nuansa yang lebih hangat, menyenangkan, dan relevan dengan kehidupan mereka.
            </p>
          </div>
        </div>

        <!-- Team Section -->
        <div class="bg-gradient-to-br from-white to-green-50/30 rounded-3xl p-12 border border-green-100/50 shadow-xl">
          <h3 class="text-3xl font-bold text-slate-900 mb-12 text-center tracking-tight">
            Tim Pengurus Kami
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div v-for="member in ['Nabila Nurshani', 'Andi Rahmadi', 'Hanifah Ahmad']" :key="member" class="group text-center">
              <div class="relative mb-6 inline-block">
                <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full mx-auto flex items-center justify-center text-5xl group-hover:shadow-2xl group-hover:shadow-green-500/40 transition-all transform group-hover:scale-110 duration-500">
                  👤
                </div>
                <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-yellow-400 rounded-full border-4 border-white shadow-lg flex items-center justify-center text-lg">
                  ⭐
                </div>
              </div>
              <h4 class="text-lg font-bold text-slate-900 mb-2">{{ member }}</h4>
              <p class="text-slate-600 font-medium text-sm">Pengurus</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Kontribusi Section -->
    <section id="kontribusi" class="py-24 bg-gradient-to-br from-green-600 via-emerald-500 to-green-500 relative overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300/20 rounded-full blur-3xl"></div>
      <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-600/30 rounded-full blur-3xl"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
          <div class="inline-block mb-4 px-4 py-1 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-white text-sm font-semibold">
            Mari Bersama
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-white mb-5 tracking-tight">
            Berkontribusi Membangun Harapan
          </h2>
          <p class="text-lg text-white/95 max-w-2xl mx-auto font-light">Pilih cara terbaik untuk Anda berkontribusi dan menjadi bagian dari perubahan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
          <!-- Donasi Card -->
          <div class="group bg-white/98 backdrop-blur-xl rounded-3xl p-10 hover:bg-white hover:shadow-2xl hover:shadow-black/10 transition-all duration-500 transform hover:-translate-y-3">
            <div class="text-6xl mb-6 group-hover:scale-110 transition-transform duration-500">💝</div>
            <h3 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Donasi</h3>
            <p class="text-slate-600 mb-8 leading-relaxed text-[15px]">
              Mari ikut berdonasi untuk membantu mereka yang membutuhkan. Setiap kontribusi Anda sangat berarti dan membawa harapan baru.
            </p>
            <Link href="/donasi" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-xl hover:shadow-green-600/30 transition-all transform hover:-translate-y-1 group/btn">
              <span>Lihat Cara Berdonasi</span>
              <span class="group-hover/btn:translate-x-1 transition-transform">→</span>
            </Link>
          </div>

          <!-- Relawan Card -->
          <div class="group bg-white/98 backdrop-blur-xl rounded-3xl p-10 hover:bg-white hover:shadow-2xl hover:shadow-black/10 transition-all duration-500 transform hover:-translate-y-3">
            <div class="text-6xl mb-6 group-hover:scale-110 transition-transform duration-500">🤝</div>
            <h3 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Relawan</h3>
            <p class="text-slate-600 mb-8 leading-relaxed text-[15px]">
              Mari ikut menjadi relawan untuk membantu mereka yang membutuhkan. Waktu dan tenaga Anda sangat berharga bagi kami.
            </p>
            <Link href="/relawan" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-yellow-500 to-amber-500 text-white rounded-xl font-semibold hover:shadow-xl hover:shadow-yellow-500/30 transition-all transform hover:-translate-y-1 group/btn">
              <span>Lihat Cara Mendaftar</span>
              <span class="group-hover/btn:translate-x-1 transition-transform">→</span>
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact & Footer Section -->
    <footer class="bg-slate-900 text-white py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 pb-16 border-b border-slate-800/50">
          <!-- Brand -->
          <div>
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-green-900/50">
                TP
              </div>
              <h3 class="text-2xl font-bold bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">
                Terminal Pintar
              </h3>
            </div>
            <p class="text-slate-400 leading-relaxed text-sm">
              Bersama membangun masa depan yang lebih cerah melalui pendidikan dan kepedulian sosial.
            </p>
          </div>
          
          <!-- Contact Info -->
          <div>
            <h3 id="kontak" class="text-xl font-bold mb-6 tracking-tight">Kontak Kami</h3>
            <div class="space-y-4">
              <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center group-hover:bg-green-600/30 transition-colors">
                  <span class="text-xl">📞</span>
                </div>
                <span class="text-slate-300 group-hover:text-white transition-colors text-sm">+628123456789</span>
              </div>
              <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center group-hover:bg-green-600/30 transition-colors">
                  <span class="text-xl">✉️</span>
                </div>
                <span class="text-slate-300 group-hover:text-white transition-colors text-sm">terminalpintar@gmail.com</span>
              </div>
            </div>
          </div>

          <!-- Social Media -->
          <div>
            <h3 class="text-xl font-bold mb-6 tracking-tight">Media Sosial</h3>
            <div class="space-y-3">
              <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center group-hover:bg-green-600/30 transition-colors">
                  <span class="text-lg">📱</span>
                </div>
                <span class="text-slate-300 group-hover:text-white transition-colors text-sm">@terminalpintar_id</span>
              </div>
              <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center group-hover:bg-green-600/30 transition-colors">
                  <span class="text-lg">📱</span>
                </div>
                <span class="text-slate-300 group-hover:text-white transition-colors text-sm">@terminalpintar</span>
              </div>
              <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-10 h-10 bg-green-600/20 rounded-xl flex items-center justify-center group-hover:bg-green-600/30 transition-colors">
                  <span class="text-lg">👥</span>
                </div>
                <span class="text-slate-300 group-hover:text-white transition-colors text-sm">Terminal Pintar</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center text-slate-400">
          <p class="text-sm">&copy; 2025 Terminal Pintar. Semua hak dilindungi.</p>
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

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out;
}

/* Enhance smooth transitions */
* {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>