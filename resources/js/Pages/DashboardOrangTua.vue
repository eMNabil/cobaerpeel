<!-- <template>
  <div class="p-6 md:p-8 bg-gray-50 min-h-screen">

    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <div class="text-sm text-gray-500">Beranda</div>
        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, Ibu Amel</h1>
        <p class="text-gray-600">Pantau perkembangan pendidikan anak Anda di Terminal Pintar</p>
      </div>

      <div class="shrink-0">
        <label for="nama-anak" class="text-sm font-medium text-gray-700">Nama Anak</label>
        <button id="nama-anak"
          class="flex items-center justify-between w-full sm:w-auto mt-1 space-x-4 rounded-lg border bg-white px-3 py-2 text-sm">
          <span>{{ dashboardData.nama_anak }}</span>
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
      </div>
    </header>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

      <main class="lg:col-span-2 space-y-6">

        <section>
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-5 rounded-lg shadow">
              <div class="flex justify-between items-center">
                <div class="p-2 bg-green-100 rounded-full">
                  <CheckBadgeIcon class="w-6 h-6 text-green-700" />
                </div>
                <span class="text-sm font-semibold text-yellow-600 bg-yellow-100 px-2 py-0.5 rounded-full">
                  {{ dashboardData.ringkasan?.persentase_kehadiran || 0 }}%
                </span>
              </div>
              <div class="mt-3">
                <p class="text-gray-500 text-sm">Kehadiran Bulan Ini</p>
                <p class="text-2xl font-bold">{{ dashboardData.ringkasan?.kehadiran || '-' }}</p>
                <p class="text-gray-500 text-sm">Pertemuan</p>
              </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
              <div class="flex justify-between items-center">
                <div class="p-2 bg-green-100 rounded-full">
                  <DocumentTextIcon class="w-6 h-6 text-green-700" />
                </div>
                <span class="text-sm font-semibold text-green-600 bg-green-100 px-2 py-0.5 rounded-full">100%</span>
              </div>
              <div class="mt-3">
                <p class="text-gray-500 text-sm">Catatan Baru</p>
                <p class="text-2xl font-bold">{{ dashboardData.ringkasan?.catatan_baru || 0 }}</p>
                <p class="text-gray-500 text-sm">Dari guru</p>
              </div>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
              <div class="flex justify-between items-center">
                <div class="p-2 bg-green-100 rounded-full">
                  <CalendarDaysIcon class="w-6 h-6 text-green-700" />
                </div>
              </div>
              <div class="mt-3">
                <p class="text-gray-500 text-sm">Jadwal berikutnya</p>
                <p class="text-xl font-bold">{{ dashboardData.ringkasan?.jadwal_berikutnya || '-' }}</p>
                <p class="text-gray-500 text-sm">{{ dashboardData.ringkasan?.tanggal_jadwal_berikutnya || '-' }}</p>
              </div>
            </div>

          </div>
        </section>

        <section class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Pintasan</h2>

          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
              <button @click="activeTab = 'riwayat'" :class="[
                activeTab === 'riwayat'
                  ? 'border-green-600 text-green-700'
                  : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                'whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm'
              ]">
                Riwayat Kehadiran
              </button>
              <button @click="activeTab = 'catatan'" :class="[
                activeTab === 'catatan'
                  ? 'border-green-600 text-green-700'
                  : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                'whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm'
              ]">
                Catatan Guru
              </button>
            </nav>
          </div>

          <div class="mt-6">
            <div v-if="activeTab === 'riwayat'" class="space-y-4">

              <div class="flex items-center gap-2 mb-4">
                <CheckBadgeIcon class="w-6 h-6 text-[#78AE4E]" />
                <h3 class="text-lg font-semibold text-gray-800">Riwayat Kehadiran</h3>
              </div>

              <div v-for="item in riwayatKehadiran" :key="item.id"
                class="bg-gray-50 border border-gray-100 rounded-lg p-4 flex justify-between items-start hover:shadow-sm transition-shadow">
                <div class="space-y-1">
                  <h4 class="font-semibold text-gray-900">{{ item.pelajaran }}</h4>

                  <div class="flex items-center gap-2 text-sm text-gray-600">
                    <CalendarDaysIcon class="w-4 h-4" />
                    <span>{{ item.tanggal }}</span>
                  </div>

                  <div class="flex items-center gap-2 text-sm text-gray-600">
                    <ClockIcon class="w-4 h-4" />
                    <span>{{ item.waktu }}</span>
                  </div>
                </div>

                <div>
                  <span class="bg-[#78AE4E] text-white text-xs font-medium px-3 py-1 rounded-full">
                    {{ item.status }}
                  </span>
                </div>
              </div>

            </div>

            <div v-if="activeTab === 'catatan'" class="space-y-5">
              <h3 class="text-md font-semibold text-gray-800">Catatan Terbaru</h3>

              <div v-for="catatan in catatanTerbaru" :key="catatan.id">
                <div class="flex justify-between items-start">
                  <p class="font-semibold text-gray-800">{{ catatan.pelajaran }}</p>
                  <span class="text-xs text-gray-500">{{ catatan.tanggal }}</span>
                </div>
                <p class="text-sm text-gray-600 mt-1">{{ catatan.isi }}</p>
                <div class="flex items-center space-x-1 mt-2">
                  <UserCircleIcon class="w-4 h-4 text-gray-400" />
                  <span class="text-xs text-gray-500">{{ catatan.guru }}</span>
                </div>
              </div>

              <div class="pt-4">
                <div class="pt-4">
                  <router-link to="/dashboard-catatan"
                    class="block w-full text-center py-2 px-4 border border-[#78AE4E] text-[#78AE4E] rounded-lg hover:bg-green-50 text-sm font-medium transition-colors">
                    Lihat Catatan Lengkap
                  </router-link>
                </div>
              </div>
            </div>
          </div>

        </section>

      </main>

      <aside class="lg:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow space-y-6">
          <h3 class="text-lg font-semibold text-gray-900">Jadwal Mendatang</h3>

          <div class="space-y-5">
            <div v-for="jadwal in jadwalMendatang" :key="jadwal.id" class="flex space-x-3">
              <div class="p-2 bg-green-100 rounded-full h-fit">
                <CalendarDaysIcon class="w-5 h-5 text-green-700" />
              </div>
              <div>
                <p class="font-semibold text-gray-800">{{ jadwal.pelajaran }}</p>
                <p class="text-sm text-gray-600">{{ jadwal.tanggal }}</p>
                <div class="flex items-center space-x-1 mt-1">
                  <ClockIcon class="w-4 h-4 text-gray-400" />
                  <span class="text-xs text-gray-500">{{ jadwal.waktu }}</span>
                </div>
                <div class="flex items-center space-x-1 mt-1">
                  <UserIcon class="w-4 h-4 text-gray-400" />
                  <span class="text-xs text-gray-500">{{ jadwal.guru }}</span>
                </div>
              </div>
            </div>
          </div>

          <router-link to="/dashboard-jadwal"
            class="block w-full text-center py-2 px-4 border border-[#78AE4E] text-[#78AE4E] rounded-lg hover:bg-green-50 text-sm font-medium transition-colors">
            Lihat Jadwal Lengkap
          </router-link>
        </div>
      </aside>

    </div>
  </div>
</template> -->


<!-- fix  -->
<template>
  <div class="min-h-screen" style="background: linear-gradient(135deg, #fafaf8 0%, #f5f3f0 100%)">
    
    <div class="p-6 md:p-8 max-w-7xl mx-auto">
      
      <header class="mb-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
          <div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Beranda</div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">Selamat Datang, Ibu Amel</h1>
            <p class="text-gray-600 mt-2">Pantau perkembangan pendidikan anak Anda di Terminal Pintar</p>
          </div>

          <div class="shrink-0 w-full sm:w-auto">
            <label for="nama-anak" class="text-xs font-semibold text-gray-700 uppercase tracking-wide block mb-2">Nama Anak</label>
            <button id="nama-anak"
              class="group flex items-center justify-between w-full sm:w-56 rounded-xl border-2 border-gray-200 bg-white px-4 py-3 text-sm font-medium hover:border-[#78AE4E] hover:shadow-lg hover:bg-gray-50 transition-all duration-300">
              <span class="text-gray-900 group-hover:text-[#78AE4E] transition-colors">{{ dashboardData.nama_anak }}</span>
              <svg class="w-5 h-5 text-gray-400 group-hover:text-[#78AE4E] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
          </div>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <main class="lg:col-span-2 space-y-8">

          <section>
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
              <span class="w-1 h-6 bg-[#78AE4E] rounded-full"></span>
              Ringkasan Bulan Ini
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

              <div class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-green-200 cursor-default">
                <div class="flex justify-between items-start mb-4">
                  <div class="p-3 bg-gradient-to-br from-[#78AE4E] to-[#76B340] rounded-xl shadow-md group-hover:shadow-green-200 transition-shadow">
                    <CheckBadgeIcon class="w-6 h-6 text-white" />
                  </div>
                  <span class="text-xs font-bold text-white bg-[#F9C70F] px-3 py-1.5 rounded-full shadow-sm">
                    {{ dashboardData.ringkasan?.persentase_kehadiran || 0 }}%
                  </span>
                </div>
                <div>
                  <p class="text-gray-600 text-xs font-medium uppercase tracking-wide group-hover:text-[#78AE4E] transition-colors">Kehadiran</p>
                  <p class="text-3xl font-bold text-gray-900 mt-1">{{ dashboardData.ringkasan?.kehadiran || '-' }}</p>
                  <p class="text-gray-500 text-sm mt-1">pertemuan</p>
                </div>
              </div>

              <div class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-orange-200 cursor-default">
                <div class="flex justify-between items-start mb-4">
                  <div class="p-3 bg-gradient-to-br from-[#EB9232] to-[#F0A74F] rounded-xl shadow-md group-hover:shadow-orange-200 transition-shadow">
                    <DocumentTextIcon class="w-6 h-6 text-white" />
                  </div>
                  <span class="text-xs font-bold text-white bg-[#EB9232] px-3 py-1.5 rounded-full shadow-sm">Baru</span>
                </div>
                <div>
                  <p class="text-gray-600 text-xs font-medium uppercase tracking-wide group-hover:text-[#EB9232] transition-colors">Catatan</p>
                  <p class="text-3xl font-bold text-gray-900 mt-1">{{ dashboardData.ringkasan?.catatan_baru || 0 }}</p>
                  <p class="text-gray-500 text-sm mt-1">dari guru</p>
                </div>
              </div>

              <div class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-yellow-200 cursor-default">
                <div class="flex justify-between items-start mb-4">
                  <div class="p-3 bg-gradient-to-br from-[#F9C70F] to-[#FFD700] rounded-xl shadow-md group-hover:shadow-yellow-200 transition-shadow">
                    <CalendarDaysIcon class="w-6 h-6 text-gray-900" />
                  </div>
                </div>
                <div>
                  <p class="text-gray-600 text-xs font-medium uppercase tracking-wide group-hover:text-yellow-600 transition-colors">Jadwal Berikutnya</p>
                  <p class="text-2xl font-bold text-gray-900 mt-1 truncate">{{ dashboardData.ringkasan?.jadwal_berikutnya || '-' }}</p>
                  <p class="text-gray-500 text-sm mt-1">{{ dashboardData.ringkasan?.tanggal_jadwal_berikutnya || '-' }}</p>
                </div>
              </div>

            </div>
          </section>

          <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-7">
              <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="w-1 h-6 bg-[#78AE4E] rounded-full"></span>
                Riwayat & Catatan
              </h2>

              <div class="border-b border-gray-200 mb-6">
                <nav class="flex gap-8">
                  <button @click="activeTab = 'riwayat'" :class="[
                    activeTab === 'riwayat'
                      ? 'border-b-2 border-[#78AE4E] text-[#78AE4E]'
                      : 'border-b-2 border-transparent text-gray-600 hover:text-[#78AE4E] hover:bg-green-50/50 rounded-t-lg',
                    'py-3 px-3 font-semibold text-sm transition-all duration-200'
                  ]">
                    Riwayat Kehadiran
                  </button>
                  <button @click="activeTab = 'catatan'" :class="[
                    activeTab === 'catatan'
                      ? 'border-b-2 border-[#78AE4E] text-[#78AE4E]'
                      : 'border-b-2 border-transparent text-gray-600 hover:text-[#78AE4E] hover:bg-green-50/50 rounded-t-lg',
                    'py-3 px-3 font-semibold text-sm transition-all duration-200'
                  ]">
                    Catatan Guru
                  </button>
                </nav>
              </div>

              <div class="space-y-4 min-h-[300px]"> <div v-if="activeTab === 'riwayat'" class="space-y-4">
                  <div v-for="item in riwayatKehadiran" :key="item.id"
                    class="group bg-white border border-gray-200 rounded-xl p-5 flex justify-between items-start hover:border-[#78AE4E] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                    <div class="space-y-2">
                      <h4 class="font-bold text-gray-900 group-hover:text-[#78AE4E] transition-colors">{{ item.pelajaran }}</h4>
                      <div class="flex items-center gap-2 text-sm text-gray-500 group-hover:text-gray-700">
                        <CalendarDaysIcon class="w-4 h-4" />
                        <span>{{ item.tanggal }}</span>
                      </div>
                      <div class="flex items-center gap-2 text-sm text-gray-500 group-hover:text-gray-700">
                        <ClockIcon class="w-4 h-4" />
                        <span>{{ item.waktu }}</span>
                      </div>
                    </div>
                    <span class="bg-gray-100 text-gray-600 group-hover:bg-[#78AE4E] group-hover:text-white transition-colors duration-300 text-xs font-bold px-4 py-2 rounded-lg whitespace-nowrap shadow-sm">
                      {{ item.status }}
                    </span>
                  </div>
                </div>

                <div v-if="activeTab === 'catatan'" class="space-y-5">
                  <div v-for="catatan in catatanTerbaru" :key="catatan.id" 
                    class="border-l-4 border-[#78AE4E] pl-5 py-3 pr-3 hover:bg-green-50/30 rounded-r-xl transition-colors duration-300 cursor-default">
                    <div class="flex justify-between items-start mb-2">
                      <p class="font-bold text-gray-900">{{ catatan.pelajaran }}</p>
                      <span class="text-xs text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded">{{ catatan.tanggal }}</span>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ catatan.isi }}</p>
                    <div class="flex items-center space-x-2 mt-3">
                      <div class="bg-gray-100 p-1 rounded-full">
                        <UserCircleIcon class="w-4 h-4 text-[#78AE4E]" />
                      </div>
                      <span class="text-xs text-gray-600 font-medium">{{ catatan.guru }}</span>
                    </div>
                  </div>

                  <router-link to="/dashboard-catatan"
                    class="block w-full text-center py-3 px-4 border-2 border-[#78AE4E] text-[#78AE4E] rounded-xl hover:bg-[#78AE4E] hover:text-white hover:shadow-md active:scale-[0.98] text-sm font-bold transition-all duration-200 mt-6">
                    Lihat Catatan Lengkap →
                  </router-link>
                </div>
              </div>

            </div>
          </section>

        </main>

        <aside class="lg:col-span-1">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 sticky top-6 transition-all hover:shadow-md">
            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
              <span class="w-1 h-6 bg-[#78AE4E] rounded-full"></span>
              Jadwal Mendatang
            </h3>

            <div class="space-y-2">
              <div v-for="jadwal in jadwalMendatang" :key="jadwal.id" 
                   class="group p-3 -mx-3 rounded-xl hover:bg-gray-50 transition-colors duration-200 cursor-default">
                <div class="flex gap-3">
                  <div class="p-2.5 bg-gray-100 group-hover:bg-green-100 rounded-lg h-fit transition-colors duration-300">
                    <CalendarDaysIcon class="w-5 h-5 text-[#78AE4E]" />
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="font-bold text-gray-900 text-sm group-hover:text-[#78AE4E] transition-colors">{{ jadwal.pelajaran }}</p>
                    <p class="text-xs text-gray-600 mt-1">{{ jadwal.tanggal }}</p>
                    <div class="flex items-center gap-3 mt-2">
                      <div class="flex items-center gap-1">
                        <ClockIcon class="w-3.5 h-3.5 text-gray-400" />
                        <span class="text-xs text-gray-500">{{ jadwal.waktu }}</span>
                      </div>
                      <div class="flex items-center gap-1">
                        <UserIcon class="w-3.5 h-3.5 text-gray-400" />
                        <span class="text-xs text-gray-500">{{ jadwal.guru }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <router-link to="/dashboard-jadwal"
              class="block w-full text-center py-3 px-4 border-2 border-[#78AE4E] text-[#78AE4E] rounded-xl hover:bg-[#78AE4E] hover:text-white hover:shadow-md active:scale-[0.98] text-sm font-bold transition-all duration-200 mt-6">
              Lihat Jadwal Lengkap →
            </router-link>
          </div>
        </aside>

      </div>

    </div>
  </div>
</template>

<script setup>
// Bagian Script tidak ada perubahan logika,
// Tetap sama seperti sebelumnya.
import { ref, onMounted } from 'vue';
import axios from 'axios';
import {
  CheckBadgeIcon,
  DocumentTextIcon,
  CalendarDaysIcon,
  UserCircleIcon,
  ClockIcon,
  UserIcon
} from '@heroicons/vue/24/outline';

const activeTab = ref('catatan');
const catatanTerbaru = ref([]);
const jadwalMendatang = ref([]);
const riwayatKehadiran = ref([]);

const dashboardData = ref({
  nama_anak: 'Memuat...',
  ringkasan: {
    kehadiran: '-',
    persentase_kehadiran: 0,
    catatan_baru: 0,
    jadwal_berikutnya: '-',
    tanggal_jadwal_berikutnya: '-'
  }
});

const fetchDashboardData = async () => {
  try {
    const response = await axios.get('/api/dashboard-orang-tua', {
      headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' }
    });
    
    if (typeof response.data === 'object' && response.data !== null) {
      dashboardData.value = { ...dashboardData.value, ...response.data };
      catatanTerbaru.value = response.data.catatan_terbaru || [];
      jadwalMendatang.value = response.data.jadwal_mendatang || [];
      riwayatKehadiran.value = response.data.riwayat_kehadiran || [];
    }
  } catch (error) {
    console.error("Gagal memuat dashboard:", error);
    if (error.response && error.response.status === 401) window.location.href = '/login';
  }
};

onMounted(() => {
  fetchDashboardData();
});
</script>