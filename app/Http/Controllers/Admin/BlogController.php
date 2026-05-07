<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Blog::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'publish_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $imageName);
        }

        Blog::create([
            'title' => $validated['title'],
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'publish_date' => $validated['publish_date'],
            'image' => $imageName,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Blog::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'publish_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $blog = Blog::findOrFail($id);

        $imageName = $blog->image;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $imageName);
        }

        $blog->update([
            'title' => $validated['title'],
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'publish_date' => $validated['publish_date'],
            'image' => $imageName,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    public function delete($id)
    {
        Blog::destroy($id);

        return redirect()->route('admin.blogs.index');
    }
}
