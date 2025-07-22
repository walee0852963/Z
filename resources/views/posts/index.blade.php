
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>المنشورات</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            direction: rtl;
            background: #fafafa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
            pointer-events: all;
        }
        .myprofile{
             background-color: white;
            padding: 15px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;

        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 10px;
        }

        .post-card {
            background: white;
            border: 1px solid #dbdbdb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dbdbdb;
            border-radius: 6px;
            resize: none;
        }

        button {
            background-color: #0095f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            margin-top: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007acc;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .comment {
            padding: 5px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .likes {
            color: #999;
            font-size: 14px;
        }

        .comment-form input {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #dbdbdb;
            border-radius: 6px;
        }

        .follow-btn {
            background: none;
            color: #0095f6;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .follow-btn:hover {
            text-decoration: underline;
        }
       #aa{
        display: flex;
        position: relative;
        /* right: 109px; */

       }
       #ab{
        display: flex;
        /* position: relative; */
        /* right: 109px; */
        /* border: none; 
        cursor: pointer; */

       }
    </style>
</head>
<body>

{{-- <div class="navbar"> <img src="{{ asset('social_Z/resources/views/layouts/logo.svg') }}" </div> --}}
<div class="navbar" >
    <img href="/posts"  src="{{ asset('logo.svg') }}" alt="Logo" style="height: 60px;">
    <!-- #region -->
    <a id="ab" href="/login" style="right: 100px">logout</a>
    
    
</div>

 <div class="myprofile">

        <a href="{{ route('profile.show', auth()->user()->id) }}" 
           {{-- style="background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; position: relative; right: 400px;"> --}}
           
      > صفحتي الشخصية</a>
    </div>
 


<div class="container">

    <form method="POST" action="/posts">
        @csrf
       <img  href="" >
        <textarea name="content" rows="3" placeholder="اكتب شيئًا..."></textarea>
        <button type="submit">نشر</button>
    </form>

    <hr>

    @foreach($posts as $post)
        <div class="post-card">
            <div class="post-header">
                <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>

                @if(auth()->id() !== $post->user->id)
                    @if(auth()->user()->isFollowing($post->user->id))
                        <form action="{{ route('unfollow', $post->user->id) }}" method="POST">
                            @csrf
                            <button class="follow-btn">تتابعه</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $post->user->id) }}" method="POST">
                            @csrf
                            <button class="follow-btn">متابعه</button>
                        </form>
                    @endif
                @endif
            </div>
            

            <p>{{ $post->content }}</p>
            <small class="text-gray-500">{{ $post->created_at->diffForHumans() }}</small>

            {{-- تعليقات --}}
            @if($post->comments->count())
                <div class="mt-3">
                    @foreach($post->comments as $comment)
                        <div class="comment">
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- إضافة تعليق --}}
            <form action="/posts/{{ $post->id }}/comments" method="POST" class="comment-form" style="display: flex; gap: 8px; margin-top: 10px;">
                 @csrf
                   <input type="text" name="content" placeholder="اكتب تعليق..." required style="flex: 1; padding: 8px; border: 1px solid #dbdbdb; border-radius: 6px;">
                    <button type="submit" style="padding: 8px 12px; background-color: #0095f6; color: white; border: none; border-radius: 6px; cursor: pointer;">تعليق</button>
            </form>

            {{-- زر الإعجاب --}}
            <form method="POST" action="/like/{{ $post->id }}" style="margin-top: 10px;">
                @csrf
                @if($post->isLikedBy(auth()->user()))
                    <button type="submit" style="color:red;">❤️</button>
                @else
                    <button type="submit">🤍إعجبني</button>
                @endif
            </form>

            <div class="likes">الإعجابات: {{ $post->likes->count() }}</div>
        </div>
    @endforeach

</div>

</body>
</html>
