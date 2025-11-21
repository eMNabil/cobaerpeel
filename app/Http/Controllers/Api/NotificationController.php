<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Mengambil notifikasi user
    public function index(Request $request)
    {
        // Mengambil notifikasi bawaan Laravel yang belum dibaca
        // Pastikan tabel 'notifications' sudah ada (php artisan notifications:table)
        $notifications = $request->user()->unreadNotifications;
        
        return response()->json($notifications);
    }

    // Menandai semua sebagai terbaca
    public function markAllRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Semua notifikasi telah dibaca']);
    }
}