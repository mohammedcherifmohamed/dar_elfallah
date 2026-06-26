<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') - jass.books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --crimson: #800020; --deep: #5a0016; --gold: #c8a84b; --gold-light: #e8d5a3; }
        body { font-family: 'Cairo', sans-serif; background: #f5f0e8; }
        .sidebar { background: var(--deep); min-height: 100vh; color: #fff; }
        .sidebar a { color: var(--gold-light); text-decoration: none; padding: 10px 20px; display: block; transition: all .2s; border-right: 3px solid transparent; }
        .sidebar a:hover, .sidebar a.active { background: rgba(200,168,75,.1); color: #fff; border-right-color: var(--gold); }
        .sidebar .brand { padding: 20px; font-size: 20px; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,.1); }
        .content { padding: 24px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(36,27,12,.08); }
        .card-header { background: #fff; border-bottom: 1px solid #eee; padding: 16px 24px; font-weight: 700; }
        .btn-crimson { background: var(--crimson); color: #fff; border: none; }
        .btn-crimson:hover { background: var(--deep); color: #fff; }
        .btn-gold { background: var(--gold); color: #241b0c; border: none; }
        .btn-gold:hover { background: var(--gold-light); }
        .table th { border-top: none; color: var(--deep); font-weight: 700; }
        .alert { border-radius: 10px; }
        .pagination { justify-content: center; }
        .page-item.active .page-link { background: var(--crimson); border-color: var(--crimson); }
        .page-link { color: var(--crimson); }
        img.thumb { width: 60px; height: 80px; object-fit: cover; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="brand">jass.books</div>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags ms-2"></i> التصنيفات
                </a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-book ms-2"></i> المنتجات
                </a>
                <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt ms-2"></i> عرض الموقع
                </a>
                <hr style="border-color:rgba(255,255,255,.1);margin:10px 20px;">
                <div style="padding:10px 20px;font-size:12px;color:rgba(255,255,255,.4);">
                    {{ Auth::user()->email }}
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:var(--gold-light);padding:10px 20px;display:block;width:100%;text-align:right;font-family:'Cairo',sans-serif;font-size:14px;cursor:pointer;transition:all .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color=''">
                        <i class="fas fa-sign-out-alt ms-2"></i> تسجيل الخروج
                    </button>
                </form>
            </div>
            <div class="col-md-10 content">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
