<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const berita = ref([]);
const isLoading = ref(true);
const currentPage = ref(1);
const lastPage = ref(1);
const perPage = ref(7);
const total = ref(0);
const error = ref(null);

const fetchBerita = async (page = 1) => {
    isLoading.value = true;
    error.value = null;
    try {
        console.log("[v0] Fetching berita from /api/semua-berita?page=" + page);
        const response = await axios.get(`/api/semua-berita?page=${page}`);
        console.log("[v0] Response received:", response.data);
        
        berita.value = response.data.data || [];
        currentPage.value = response.data.current_page || page;
        lastPage.value = response.data.last_page || 1;
        total.value = response.data.total || 0;
        perPage.value = response.data.per_page || 7;
    } catch (err) {
        console.error("[v0] Error fetching berita:", err);
        error.value = err.message || "Gagal mengambil data berita";
        berita.value = [];
    } finally {
        isLoading.value = false;
    }
};

const formatTanggal = (dateString) => {
    if (!dateString) return '';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

const getTimeAgo = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    const intervals = {
        tahun: 31536000,
        bulan: 2592000,
        minggu: 604800,
        hari: 86400,
        jam: 3600,
        menit: 60
    };
    
    for (const [key, value] of Object.entries(intervals)) {
        const interval = Math.floor(seconds / value);
        if (interval >= 1) {
            return `${interval} ${key} yang lalu`;
        }
    }
    return 'Baru saja';
};

const paginationPages = computed(() => {
    const pages = [];
    const maxPages = Math.min(5, lastPage.value);
    
    let startPage = Math.max(1, currentPage.value - 2);
    let endPage = Math.min(lastPage.value, startPage + maxPages - 1);
    
    if (endPage - startPage + 1 < maxPages) {
        startPage = Math.max(1, endPage - maxPages + 1);
    }
    
    for (let i = startPage; i <= endPage; i++) {
        pages.push(i);
    }
    
    return pages;
});

const paginationLabel = computed(() => {
    const start = (currentPage.value - 1) * perPage.value + 1;
    const end = Math.min(currentPage.value * perPage.value, total.value);
    return `Menampilkan ${start}-${end} dari ${total.value} berita`;
});

const goToPage = (page) => {
    if (page >= 1 && page <= lastPage.value) {
        fetchBerita(page);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

onMounted(() => {
    fetchBerita(1);
});
</script>

<template>
    <div class="berita-list-page font-sans bg-gradient-to-b from-white via-slate-50 to-slate-100 min-h-screen">
        
        <!-- Header Navigation -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/50 py-4 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <Link href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                    <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                        Terminal Pintar
                    </div>
                </Link>
                
                <nav class="hidden md:flex items-center gap-8">
                    <Link href="/" class="text-slate-700 font-medium hover:text-green-600 transition-colors">Beranda</Link>
                    <Link href="/berita" class="text-green-600 font-semibold hover:text-green-700 transition-colors">Kegiatan</Link>
                </nav>
                <Link 
                    href="/login" 
                    class="bg-gradient-to-r from-green-600 to-green-500 text-white px-6 py-2 rounded-lg text-sm font-medium hover:shadow-lg hover:shadow-green-500/30 transition-all"
                >
                    Login
                </Link>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative pt-12 pb-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white via-slate-50 to-slate-100">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-5xl lg:text-6xl font-bold mb-4 bg-gradient-to-r from-green-600 via-green-500 to-yellow-500 bg-clip-text text-transparent leading-tight">
                    Dokumentasi & Berita
                </h1>
                <p class="text-lg text-slate-600 font-light leading-relaxed max-w-2xl">
                    Selamat datang di pusat informasi Terminal Pintar. Dapatkan update terkini, dokumentasi lengkap, dan berita menarik seputar komunitas kami.
                </p>
            </div>
        </section>

        <!-- Main Content Section -->
        <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-100 to-slate-50">
            <div class="max-w-5xl mx-auto">

                <!-- error state display -->
                <div v-if="error" class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 text-red-700 font-medium">
                    {{ error }}
                </div>

                <!-- Loading State -->
                <div v-if="isLoading" class="space-y-6">
                    <div v-for="n in 5" :key="n" class="bg-white rounded-2xl shadow-sm p-6 flex gap-6 items-start animate-pulse border border-slate-100">
                        <div class="w-32 h-32 bg-gradient-to-br from-slate-200 to-slate-300 rounded-xl flex-shrink-0"></div>
                        <div class="flex-grow space-y-3">
                            <div class="h-6 bg-slate-300 rounded-lg w-3/4"></div>
                            <div class="h-4 bg-slate-200 rounded-lg w-1/2"></div>
                            <div class="h-10 bg-slate-300 rounded-lg w-1/4 mt-4"></div>
                        </div>
                    </div>
                </div>

                <!-- Empty state jika tidak ada data -->
                <div v-else-if="berita.length === 0" class="bg-white rounded-2xl shadow-sm p-12 text-center">
                    <div class="text-5xl mb-4">📚</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Tidak ada berita</h3>
                    <p class="text-slate-600">Silakan coba lagi nanti atau hubungi kami.</p>
                </div>

                <!-- News Cards -->
                <div v-else class="space-y-6">
                    <div 
                        v-for="item in berita" 
                        :key="item.id" 
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/50 overflow-hidden transition-all duration-500 transform hover:-translate-y-1 group"
                    >
                        <div class="flex flex-col sm:flex-row gap-6 p-6">
                            <!-- Image with overlay badge -->
                            <div class="relative flex-shrink-0 w-full sm:w-32 h-32 overflow-hidden rounded-xl bg-gradient-to-br from-slate-200 to-slate-300">
                                <img 
                                    :src="item.gambar_url" 
                                    :alt="item.judul" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    @error="$event.target.src = '/placeholder.svg?height=128&width=128'"
                                >
                                <!-- Date badge dengan gradient styling -->
                                <div class="absolute top-2 right-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-slate-900 px-3 py-1 rounded-lg text-xs font-bold shadow-md">
                                    {{ formatTanggal(item.tanggal_publikasi).split(' ').slice(0, 2).join(' ') }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-xl text-slate-900 mb-2 group-hover:text-green-600 transition-colors duration-300 line-clamp-2">
                                        {{ item.judul }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mb-4 font-medium">
                                        {{ formatTanggal(item.tanggal_publikasi) }}
                                    </p>
                                </div>
                                
                                <!-- CTA button dengan routing ke BeritaDetail menggunakan slug -->
                                <Link 
                                    :href="`/berita/${item.slug}`" 
                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-500 text-white px-6 py-2 rounded-full text-sm font-semibold hover:shadow-lg hover:shadow-green-500/30 transition-all duration-300 transform hover:scale-105 w-fit"
                                >
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </Link>
                            </div>

                            <!-- Time ago badge -->
                            <div class="hidden sm:flex flex-col items-center justify-center px-4 py-2 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                                <span class="text-xs text-slate-500 font-medium">{{ getTimeAgo(item.tanggal_publikasi) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced pagination dengan modern design -->
                <div v-if="!isLoading && lastPage > 1" class="mt-12 flex justify-center items-center gap-3">
                    <button
                        @click="goToPage(currentPage - 1)"
                        :disabled="currentPage === 1"
                        class="px-4 py-2 rounded-lg text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 hover:border-green-600 transition-all duration-300 disabled:opacity-40 disabled:cursor-not-allowed font-medium"
                    >
                        ← Sebelumnya
                    </button>
                    
                    <div class="flex items-center gap-2">
                        <button
                            v-for="page in paginationPages"
                            :key="page"
                            @click="goToPage(page)"
                            :class="{ 
                                'bg-gradient-to-r from-green-600 to-green-500 text-white shadow-lg shadow-green-500/30': page === currentPage, 
                                'bg-white text-slate-700 border border-slate-300 hover:bg-slate-50': page !== currentPage 
                            }"
                            class="px-4 py-2 rounded-lg border transition-all duration-300 font-medium hover:shadow-md"
                        >
                            {{ page }}
                        </button>
                    </div>

                    <button
                        @click="goToPage(currentPage + 1)"
                        :disabled="currentPage === lastPage"
                        class="px-4 py-2 rounded-lg text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 hover:border-green-600 transition-all duration-300 disabled:opacity-40 disabled:cursor-not-allowed font-medium"
                    >
                        Berikutnya →
                    </button>
                </div>
                
                <!-- Pagination label -->
                <div class="text-center mt-8">
                    <p class="text-sm text-slate-600 font-medium">
                        {{ paginationLabel }}
                    </p>
                </div>

            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-white py-16 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12 pb-12 border-b border-slate-800">
                    <div>
                        <h3 class="text-2xl font-bold mb-6">Kontak Kami</h3>
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

                    <div>
                        <h3 class="text-2xl font-bold mb-6">Media Sosial</h3>
                        <div class="space-y-3">
                            <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">📱 @terminalpintar_id</p>
                            <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">📱 @terminalpintar</p>
                            <p class="text-slate-300 hover:text-green-400 cursor-pointer transition-colors">👥 Terminal Pintar</p>
                        </div>
                    </div>
                </div>

                <div class="text-center text-slate-400">
                    <p>&copy; 2025 Terminal Pintar. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Smooth transitions for better UX */
* {
    @apply transition-colors duration-300;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: #78AE4E;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #76B340;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
