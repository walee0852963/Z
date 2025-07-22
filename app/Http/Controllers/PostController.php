<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
     public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    //           $posts = \App\Models\Post::with(['user', 'comments.user', 'likes'])->latest()->get();
    // return view('posts.index', compact('posts'));

    }

   public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login')->with('error', 'يجب تسجيل الدخول');
    }

    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    Post::create([
        'content' => $request->content,
        'user_id' => Auth::id(), // لن ترجع null طالما Auth::check() true
    ]);

    return redirect('/posts');
}

}