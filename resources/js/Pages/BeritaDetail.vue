<script setup>
import { ref, onMounted, computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import axios from 'axios';

const berita = ref(null);
const isLoading = ref(true);
const error = ref(null);

const getSlugFromUrl = () => {
    const pathname = window.location.pathname;
    const slug = pathname.split('/').filter(Boolean).pop(); // Ambil elemen terakhir
    console.log("[v0] URL pathname:", pathname);
    console.log("[v0] Extracted slug:", slug);
    return slug;
};

const fetchBeritaDetail = async () => {
    const slug = getSlugFromUrl();
    
    if (!slug) {
        error.value = "Slug berita tidak valid";
        isLoading.value = false;
        return;
    }

    isLoading.value = true;
    try {
        const apiUrl = `/api/berita/${slug}`;
        console.log("[v0] Fetching from API:", apiUrl);
        
        const response = await axios.get(apiUrl);
        console.log("[v0] API Response:", response);
        
        berita.value = response.data;
        error.value = null;
        console.log("[v0] Berita berhasil dimuat:", berita.value);
    } catch (err) {
        console.log("[v0] API Error:", err);
        console.log("[v0] Error response status:", err.response?.status);
        console.log("[v0] Error response data:", err.response?.data);
        
        error.value = err.response?.data?.message || `Berita tidak ditemukan (${err.response?.status || err.message})`;
        berita.value = null;
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    setTimeout(() => {
        fetchBeritaDetail();
    }, 100);
});

const formatTanggal = (dateString) => {
    if (!dateString) return '';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};

const formattedDate = computed(() => {
    return berita.value ? formatTanggal(berita.value.tanggal_publikasi) : '';
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-b from-white via-slate-50 to-slate-100">
        <Head v-if="berita" :title="berita.judul" />
        <Head v-else title="Memuat Berita..." />

        <!-- Premium header dengan blur effect dan gradient branding -->
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <Link href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-500 bg-clip-text text-transparent">
                            Terminal Pintar
                        </div>
                    </Link>
                    <div class="hidden md:flex items-center gap-8">
                        <Link href="/" class="text-slate-700 hover:text-green-600 font-medium transition-colors">Beranda</Link>
                        <Link href="/berita" class="text-green-600 hover:text-green-700 font-semibold transition-colors">Kegiatan</Link>
                    </div>
                    <Link href="/login" class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-medium hover:shadow-lg hover:shadow-green-500/30 transition-all">
                        Login
                    </Link>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="py-12">
            <!-- Error state -->
            <div v-if="error && !isLoading" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">❌</div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">{{ error }}</h2>
                    <p class="text-slate-600 mb-8">Silakan kembali ke halaman kegiatan untuk melihat berita lainnya.</p>
                    <Link href="/berita" class="inline-block px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                        Kembali ke Kegiatan
                    </Link>
                </div>
            </div>

            <!-- Loading skeleton -->
            <div v-else-if="isLoading" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8 md:p-12 space-y-6">
                        <div class="h-8 bg-gradient-to-r from-slate-200 to-slate-300 rounded-lg w-1/4 animate-pulse"></div>
                        <div class="h-12 bg-gradient-to-r from-slate-200 to-slate-300 rounded-lg w-3/4 animate-pulse"></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="h-64 bg-gradient-to-br from-slate-200 to-slate-300 rounded-xl animate-pulse"></div>
                            <div class="h-64 bg-gradient-to-br from-slate-200 to-slate-300 rounded-xl animate-pulse"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-4 bg-slate-200 rounded-lg w-full animate-pulse"></div>
                            <div class="h-4 bg-slate-200 rounded-lg w-full animate-pulse"></div>
                            <div class="h-4 bg-slate-200 rounded-lg w-5/6 animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content detail dengan design modern dan elegant -->
            <article v-else-if="berita" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Hero Images Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 md:p-8 bg-gradient-to-br from-slate-50 to-white">
                        <img 
                            v-for="(gambar, index) in berita.gambar_header" 
                            :key="index" 
                            :src="gambar" 
                            :alt="berita.judul" 
                            class="w-full h-72 object-cover rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300"
                            @error="$event.target.src = '/placeholder.svg?height=288&width=400'"
                        >
                    </div>

                    <!-- Content Section -->
                    <div class="p-8 md:p-12">
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 mb-4">
                            <Link href="/" class="text-green-600 hover:text-green-700 font-medium transition-colors text-sm">
                                Beranda
                            </Link>
                            <span class="text-slate-400">/</span>
                            <Link href="/berita" class="text-green-600 hover:text-green-700 font-medium transition-colors text-sm">
                                Kegiatan
                            </Link>
                            <span class="text-slate-400">/</span>
                            <span class="text-slate-600 font-medium text-sm">{{ berita.judul.substring(0, 30) }}...</span>
                        </div>

                        <!-- Badge kategori -->
                        <div class="inline-block mb-4">
                            <span class="px-4 py-2 bg-gradient-to-r from-yellow-400/20 to-orange-400/20 text-yellow-700 text-sm font-bold rounded-full border border-yellow-200">
                                Dokumentasi Kegiatan
                            </span>
                        </div>

                        <!-- Judul -->
                        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4 leading-tight">
                            {{ berita.judul }}
                        </h1>

                        <!-- Meta information -->
                        <div class="flex flex-wrap items-center gap-6 mb-8 pb-8 border-b border-slate-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-slate-600 font-medium">{{ formattedDate }}</span>
                            </div>
                        </div>

                        <!-- Subtitle -->
                        <h2 class="text-2xl font-semibold text-slate-800 mb-8 text-balance">
                            {{ berita.subtitle }}
                        </h2>

                        <!-- Konten artikel -->
                        <div class="prose max-w-none prose-headings:text-slate-900 prose-headings:font-bold prose-p:text-slate-700 prose-p:leading-relaxed prose-p:text-justify mb-12 prose-a:text-green-600 prose-a:hover:text-green-700 prose-strong:text-slate-900 prose-strong:font-semibold" v-html="berita.konten"></div>

                        <!-- CTA Section -->
                        <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col sm:flex-row gap-4">
                            <Link href="/berita" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-green-500/30 transition-all text-center">
                                Kembali ke Kegiatan
                            </Link>
                            <a href="#top" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="flex-1 px-6 py-3 border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-all text-center cursor-pointer">
                                Kembali ke Atas
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Empty state -->
            <div v-else class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">📄</div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Berita Tidak Ditemukan</h2>
                    <p class="text-slate-600 mb-8">Maaf, berita yang Anda cari tidak tersedia.</p>
                    <Link href="/berita" class="inline-block px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                        Kembali ke Kegiatan
                    </Link>
                </div>
            </div>
        </main>

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

        <!-- Scroll to top button -->
        <a href="#top" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="fixed bottom-8 right-8 bg-gradient-to-r from-green-600 to-green-500 text-white p-3 rounded-full shadow-lg hover:shadow-xl hover:shadow-green-500/30 transition-all transform hover:scale-110 z-50 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </a>
    </div>
</template>

<style scoped>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';

.prose {
    font-family: inherit;
}

.prose p {
    margin-bottom: 1.5rem;
}

.prose h2, .prose h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}
</style>
