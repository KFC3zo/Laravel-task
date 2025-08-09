<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // جلب البوستات بترتيب الأحدث أولًا مع تقطيع الوصف لحد 512 حرف
        $posts = Post::orderBy('created_at', 'desc')
            ->paginate(10) // كل صفحة فيها 10 بوستات
            ->through(function ($post) {
                $post->description = substr($post->description, 0, 512);
                return $post;
            });

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // تحقق من صحة البيانات
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2048',
            'contact_phone' => 'required|string|max:20',
        ]);

        // إنشاء البوست وربطه بالمستخدم الحالي
        $post = auth()->user()->posts()->create($validated);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201);
    }
}