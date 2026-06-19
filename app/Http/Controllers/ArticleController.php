<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $lang = $request->get('lang', 'en');

        $query = Article::where('is_published', true);

        if ($category) {
            $query->where('category', $category);
        }

        $query->where('language', $lang);

        $articles = $query->latest('published_at')->paginate(12);

        $categories = Article::where('is_published', true)
            ->where('language', $lang)
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $featured = Article::where('is_published', true)
            ->where('language', $lang)
            ->latest('published_at')
            ->first();

        return view('learning', compact('articles', 'categories', 'featured', 'category', 'lang'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        $related = Article::where('is_published', true)
            ->where('language', $article->language)
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $article->load('comments.user.achievements');
        return view('articles.show', compact('article', 'related'));
    }
}
