<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    public function __invoke(): View
    {
        return view('reports.index', [
            'totalPosts' => Post::count(),
            'publishedPosts' => Post::where('status', 'published')->count(),
            'draftPosts' => Post::where('status', 'draft')->count(),
            'activeUsers' => User::count(),
            'latestPublishedPosts' => Post::with('author')
                ->where('status', 'published')
                ->latest('published_at')
                ->limit(8)
                ->get(),
            'reportNotes' => [
                'Konten published adalah informasi yang sudah bisa dibaca oleh viewer di menu Informasi Kampus.',
                'Konten draft masih berada di Post Management dan belum muncul untuk viewer.',
                'Activity Logs dipakai admin/manager untuk mengecek siapa yang membuat, mengubah, atau publish konten.',
            ],
        ]);
    }
}
