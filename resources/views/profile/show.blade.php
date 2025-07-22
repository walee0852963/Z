<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صفحتي الشخصية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background: #fafafa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
        }
        .profile-card {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            border: 1px solid #dbdbdb;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .post-card {
            background: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .comment {
            font-size: 14px;
            margin-top: 8px;
            padding-right: 10px;
            color: #333;
        }
        .navbar {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .likes {
            font-size: 14px;
            color: #e1306c;
            margin-top: 5px;
        }
        .timestamp {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="navbar">
    <img src="{{ asset('logo.svg') }}" alt="Logo" style="height: 60px;">
</div>

<div class="container">

    <div class="profile-card">
        {{-- <h2>👤 الملف الشخصي</h2> --}}

        <h2>👤 الملف الشخصي: {{ $user->name }}</h2>
       
        <div> 
            <img href="{{$user->name}}" >
        </div>
        <p><strong>الاسم:</strong> {{ $user->name }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
        <p><strong>عدد المتابعين:</strong> {{ $user->followers->count() }}</p>
        <p><strong>يتابع:</strong> {{ $user->followings->count() }}</p>
    </div>

       <h3>📄 منشوراتي</h3>

        @foreach($posts as $post)
           <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
       
     {{-- </form> --}}

        <div class="post-card">
            <p>{{ $post->content }}</p>
            <div class="timestamp">{{ $post->created_at->diffForHumans() }}</div>

            <div class="likes">❤️ {{ $post->likes->count() }} إعجابات</div>

            {{-- التعليقات --}}
            @foreach($post->comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                </div>
            @endforeach
        </div>
    @endforeach

</div>

</body>
</html>
