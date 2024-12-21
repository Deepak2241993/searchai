<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::paginate(5); 

        return view('admin.blog.index', compact('data'));
    }
    public function create()
    {
        return view('admin.blog.create')->with('pageTitle', 'Create Blog');
    }
    public function store(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'long_content' => 'required|string',
            'status' => 'required|in:draft,published',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validatedData['author_id'] = auth()->id();
        if ($request->hasFile('blog_image')) {
            $validatedData['blog_image'] = $request->file('blog_image')->store('blogs', 'public');
        }
        $blog->create($validatedData);
        return redirect()->route('admin.blog.index')->with('message', 'Blog Created Successfully');
    }
    public function show(Blog $blog)
    {
        //
    }
    public function edit($blogId)
    {
        $blogData = Blog::where('status', 'published')->findOrFail($blogId);
        return view('admin.blog.create', compact('blogData'))->with('pageTitle', 'Edit Blog');
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'long_content' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('blog_image')) {
            if ($blog->blog_image) {
                Storage::disk('public')->delete($blog->blog_image);
            }
            $validatedData['blog_image'] = $request->file('blog_image')->store('blogs', 'public');
        }

        $blog->update($validatedData);
        return redirect()->route('admin.blog.index')->with('message', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.',
        ]);
    }
}
