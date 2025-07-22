<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link href="aa.css" rel="stylesheet">
    <style>
     body {
            direction: rtl;
            font-family: Arial, sans-serif;
            background-color: #f0eeee;
            padding: 50px;
            text-align: center;
        }

        form {
            display: inline-block;
            background: rgb(190, 196, 212);
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
        }
        </style>
</head>
<body>
     <div class="navbar">
         <img src="{{ asset('logo.svg') }}" alt="Logo" style="height: 60px;">
     </div>

    <h2>تسجيل الدخول</h2>

    <form method="post" action="/login">
        @csrf
        <input type="email" name="email" placeholder="البريد الإلكتروني" required><br>
        <input type="password" name="password" placeholder="كلمة المرور" required><br>
        <button type="submit">دخول</button>
    </form>

    <p>ليس لديك حساب؟ <a href="/register">أنشئ حساب</a></p>

</body>
</html>
