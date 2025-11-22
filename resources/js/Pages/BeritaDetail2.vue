<script setup>
import { ref, onMounted, computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import axios from 'axios';

const berita = ref(null);
const isLoading = ref(true);

// Fungsi untuk mengambil data detail
// const fetchBeritaDetail = async () => {
//     // 1. Dapatkan slug dari URL browser
//     const slug = window.location.pathname.split('/').pop();
    
//     isLoading.value = true;
//     try {
//         // 2. Panggil API detail yang baru kita buat
//         const response = await axios.get(`/api/berita/${slug}`);
//         berita.value = response.data;
//     } catch (error) {
//         console.error("Gagal mengambil data detail berita:", error);
//         // Nanti kita bisa tampilkan halaman 404
//     } finally {
//         isLoading.value = false;
//     }
// };
const fetchBeritaDetail = async () => {
    // 1. Ambil slug dari URL Browser (misal: /berita/judul-slug)
    // .pop() akan mengambil segmen terakhir
    const slug = window.location.pathname.split('/').pop();
    
    isLoading.value = true;
    try {
        // 2. Panggil API Data (ke routes/api.php)
        // Pastikan URL ini cocok dengan route di api.php
        const response = await axios.get(`/api/berita/${slug}`);
        berita.value = response.data;
    } catch (error) {
        console.error("Gagal mengambil data detail berita:", error);
        // Opsional: Redirect jika 404 atau tampilkan pesan error
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchBeritaDetail();
});
// Panggil saat komponen dimuat
onMounted(() => {
    fetchBeritaDetail();
});

// Format tanggal
const formatTanggal = (dateString) => {
    if (!dateString) return '';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

// Ambil tanggal yang sudah diformat
const formattedDate = computed(() => {
    return berita.value ? formatTanggal(berita.value.tanggal_publikasi) : '';
});
</script>

<template>
    <div class="font-sans bg-gray-100 min-h-screen">
        <Head v-if="berita" :title="berita.judul" />
        <Head v-else title="Memuat Berita..." />

        <header class="bg-white border-b border-gray-200 py-4 sticky top-0 z-50">
            <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <Link href="/" class="flex items-center">
                    <img src="/Logo Terminal Pintar.png" alt="Logo Terminal Pintar" class="h-10 w-10 mr-3 rounded-full">
                    <span class="text-2xl font-bold text-[#76B340]">
                        Terminal Pintar
                    </span>
                </Link>
                
                <nav class="flex items-center space-x-6">
                    <Link href="/" class="text-gray-700 font-medium hover:text-[#76B340] transition-colors">Beranda</Link>
                    <Link href="/berita" class="text-[#76B340] font-medium hover:text-[#76B340] transition-colors font-bold underline">Kegiatan</Link>
                    <Link 
                        href="/login" 
                        class="bg-[#76B340] text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-opacity-80 transition-colors"
                    >
                        Login
                    </Link>
                </nav>
            </div>
        </header>

        <main class="py-0">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                
                <div v-if="isLoading" class="p-8 md:p-12 animate-pulse">
                    <div class="h-6 bg-gray-300 rounded w-1/4 mb-4"></div>
                    <div class="h-10 bg-gray-300 rounded w-3/4 mb-6"></div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="h-64 bg-gray-300 rounded-lg"></div>
                        <div class="h-64 bg-gray-300 rounded-lg"></div>
                    </div>
                    <div class="h-6 bg-gray-300 rounded w-1/3 mb-6"></div>
                    <div class="space-y-4">
                        <div class="h-4 bg-gray-300 rounded w-full"></div>
                        <div class="h-4 bg-gray-300 rounded w-full"></div>
                        <div class="h-4 bg-gray-300 rounded w-5/6"></div>
                        <div class="h-4 bg-gray-300 rounded w-full"></div>
                    </div>
                </div>

                <article v-if="berita" class="p-8 md:p-12">
                    
                    <div class="text-sm font-semibold text-[#76B340] mb-2">
                        Dokumentasi Kegiatan
                    </div>
                    
                    <h1 class="text-4xl font-bold text-gray-900 mb-6">
                        {{ berita.judul }}
                    </h1>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <img 
                            v-for="(gambar, index) in berita.gambar_header" 
                            :key="index" 
                            :src="gambar" 
                            alt="Foto Kegiatan" 
                            class="w-full h-64 object-cover rounded-lg"
                        >
                    </div>
                    
                    <div class="text-sm text-gray-500 mb-4">
                        {{ formattedDate }}
                    </div>
                    
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        {{ berita.subtitle }}
                    </h2>
                    
                    <div class="prose max-w-none prose-p:text-justify" v-html="berita.konten"></div>
                </article>

            </div>
        </main>

        <a href="#" class="fixed bottom-8 right-8 bg-[#76B340] text-white p-3 rounded-full shadow-lg hover:bg-opacity-80 transition-opacity z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </a>
    </div>
</template>