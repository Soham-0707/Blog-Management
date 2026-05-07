<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        $categories = Blog::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $relatedBlogs = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(2)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $query = Blog::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('publish_date', $request->date);
        }

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $search = '%' . $request->search . '%';

                $builder->where('title', 'like', $search)
                    ->orWhere('short_description', 'like', $search)
                    ->orWhere('content', 'like', $search);
            });
        }

        $blogs = $query->latest()->get();

        return view('blogs.filter-data', compact('blogs'))->render();
    }
}
