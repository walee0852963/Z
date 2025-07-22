<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    // public function show()
    // {
    //     $user = Auth::user();
    //     $posts = $user->posts()->with('comments.user', 'likes')->latest()->get();
    //     return view('profile.show', compact('user', 'posts'));
    // }
      public function show($id)
    {
        $user= User::findOrFail($id);
        $posts = $user->posts()->with('comments.user', 'likes')->latest()->get();

        return view('profile.show', compact('user','posts'));
    }
//     public function show($id)
// {
//     $user = \App\Models\User::findOrFail($id);
//     return view('show', compact('user'));
// }
public function update(Request $request)
{
    $user = auth()->user();

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('profile_image')) {
        $filename = time() . '.' . $request->profile_image->extension();
        $path = $request->profile_image->storeAs('profile_images', $filename, 'public');
        $data['profile_image'] = $path;
    }

     $user->update($data);

    return redirect()->back()->with('success', 'تم تحديث البيانات');
}


}

