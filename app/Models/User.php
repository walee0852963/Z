<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'profile_image', // ← أضف هذا
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
}

public function followings()
{
    return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
}

public function isFollowing($userId)
{
    return $this->followings->contains($userId);
}

public function posts()
{
    return $this->hasMany(\App\Models\Post::class);
}

}
