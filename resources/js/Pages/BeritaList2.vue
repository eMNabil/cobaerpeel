<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const berita = ref([]);
const isLoading = ref(true);
const currentPage = ref(1);
const lastPage = ref(1);
const totalBerita = ref(0);
const perPage = ref(7); // Sesuai mockup

// Fungsi untuk mengambil data berita
const fetchBerita = async (page) => {
    isLoading.value = true;
    try {
        // Panggil API yang sudah kita daftarkan di web.php
        const response = await axios.get(`/api/semua-berita?page=${page}`);
        berita.value = response.data.data;
        currentPage.value = response.data.current_page;
        lastPage.value = response.data.last_page;
        totalBerita.value = response.data.total;
        perPage.value = response.data.per_page;
    } catch (error) {
        console.error("Gagal mengambil data berita:", error);
    } finally {
        isLoading.value = false;
    }
};

// Panggil saat komponen dimuat
onMounted(() => {
    fetchBerita(currentPage.value);
});

// Fungsi untuk mengubah halaman pagination
const goToPage = (page) => {
    if (page >= 1 && page <= lastPage.value) {
        currentPage.value = page;
        fetchBerita(page);
    }
};

// Format tanggal ke "DD MMMM YYYY"
const formatTanggal = (dateString) => {
    if (!dateString) return '';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

// Teks "Menampilkan X-Y dari Z"
const paginationLabel = computed(() => {
    if (totalBerita.value === 0) return "Tidak ada berita ditemukan.";
    const start = (currentPage.value - 1) * perPage.value + 1;
    const end = Math.min(currentPage.value * perPage.value, totalBerita.value);
    return `Menampilkan ${start}-${end} dari ${totalBerita.value} Berita`;
});

// Logika untuk menampilkan nomor halaman (misal: 1, 2, 3, ..., 10)
const paginationPages = computed(() => {
    const pages = [];
    const maxPagesToShow = 5;
    let startPage = Math.max(1, currentPage.value - Math.floor(maxPagesToShow / 2));
    let endPage = Math.min(lastPage.value, startPage + maxPagesToShow - 1);

    if (endPage - startPage + 1 < maxPagesToShow && lastPage.value >= maxPagesToShow) {
        startPage = Math.max(1, endPage - maxPagesToShow + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        pages.push(i);
    }
    return pages;
});

</script>

<template>
    <div class="berita-list-page font-sans bg-gray-100 min-h-screen">
        
        <header class="bg-white border-b border-gray-200 py-4 sticky top-0 z-50">
            <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center">
                    <img src="/public/images/Logo.png" alt="Logo Terminal Pintar" class="h-10 w-10 mr-3 rounded-full">
                    <span class="text-2xl font-bold text-[#76B340]">
                        Terminal Pintar
                    </span>
                </div>
                
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

        <section class="relative bg-gray-100 text-gray-800 pt-8 pb-0 px-4 sm:px-6 lg:px-8">
            <div> 
                <h1 class="text-4xl font-bold mb-3 text-[#76B340]">Daftar Dokumentasi dan Berita</h1>
                <p class="text-lg font-light text-gray-600">Selamat Datang di Dokumentasi dan Berita, dapatkan informasi terkait Terminal Pintar di sini!</p>
            </div>
        </section>

        <section class="pt-4 pb-12 bg-gray-100">
            <div class="px-4 sm:px-6 lg:px-8">

                <div v-if="isLoading" class="space-y-6">
                    <div v-for="n in 7" :key="n" class="bg-white rounded-lg shadow-sm p-4 flex items-center animate-pulse">
                        <div class="w-24 h-24 bg-gray-300 rounded-lg flex-shrink-0"></div>
                        <div class="ml-4 flex-grow">
                            <div class="h-6 bg-gray-300 rounded w-3/4 mb-2"></div>
                            <div class="h-4 bg-gray-300 rounded w-1/2 mb-3"></div>
                            <div class="h-10 bg-gray-300 rounded w-1/3"></div>
                        </div>
                        <div class="ml-4 w-20 h-4 bg-gray-300 rounded"></div>
                    </div>
                </div>

                <div v-else class="space-y-5">
                    <div v-for="item in berita" :key="item.id" class="bg-white rounded-lg shadow-sm p-4 flex items-center transition-all duration-300 hover:shadow-md">
                        <img :src="item.gambar_url" :alt="item.judul" class="w-24 h-24 object-cover rounded-lg flex-shrink-0">
                        <div class="ml-4 flex-grow">
                            <h3 class="font-bold text-lg text-gray-800">{{ item.judul }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ formatTanggal(item.tanggal_publikasi) }}</p>
                            <Link :href="`/berita/${item.slug}`" class="inline-block bg-white border border-[#76B340] text-[#76B340] px-3 py-1 rounded-full text-xs font-semibold hover:bg-gray-50 transition-colors">
                                Baca Selengkapnya
                            </Link>
                        </div>
                        <div class="ml-4 text-sm text-gray-600 flex-shrink-0 w-24 text-right">
                            {{ item.waktu_lalu }}
                        </div>
                    </div>
                </div>

                <div v-if="!isLoading && lastPage > 1" class="mt-8 flex justify-center items-center space-x-2">
                    <button
                        @click="goToPage(currentPage - 1)"
                        :disabled="currentPage === 1"
                        class="px-3 py-1 rounded-full text-gray-600 bg-white border border-gray-300 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        &lt;
                    </button>
                    <button
                        v-for="page in paginationPages"
                        :key="page"
                        @click="goToPage(page)"
                        :class="{ 'bg-[#76B340] text-white border-[#76B340]': page === currentPage, 'bg-white text-gray-700 border-gray-300': page !== currentPage }"
                        class="px-4 py-1 rounded-full border hover:bg-gray-100 transition-colors"
                    >
                        {{ page }}
                    </button>
                    <button
                        @click="goToPage(currentPage + 1)"
                        :disabled="currentPage === lastPage"
                        class="px-3 py-1 rounded-full text-gray-600 bg-white border border-gray-300 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        &gt;
                    </button>
                </div>
                
                <p class="text-center text-sm text-gray-600 mt-6">
                    {{ paginationLabel }}
                </p>

            </div>
        </section>

        </div>
</template>