<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('excerpt', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        $articles = $query->latest()->paginate(15);
        $categories = Article::selectRaw('category, count(*) as total')->groupBy('category')->orderBy('total', 'desc')->get();
        $totalAll = Article::count();
        $totalPublished = Article::where('is_published', true)->count();

        return view('admin.articles.index', compact('articles', 'categories', 'totalAll', 'totalPublished'));
    }

    public function create()
    {
        return view('admin.articles.form', ['article' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:articles,slug',
            'category' => 'required|in:nutrition,prevention,mental,environment,fitness',
            'language' => 'required|in:en,id',
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'source_url' => 'nullable|url|max:500',
            'author' => 'nullable|max:255',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', __('Article created.'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:articles,slug,' . $article->id,
            'category' => 'required|in:nutrition,prevention,mental,environment,fitness',
            'language' => 'required|in:en,id',
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'source_url' => 'nullable|url|max:500',
            'author' => 'nullable|max:255',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? ($article->published_at ?? now()) : null;

        if ($request->hasFile('image')) {
            if ($article->image_url) {
                Storage::disk('public')->delete($article->image_url);
            }
            $data['image_url'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', __('Article updated.'));
    }

    public function destroy(Article $article)
    {
        if ($article->image_url) {
            Storage::disk('public')->delete($article->image_url);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', __('Article deleted.'));
    }
}
