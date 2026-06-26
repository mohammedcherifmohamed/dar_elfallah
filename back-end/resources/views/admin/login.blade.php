<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - jass.books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --crimson: #800020; --deep: #5a0016; --gold: #c8a84b; }
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, var(--deep) 0%, var(--crimson) 55%, #a0002a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo .icon {
            width: 64px;
            height: 64px;
            background: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 12px;
            box-shadow: 0 0 0 4px rgba(200,168,75,.2);
        }
        .login-logo h1 { font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
        .login-logo p { font-size: 13px; color: #888; }
        .form-control {
            font-family: 'Cairo', sans-serif;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1.5px solid #e0d6c8;
        }
        .form-control:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(128,0,32,.1);
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--crimson);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
        }
        .btn-login:hover { background: var(--deep); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(90,0,22,.3); }
        .alert { border-radius: 10px; font-size: 14px; }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #888; text-decoration: none; font-size: 13px; transition: color .2s; }
        .back-link a:hover { color: var(--crimson); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <div class="icon"> </div>
            <h1>jass.books</h1>
            <p>لوحة التحكم - تسجيل الدخول</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="أدخل البريد الإلكتروني">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required placeholder="أدخل كلمة المرور">
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">تذكرني</label>
            </div>
            <button type="submit" class="btn-login">تسجيل الدخول</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← العودة إلى الموقع</a>
        </div>
    </div>
</body>
</html>
