<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = Auth::user();
        $user->followings()->attach($id);
        return back();
    }

    public function unfollow($id)
    {
        $user = Auth::user();
        $user->followings()->detach($id);
        return back();
    }
}

