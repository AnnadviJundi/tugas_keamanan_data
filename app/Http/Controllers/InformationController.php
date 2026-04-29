<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request): View
    {
        return view('information.index', [
            'posts' => Post::with('author')
                ->where('status', 'published')
                ->when($request->search, fn ($query, $search) => $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                }))
                ->when($request->category, fn ($query, $category) => $query->where('category', $category))
                ->latest('published_at')
                ->paginate(8)
                ->withQueryString(),
            'publishedCount' => Post::where('status', 'published')->count(),
            'categories' => Post::where('status', 'published')
                ->select('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category'),
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->isPublished(), 404);

        return view('information.show', [
            'post' => $post->load('author'),
        ]);
    }
}
