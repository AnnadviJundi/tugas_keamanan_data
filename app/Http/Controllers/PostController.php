<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::with('author')
            ->when($request->search, fn ($query, $search) => $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%"))
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->when($request->category, fn ($query, $category) => $query->where('category', $category))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $this->categories(),
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function approvals(): View
    {
        $posts = Post::with('author')
            ->where('status', 'draft')
            ->latest()
            ->paginate(10);

        return view('posts.approvals', compact('posts'));
    }

    public function preview(Post $post): View
    {
        abort_unless($post->status === 'draft', 404);

        return view('posts.preview', [
            'post' => $post->load('author'),
        ]);
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $post = Post::create($this->postData($request) + [
            'user_id' => $request->user()->id,
        ]);

        log_activity('create-post', "Created post {$post->title}");

        if ($post->isPublished()) {
            log_activity('publish-post', "Published post {$post->title}");
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $wasPublished = $post->isPublished();

        $post->update($this->postData($request));

        log_activity('edit-post', "Updated post {$post->title}");

        if (! $wasPublished && $post->isPublished()) {
            log_activity('publish-post', "Published post {$post->title}");
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        abort_unless(auth()->user()->hasPermission('delete-post'), 403);

        $title = $post->title;
        $post->delete();

        log_activity('delete-post', "Deleted post {$title}");

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

    public function publish(Post $post): RedirectResponse
    {
        abort_unless(auth()->user()->hasPermission('publish-post'), 403);

        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        log_activity('publish-post', "Published post {$post->title}");

        return back()->with('success', 'Post berhasil dipublish.');
    }

    private function postData(Request $request): array
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        return $data;
    }

    private function categories(): array
    {
        return ['Akademik', 'Beasiswa', 'Kegiatan', 'Layanan Mahasiswa', 'IT', 'Keamanan', 'Karier', 'Umum'];
    }
}
