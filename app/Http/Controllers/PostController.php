<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'posts' => Post::with('user')->latest()->get(),
            'isAdmin' => auth()->user()->is_admin
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $request->user()->posts()->create($validated);

        // Se for AJAX, retorna JSON. Se não, faz redirect normal.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'post' => $post->load('user')]);
        }

        return redirect()->route('dashboard');
    }

    public function destroy(Post $post, Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $post->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('dashboard');
    }
}