<!-- <template>
  <div class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
      <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="text-2xl font-bold text-green-700">Terminal Pintar</div>
        <div class="hidden md:flex space-x-6 items-center">
          <a href="#kegiatan" class="text-gray-600 hover:text-green-700">Kegiatan</a>
          <a href="#tentang" class="text-gray-600 hover:text-green-700">Tentang Kami</a>
          <a href="#kontak" class="text-gray-600 hover:text-green-700">Kontak</a>
          <router-link 
            to="/login"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Login
          </router-link>
        </div>
        </div>
    </nav>

    <header class="bg-green-700 text-white p-12 md:p-20 text-center" style="background-color: #79a87c; /* Warna hijau dari gambar */">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Halo, Selamat Datang di Terminal Pintar!</h1>
      <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
        Mari bergabung bersama kami membangun komunitas untuk anak-anak Indonesia demi mendukung masa depan yang lebih baik.
      </p>
      <button class="bg-white text-green-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100">
        Jelajah lebih lanjut
      </button>
    </header>

    <main class="container mx-auto px-6 py-12">
      
      <section id="kegiatan" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Dokumentasi Kegiatan Terbaru Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div v-for="kegiatan in kegiatanTerbaru" :key="kegiatan.id" class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img :src="kegiatan.imageUrl" alt="Foto Kegiatan" class="w-full h-48 object-cover">
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">{{ kegiatan.judul }}</h3>
              <p class="text-sm text-gray-500 mb-3">{{ kegiatan.tanggal }}</p>
              <p class="text-gray-700 mb-4">{{ kegiatan.deskripsi }}</p>
              <a href="#" class="text-green-600 font-semibold hover:underline">Baca Selengkapnya</a>
            </div>
          </div>
          
        </div>
        <div class="text-center mt-8">
          <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            Lihat Semua Kegiatan
          </button>
        </div>
      </section>

      <section id="tentang" class="mb-16 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Tentang Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div>
            <h3 class="text-2xl font-semibold text-green-700 mb-3">SEJARAH</h3>
            <p class="text-gray-700 leading-relaxed">
              Pibleungon pada tanggal 17 Agustus 1953 (ini adalah placeholder, ganti dengan teks Anda)...
            </p>
          </div>
          <div>
            <h3 class="text-2xl font-semibold text-green-700 mb-3">VISI</h3>
            <p class="text-gray-700 leading-relaxed">
              Visi yang diusung adalah menjadikan Terminal Pintar sebagai "teman perjalanan" bagi anak-anak... 
            </p>
          </div>
        </div>
      </section>

      <section id="pengurus" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Tim Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
          
          <div v-for="orang in pengurus" :key="orang.id" class="bg-white p-6 rounded-lg shadow-lg">
            <img :src="orang.imageUrl" alt="Foto Pengurus" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
            <h3 class="text-xl font-semibold">{{ orang.nama }}</h3>
            <p class="text-gray-600">{{ orang.jabatan }}</p>
          </div>

        </div>
      </section>

      <section id="kontribusi" class="mb-16 bg-green-100 p-8 rounded-lg text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Mari Berkontribusi Membangun Harapan!</h2>
        <div class="flex flex-col md:flex-row justify-center gap-6">
          <div class="bg-white p-6 rounded-lg shadow-md flex-1">
            <h3 class="text-2xl font-semibold text-yellow-600 mb-3">DONASI</h3>
            <p class="text-gray-700 mb-4">Mari ikut berkontribusi untuk membantu mereka yang membutuhkan.</p>
            <button class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
              Lihat Cara Donasi
            </button>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md flex-1">
            <h3 class="text-2xl font-semibold text-yellow-600 mb-3">RELAWAN</h3>
            <p class="text-gray-700 mb-4">Mari ikut mengajar dan berbagi untuk membantu mereka yang membutuhkan.</p>
            <button class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
              Lihat Cara Mendaftar
            </button>
          </div>
        </div>
      </section>
    </main>

    <footer class="bg-gray-800 text-white p-8">
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h4 class="text-lg font-semibold mb-3">Kontak Kami</h4>
          <p class="mb-2">📞 +628123456789</p>
          <p>✉️ terminalpintar@gmail.com</p>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-3">Media Sosial</h4>
          <p class="mb-2">Instagram: @terminalpintar_id</p>
          <p class="mb-2">Twitter: @TerminalPintar</p>
          <p>YouTube: Terminal Pintar</p>
        </div>
      </div>
      <div class="text-center text-gray-500 mt-8 border-t border-gray-700 pt-4">
        © 2025 Terminal Pintar. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // Pastikan Anda sudah install axios

// Refs untuk menampung data dari API
const kegiatanTerbaru = ref([]);
const pengurus = ref([]);

// Fungsi untuk mengambil data dari backend Laravel
const fetchLandingData = async () => {
  try {
    // URL ini akan mengarah ke route API Laravel Anda
    const response = await axios.get('/api/landing-data');
    
    // Mengisi data ke refs
    kegiatanTerbaru.value = response.data.kegiatan;
    pengurus.value = response.data.pengurus;

  } catch (error) {
    console.error('Gagal mengambil data landing page:', error);
  }
};

// Panggil fungsi fetchLandingData() saat komponen di-mount
onMounted(() => {
  fetchLandingData();
});
</script>

<style scoped>
/* Anda bisa tambahkan style kustom di sini jika diperlukan */
</style> -->

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

<template>
  <div class="landing-page font-sans text-gray-800">
    
    <header class="bg-white border-b border-gray-200 py-4 sticky top-0 z-50 shadow-sm transition-all duration-300">
      <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center group cursor-pointer">
          <img src="/public/images/Logo.png" alt="Logo Terminal Pintar" class="h-10 w-10 mr-3 rounded-full group-hover:rotate-12 transition-transform duration-300">
          <span class="text-2xl font-bold text-[#76B340]  transition-colors">
            Terminal Pintar
          </span>
        </div>
        
        <nav class="flex items-center space-x-8">
          <a href="#kegiatan" class="relative text-gray-600 font-medium hover:text-[#76B340] transition-colors group">
            Kegiatan
            <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#76B340] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#tentang" class="relative text-gray-600 font-medium hover:text-[#76B340] transition-colors group">
            Tentang Kami
            <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#76B340] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#kontak" class="relative text-gray-600 font-medium hover:text-[#76B340] transition-colors group">
            Kontak
            <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-[#76B340] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <Link 
            href="/login" 
            class="bg-[#76B340] text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-[#659a35] hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-200"
          >
            Login
          </Link>
        </nav>
      </div>
    </header>
    
    <section 
    class="hero-section relative bg-cover bg-center h-[500px] flex items-center text-white group"
    style="background-image: url('images/hero.jpg');"
    >
      <div class="absolute inset-0 bg-gradient-to-r from-[#76B340]/90 to-[#76B340]/70 "></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 relative">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 italic drop-shadow-md">
          Halo, Selamat Datang di <br/> Terminal Pintar!
        </h1>
        <p class="text-lg md:text-xl font-light max-w-3xl mx-auto mb-10 italic opacity-90">
          Mari bergabung bersama kami untuk belajar, berbagi inspirasi, menjadi relawan, atau berdonasi demi mendukung masa depan yang lebih baik.
        </p>
        <a 
        href="#kegiatan"
        class="inline-block bg-white text-[#76B340] px-8 py-3 rounded-full text-base font-bold shadow-lg hover:bg-gray-50 hover:scale-105 hover:shadow-xl active:scale-95 transition-all duration-300"
        >
        Jelajah Lebih Lanjut
      </a>
      </div>
    </section>

    <section id="kegiatan" class="py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-[#76B340] mb-12 relative inline-block left-1/2 transform -translate-x-1/2">
          Dokumentasi Kegiatan Terbaru
          <span class="block h-1 w-20 bg-[#76B340] mx-auto mt-4 rounded-full"></span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          
          <div v-if="!isLoading && kegiatan.length > 0" v-for="item in kegiatan" :key="item.id" 
            class="group bg-white rounded-2xl shadow-md hover:shadow-2xl overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 border border-transparent hover:border-green-100">
            
            <div class="h-56 overflow-hidden relative">
              <img :src="item.gambar_url || 'https://via.placeholder.com/400x200'" :alt="item.judul" 
                class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-700">
              <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            </div>

            <div class="p-6 grow">
              <h3 class="font-bold text-xl mb-2 text-gray-900 group-hover:text-[#76B340] transition-colors">{{ item.judul }}</h3>
              <div class="flex items-center mb-3">
                <span class="text-xs font-semibold bg-green-100 text-[#76B340] px-2 py-1 rounded">
                  {{ formatTanggal(item.tanggal_kegiatan) }}
                </span>
              </div>
              <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">{{ item.deskripsi_singkat }}</p>
            </div>
            <div class="p-6 pt-0 mt-auto">
              <Link 
                :href="`/berita/${item.slug}`" 
                class="block w-full text-center border-2 border-[#76B340] text-[#76B340] px-5 py-2.5 rounded-xl text-sm font-bold group-hover:bg-[#76B340] group-hover:text-white transition-all duration-300"
                >
                Baca Selengkapnya
              </Link>
            </div>
          </div>

          <div v-if="isLoading" v-for="n in 3" :key="n" class="bg-white rounded-2xl shadow-lg overflow-hidden animate-pulse">
            <div class="h-56 w-full bg-gray-200"></div>
            <div class="p-6">
              <div class="h-6 bg-gray-200 rounded mb-3 w-3/4"></div>
              <div class="h-4 bg-gray-200 rounded w-1/3 mb-4"></div>
              <div class="space-y-2">
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded"></div>
                <div class="h-4 bg-gray-200 rounded w-2/3"></div>
              </div>
            </div>
          </div>

        </div>
        
        <div class="text-center mt-16">
          <Link 
            href="/berita"
            class="inline-flex items-center gap-2 text-[#76B340] font-bold text-lg hover:gap-4 transition-all duration-300 group"
            >
            Lihat semua kegiatan
            <span class="text-2xl group-hover:translate-x-1 transition-transform">→</span>
          </Link>
        </div>
      </div>
    </section>

    <section id="tentang" class="py-24 bg-white relative overflow-hidden">
      <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-green-50 rounded-full opacity-50 z-0"></div>
      <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-yellow-50 rounded-full opacity-50 z-0"></div>

      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h2 class="text-3xl font-bold text-center text-[#76B340] mb-16">
          Tentang Kami
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <div class="bg-white border-2 border-gray-100 p-8 rounded-2xl transition-all duration-300 hover:border-[#76B340] hover:shadow-xl hover:-translate-y-1 group">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#76B340]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="font-bold text-2xl text-gray-800 group-hover:text-[#76B340] mb-4 text-center transition-colors">SEJARAH</h3>
            <p class="text-gray-600 leading-relaxed text-center text-sm">
              Dibangun pada tanggal 17 Agustus 1502 berdasarkan perintah Kaisar dari Dinasti Ming. Pendiri diberikan kewenangan untuk mengurus komunitas dengan bantuan penuh dari Kaisar dan kemudian komunitas ini makin membesar dan terkenal di masyarakat umum.
            </p>
          </div>

          <div class="bg-white border-2 border-gray-100 p-8 rounded-2xl transition-all duration-300 hover:border-[#76B340] hover:shadow-xl hover:-translate-y-1 group">
             <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#76B340]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>
            <h3 class="font-bold text-2xl text-gray-800 group-hover:text-[#76B340] mb-4 text-center transition-colors">VISI</h3>
            <p class="text-gray-600 leading-relaxed text-center text-sm">
              Visi yang diusung adalah menjadikan Terminal Pintar sebagai “teman perjalanan” bagi anak-anak untuk menemukan kembali arti rumah, pendidikan, dan harapan. Melengkapi dengan nuansa yang lebih hangat dan menyenangkan.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-[#76B340] mb-16">
          Pengurus
        </h2>
        <div class="flex flex-wrap justify-center gap-x-20 gap-y-12">
          
          <div class="group flex flex-col items-center text-center w-52">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-[#76B340] rounded-full opacity-0 group-hover:opacity-20 transform scale-90 group-hover:scale-110 transition-all duration-300"></div>
              <img src="/public/images/pengurus.jpg" alt="Nabila Nurshani" class="w-36 h-36 rounded-full object-cover shadow-md relative z-10 group-hover:scale-105 transition-transform duration-300 border-4 border-white group-hover:border-[#76B340]">
            </div>
            <h4 class="font-bold text-xl text-gray-800 group-hover:text-[#76B340] transition-colors">Nabila Nurshani</h4>
            <p class="text-gray-500 font-medium">Pengurus</p>
          </div>

          <div class="group flex flex-col items-center text-center w-52">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-[#76B340] rounded-full opacity-0 group-hover:opacity-20 transform scale-90 group-hover:scale-110 transition-all duration-300"></div>
              <img src="/public/images/pengurus.jpg" alt="Andi Rahmadi" class="w-36 h-36 rounded-full object-cover shadow-md relative z-10 group-hover:scale-105 transition-transform duration-300 border-4 border-white group-hover:border-[#76B340]">
            </div>
            <h4 class="font-bold text-xl text-gray-800 group-hover:text-[#76B340] transition-colors">Andi Rahmadi</h4>
            <p class="text-gray-500 font-medium">Pengurus</p>
          </div>

          <div class="group flex flex-col items-center text-center w-52">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-[#76B340] rounded-full opacity-0 group-hover:opacity-20 transform scale-90 group-hover:scale-110 transition-all duration-300"></div>
              <img src="/public/images/pengurus.jpg" alt="Hanifah Ahmad" class="w-36 h-36 rounded-full object-cover shadow-md relative z-10 group-hover:scale-105 transition-transform duration-300 border-4 border-white group-hover:border-[#76B340]">
            </div>
            <h4 class="font-bold text-xl text-gray-800 group-hover:text-[#76B340] transition-colors">Hanifah Ahmad</h4>
            <p class="text-gray-500 font-medium">Pengurus</p>
          </div>

        </div>
      </div>
    </section>

    <section class="py-24 bg-white">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-[#76B340] mb-12">
          Mari Berkontribusi Membangun Harapan!
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
          
          <div class="group bg-white border-2 border-gray-100 rounded-2xl p-8 text-center shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#76B340] hover:-translate-y-2">
            <div class="bg-green-50 w-28 h-28 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-[#76B340] transition-colors duration-300">
              <img src="/public/images/donasi.jpg" alt="Donasi" class="h-20 w-20 rounded-full object-cover">
            </div>
            <h3 class="font-bold text-2xl text-gray-800 group-hover:text-[#76B340] mb-3 transition-colors">DONASI</h3>
            <p class="text-gray-600 mb-8 leading-relaxed">Mari ikut berdonasi untuk membantu mereka yang membutuhkan. Dukungan Anda sangat berarti.</p>
            <a 
              href="#"
              class="inline-block w-full bg-[#76B340] text-white px-6 py-3 rounded-xl text-base font-bold shadow-md hover:bg-[#659a35] hover:shadow-lg active:scale-95 transition-all duration-200"
            >
              Lihat Cara Berdonasi
            </a>
          </div>
          
          <div class="group bg-white border-2 border-gray-100 rounded-2xl p-8 text-center shadow-sm transition-all duration-300 hover:shadow-xl hover:border-[#EB9232] hover:-translate-y-2">
             <div class="bg-orange-50 w-28 h-28 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-[#EB9232] transition-colors duration-300">
              <img src="/public/images/relawan.jpg" alt="Relawan" class="h-20 w-20 rounded-full object-cover">
            </div>
            <h3 class="font-bold text-2xl text-gray-800 group-hover:text-[#EB9232] mb-3 transition-colors">RELAWAN</h3>
            <p class="text-gray-600 mb-8 leading-relaxed">Mari ikut menjadi relawan untuk membantu mereka yang membutuhkan. Bantuan Anda sangat dinanti.</p>
            <a 
              href="#"
              class="inline-block w-full bg-[#EB9232] text-white px-6 py-3 rounded-xl text-base font-bold shadow-md hover:bg-[#d6822a] hover:shadow-lg active:scale-95 transition-all duration-200"
            >
              Lihat Cara Mendaftar
            </a>
          </div>

        </div>
      </div>
    </section>

    <footer id="kontak" class="bg-[#76B340] text-white pt-20 pb-10">
      <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center gap-12 md:gap-32 px-8">
        <div class="group cursor-default">
          <h4 class="font-bold text-xl mb-6 flex items-center gap-2">
            <span>📞</span> Kontak Kami
          </h4>
          <p class="mb-3 flex items-center gap-3 hover:translate-x-2 transition-transform duration-200 cursor-pointer">+62 812 3456 789</p>
          <p class="mb-3 flex items-center gap-3 hover:translate-x-2 transition-transform duration-200 cursor-pointer">terminalpintar@gmail.com</p>
        </div>
        
        <div class="group cursor-default">
          <h4 class="font-bold text-xl mb-6 flex items-center gap-2">
            <span>📱</span> Media Sosial
          </h4>
          <a href="#" class="block mb-3 hover:text-green-100 hover:translate-x-2 transition-all duration-200">@terminalpintar_id</a>
          <a href="#" class="block mb-3 hover:text-green-100 hover:translate-x-2 transition-all duration-200">@terminalpintar</a>
          <a href="#" class="block mb-3 hover:text-green-100 hover:translate-x-2 transition-all duration-200">Terminal Pintar</a>
        </div>
      </div>
      
      <div class="mt-16 border-t border-green-700 pt-8 text-center text-sm text-green-100 opacity-80">
        <p>&copy; 2025 Terminal Pintar. All rights reserved.</p>
      </div>
    </footer>

  </div>
</template>