// resources/js/router.js (CONTOH)

import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from './Pages/LandingPage.vue';
import LoginPage from './Pages/LoginPage.vue'; 
import AuthenticatedLayout from './layouts/AuthenticatedLayout.vue'; 
import DashboardOrangTua from './Pages/DashboardOrangTua.vue';
import JadwalPage from './Pages/JadwalPage.vue';
import CatatanGuruPage from './Pages/CatatanGuruPage.vue';
import DashboardGuru from './Pages/DashboardGuru.vue';
import LandingPage2 from './Pages/LandingPage2.vue';

const routes = [
    {
        path: '/',
        name: 'landing',
        component: LandingPage 
    },
    {
        path: '/LandingPage2',
        name: 'landingPage2',
        component: LandingPage2 
    },
    {
        path: '/login',
        name: 'login',
        component: LoginPage,
    },
    {
        path: '/dashboard',
        component: AuthenticatedLayout, // Gunakan Layout sebagai induk
        meta: { requiresAuth: true },
        children: [
            // Halaman-halaman ini akan dimuat di dalam <router-view> AuthenticatedLayout
            {
                path: '', // URL /dashboard
                name: 'dashboard',
                component: DashboardOrangTua 
            },
            {
                path: '/dashboard-jadwal', // URL /dashboard-jadwal
                name: 'dashboard.jadwal',
                component: JadwalPage 
            },
            {
                path: '/dashboard-catatan', // URL /dashboard-catatan
                name: 'dashboard.catatan',
                component: CatatanGuruPage
            }
]}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    // Cek apakah halaman yang dituju butuh login (memiliki meta requiresAuth)
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Cek apakah punya token
        const token = localStorage.getItem('token');

        // Jika tidak punya token, tendang ke halaman login
        if (!token) {
            next({ name: 'login' });
        } else {
            // Jika punya, silakan lanjut
            next();
        }
    } else {
        // Jika halaman tidak butuh login (misal: landing page), silakan lewat
        next();
    }
});
export default router;