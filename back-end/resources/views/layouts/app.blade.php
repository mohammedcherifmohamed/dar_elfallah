<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'jass.books للكتب الشرعية')</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    :root {
      --crimson:    #800020;
      --deep:       #5a0016;
      --parchment:  #f5f0e8;
      --ink:        #241b0c;
      --gold:       #c8a84b;
      --gold-light: #e8d5a3;
      --cream:      #fdf8f0;
      --warm-gray:  #6b5c47;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Cairo', sans-serif;
      background: var(--cream);
      color: var(--ink);
      overflow-x: hidden;
    }
    .navbar {
      position: sticky; top: 0; z-index: 100;
      background: var(--deep);
      box-shadow: 0 2px 20px rgba(90,0,22,.5);
    }
    .nav-inner {
      max-width: 1280px; margin: 0 auto;
      display: flex; align-items: center;
      justify-content: space-between;
      padding: 0 24px; height: 70px;
    }
    .logo {
      display: flex; align-items: center; gap: 12px;
      text-decoration: none;
    }
    .logo-icon {
      width: 44px; height: 44px;
      border-radius: 50%;
      overflow: hidden;
      box-shadow: 0 0 0 3px rgba(200,168,75,.3);
      flex-shrink: 0;
    }
    .logo-icon img { width: 100%; height: 100%; object-fit: cover; }
    .logo-text { color: #fff; }
    .logo-text .name { font-size: 18px; font-weight: 700; line-height: 1.1; }
    .logo-text .sub { font-size: 11px; color: var(--gold-light); letter-spacing: .5px; }
    .nav-links { display: flex; gap: 28px; list-style: none; }
    .nav-links a {
      color: var(--gold-light); text-decoration: none;
      font-size: 14px; font-weight: 600;
      transition: color .2s; position: relative;
    }
    .nav-links a::after {
      content: ''; position: absolute; bottom: -4px; right: 0;
      width: 0; height: 2px; background: var(--gold);
      transition: width .25s;
    }
    .nav-links a:hover { color: #fff; }
    .nav-links a:hover::after { width: 100%; }
    .nav-actions { display: flex; gap: 12px; align-items: center; }
    .btn-search {
      background: none; border: 1px solid rgba(200,168,75,.4);
      color: var(--gold-light); border-radius: 20px;
      padding: 6px 16px; font-family: 'Cairo', sans-serif;
      font-size: 13px; cursor: pointer; transition: all .2s;
      display: flex; align-items: center; gap: 6px;
    }
    .btn-search:hover { background: rgba(200,168,75,.15); border-color: var(--gold); }
    .btn-cart {
      background: var(--crimson); border: none;
      color: #fff; border-radius: 20px;
      padding: 8px 18px; font-family: 'Cairo', sans-serif;
      font-size: 13px; cursor: pointer; transition: all .2s;
      display: flex; align-items: center; gap: 6px;
    }
    .btn-cart:hover { background: var(--gold); color: var(--ink); }
    .cart-overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,.5);
      z-index: 200; opacity: 0; pointer-events: none; transition: opacity .3s;
    }
    .cart-overlay.open { opacity: 1; pointer-events: all; }
    .cart-sidebar {
      position: fixed; top: 0; left: 0;
      width: 360px; height: 100vh;
      background: #fff; z-index: 201;
      transform: translateX(-100%); transition: transform .35s cubic-bezier(.22,.68,0,1.2);
      display: flex; flex-direction: column;
    }
    .cart-sidebar.open { transform: translateX(0); }
    .cart-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 20px 24px; border-bottom: 1px solid #eee;
    }
    .cart-header h3 { font-size: 18px; font-weight: 700; }
    .btn-close { background: none; border: none; font-size: 24px; cursor: pointer; }
    .cart-empty { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #aaa; }
    .cart-items { flex:1; overflow-y:auto; padding:16px 24px; }
    .cart-item { display:flex; align-items:center; gap:12px; padding:12px 0; border-bottom:1px solid #eee; }
    .cart-item-img { width:50px; height:65px; border-radius:6px; background:var(--parchment); display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; overflow:hidden; }
    .cart-item-img img { width:100%; height:100%; object-fit:cover; }
    .cart-item-info { flex:1; }
    .cart-item-title { font-size:13px; font-weight:700; color:var(--ink); line-height:1.3; }
    .cart-item-price { font-size:13px; color:var(--crimson); font-weight:700; margin-top:2px; }
    .cart-item-qty { display:flex; align-items:center; gap:6px; }
    .cart-item-qty button { width:26px; height:26px; border-radius:50%; border:1px solid #ddd; background:#fff; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center; transition:all .15s; }
    .cart-item-qty button:hover { background:var(--gold-light); border-color:var(--gold); }
    .cart-item-qty span { font-size:14px; font-weight:700; min-width:20px; text-align:center; }
    .cart-item-remove { background:none; border:none; font-size:16px; cursor:pointer; color:#ccc; transition:color .2s; padding:4px; }
    .cart-item-remove:hover { color:var(--crimson); }
    .cart-footer { border-top:1px solid #eee; padding:20px 24px; }
    .cart-total { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
    .cart-total span:first-child { font-size:15px; font-weight:600; color:var(--ink); }
    .cart-total-price { font-size:22px; font-weight:900; color:var(--crimson); }
    .btn-checkout { width:100%; height:48px; border-radius:8px; background:var(--crimson); color:#fff; border:none; font-family:'Cairo',sans-serif; font-size:16px; font-weight:700; cursor:pointer; transition:all .25s; }
    .btn-checkout:hover { background:var(--deep); }
    .search-modal {
      position: fixed; inset: 0; z-index: 300;
      background: rgba(36,27,12,.9); backdrop-filter: blur(8px);
      display: flex; align-items: flex-start; justify-content: center;
      padding-top: 100px;
      opacity: 0; pointer-events: none; transition: opacity .3s;
    }
    .search-modal.open { opacity: 1; pointer-events: all; }
    .search-box { width: 100%; max-width: 600px; padding: 0 24px; }
    .search-input-wrap { position: relative; display: flex; align-items: center; }
    .search-input {
      width: 100%; padding: 18px 56px 18px 20px;
      border-radius: 8px; border: 2px solid var(--gold);
      background: rgba(255,255,255,.05); color: #fff;
      font-family: 'Cairo', sans-serif; font-size: 18px;
      outline: none;
    }
    .search-input::placeholder { color: rgba(255,255,255,.4); }
    .search-icon { position: absolute; left: 16px; font-size: 20px; color: var(--gold); }
    .search-close { position: absolute; top: 16px; left: 16px; background: none; border: none; color: #fff; font-size: 28px; cursor: pointer; }
    .search-results { margin-top:16px; max-height:400px; overflow-y:auto; }
    .search-result-item { display:flex; align-items:center; gap:12px; padding:12px 16px; border-radius:8px; cursor:pointer; transition:background .15s; }
    .search-result-item:hover { background:rgba(255,255,255,.08); }
    .search-result-img { width:40px; height:52px; border-radius:4px; background:var(--deep); flex-shrink:0; overflow:hidden; }
    .search-result-img img { width:100%; height:100%; object-fit:cover; }
    .search-result-info { flex:1; }
    .search-result-title { font-size:14px; font-weight:700; color:#fff; }
    .search-result-author { font-size:12px; color:rgba(255,255,255,.5); }
    .search-result-price { font-size:13px; color:var(--gold); font-weight:700; }
    footer {
      background: var(--deep); color: rgba(255,255,255,.7);
      padding: 60px 24px 30px;
    }
    .footer-inner { max-width: 1280px; margin: 0 auto; }
    .footer-grid {
      display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 40px; margin-bottom: 48px;
    }
    .footer-brand .name {
      font-family: 'Amiri', serif; font-size: 22px; color: #fff; margin-bottom: 12px;
    }
    .footer-brand p { font-size: 13px; line-height: 1.8; }
    .footer-social { display: flex; gap: 10px; margin-top: 20px; }
    .social-btn {
      width: 36px; height: 36px; border-radius: 50%;
      background: rgba(255,255,255,.08);
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 14px; text-decoration: none;
      transition: background .2s;
    }
    .social-btn:hover { background: var(--gold); color: var(--ink); }
    .footer-col h4 { color: #fff; font-size: 15px; font-weight: 700; margin-bottom: 20px; }
    .footer-col ul { list-style: none; }
    .footer-col li { margin-bottom: 10px; }
    .footer-col a { color: rgba(255,255,255,.6); text-decoration: none; font-size: 13px; transition: color .2s; }
    .footer-col a:hover { color: var(--gold); }
    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.1); padding-top: 24px;
      text-align: center; font-size: 12px; color: rgba(255,255,255,.35);
    }
    .fade-in { opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease; }
    .fade-in.visible { opacity: 1; transform: translateY(0); }
    @media (max-width: 768px) {
      .footer-grid { grid-template-columns: 1fr 1fr; }
      .nav-links { display: none; }
    }
  </style>
  @stack('styles')
</head>
<body>

<!-- CART OVERLAY -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-sidebar" id="cartSidebar">
  <div class="cart-header">
    <h3> سلة الشراء</h3>
    <button class="btn-close" onclick="closeCart()">✕</button>
  </div>
  <div class="cart-items" id="cartItems">
    <div class="cart-empty"><p>سلة الشراء فارغة</p></div>
  </div>
  <div class="cart-footer" id="cartFooter" style="display:none;">
    <div class="cart-total">
      <span>المجموع</span>
      <span class="cart-total-price" id="cartTotal">0 دج</span>
    </div>
    <button class="btn-checkout" onclick="checkout()">إتمام الطلب</button>
  </div>
</div>

<!-- SEARCH MODAL -->
<div class="search-modal" id="searchModal">
  <button class="search-close" onclick="closeSearch()">✕</button>
  <div class="search-box">
    <div class="search-input-wrap">
      <input class="search-input" id="searchInput" placeholder="ابحث عن كتاب، مؤلف، تصنيف…" type="text" oninput="doSearch(this.value)" />
      <span class="search-icon"></span>
    </div>
    <div class="search-results" id="searchResults"></div>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-icon"><img src="{{ asset('storage/logo/logo.jpg') }}" alt="jass.books"></div>
      <div class="logo-text">
        <div class="name">jass.books</div>
        <div class="sub">للكتب الشرعية • الجزائر</div>
      </div>
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}#categories">التصنيفات</a></li>
      <li><a href="{{ route('home') }}#featured">الكتب المميزة</a></li>
    </ul>
    <div class="nav-actions">
      <button class="btn-search" onclick="openSearch()">
         <span>بحث</span>
      </button>
      <button class="btn-cart" onclick="openCart()">
         <span id="cartCount">السلة (0)</span>
      </button>
    </div>
  </div>
</nav>

@yield('content')

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="name"> jass.books للكتب الشرعية</div>
        <p>هنا حيث الكُتُب<br>
        "الفلاح" متجركم لبيع الكتب الشرعية<br>
        التوصيل داخل الجزائر فقط 🇩🇿</p>
        <div class="footer-social">
          <a class="social-btn" href="https://www.instagram.com/dar_elfallah.16/" target="_blank"> </a>
        </div>
      </div>
      <div class="footer-col">
        <h4>التصنيفات</h4>
        <ul>
          <li><a href="{{ route('home') }}#categories">جميع التصنيفات</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>روابط سريعة</h4>
        <ul>
          <li><a href="{{ route('home') }}">الصفحة الرئيسية</a></li>
          <li><a href="{{ route('home') }}#featured">الكتب المميزة</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>التوصيل</h4>
        <ul>
          <li><a href="#"> جل  ولايات الجزائر</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© {{ date('Y') }} jass.books للكتب الشرعية • الجزائر 🇩🇿 • جميع الحقوق محفوظة</p>
    </div>
  </div>
</footer>

<script>
  let cart = JSON.parse(localStorage.getItem('bookCart')) || [];
  let allBooks = [];

  function saveCart() {
    localStorage.setItem('bookCart', JSON.stringify(cart));
    updateCartUI();
  }

  function updateCartUI() {
    const count = cart.reduce((s, i) => s + i.qty, 0);
    document.getElementById('cartCount').textContent = `السلة (${count})`;
    const container = document.getElementById('cartItems');
    const footer = document.getElementById('cartFooter');
    if (!cart.length) {
      container.innerHTML = '<div class="cart-empty"><p>سلة الشراء فارغة</p></div>';
      footer.style.display = 'none';
      return;
    }
    footer.style.display = 'block';
    let html = '';
    let total = 0;
    cart.forEach((item, idx) => {
      total += item.price * item.qty;
      const imgHtml = item.image ? `<img src="{{ asset('storage') }}/${item.image}" alt="${item.title}">` : '';
      html += `<div class="cart-item">
        <div class="cart-item-img">${imgHtml}</div>
        <div class="cart-item-info">
          <div class="cart-item-title">${item.title}</div>
          <div class="cart-item-price">${item.price} دج</div>
        </div>
        <div class="cart-item-qty">
          <button onclick="cartQty(${idx},-1)">−</button>
          <span>${item.qty}</span>
          <button onclick="cartQty(${idx},1)">+</button>
        </div>
        <button class="cart-item-remove" onclick="cartRemove(${idx})">✕</button>
      </div>`;
    });
    container.innerHTML = html;
    document.getElementById('cartTotal').textContent = total + ' دج';
  }

  function cartQty(idx, delta) {
    cart[idx].qty = Math.max(1, cart[idx].qty + delta);
    saveCart();
  }

  function cartRemove(idx) {
    cart.splice(idx, 1);
    saveCart();
  }

  function addToCartBtn(btn, id, title, price, image) {
    const idx = cart.findIndex(i => i.id === id);
    if (idx > -1) {
      cart[idx].qty += 1;
    } else {
      cart.push({ id, title, price, qty: 1, image });
    }
    saveCart();
    btn.textContent = '✓';
    btn.style.background = '#28a745';
    showToast('تمت الإضافة');
    setTimeout(() => { btn.textContent = '+'; btn.style.background = ''; }, 1500);
  }

  function checkout() {
    if (!cart.length) return;
    const data = btoa(JSON.stringify(cart));
    window.location.href = '{{ route('checkout.index') }}?cart=' + encodeURIComponent(data);
  }

  function openCart() {
    document.getElementById('cartOverlay')?.classList.add('open');
    document.getElementById('cartSidebar')?.classList.add('open');
  }

  function closeCart() {
    document.getElementById('cartOverlay')?.classList.remove('open');
    document.getElementById('cartSidebar')?.classList.remove('open');
  }

  function openSearch() {
    document.getElementById('searchModal')?.classList.add('open');
    setTimeout(() => document.getElementById('searchInput')?.focus(), 0);
  }

  function closeSearch() {
    document.getElementById('searchModal')?.classList.remove('open');
    document.getElementById('searchResults').innerHTML = '';
    const inp = document.getElementById('searchInput');
    if (inp) inp.value = '';
  }

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeCart(); closeSearch(); }
  });

  async function doSearch(q) {
    const container = document.getElementById('searchResults');
    if (!q.trim()) { container.innerHTML = ''; return; }
    try {
      const res = await fetch(`{{ route('search') }}?q=${encodeURIComponent(q)}`);
      const results = await res.json();
      if (!results.length) {
        container.innerHTML = '<p style="color:rgba(255,255,255,.4);text-align:center;padding:20px;">لا توجد نتائج</p>';
        return;
      }
      let html = '';
      const baseUrl = '{{ url('/products') }}';
      const storageUrl = '{{ asset('storage') }}';
      results.forEach(b => {
        const imgHtml = b.image_path ? `<img src="${storageUrl}/${b.image_path}" alt="${b.title}">` : '';
        html += `<div class="search-result-item" onclick="window.location.href='${baseUrl}/${b.id}'">
          <div class="search-result-img">${imgHtml}</div>
          <div class="search-result-info">
            <div class="search-result-title">${b.title}</div>
            <div class="search-result-author">${b.author || ''}</div>
            <div class="search-result-price">${b.price} دج</div>
          </div>
        </div>`;
      });
      container.innerHTML = html;
    } catch(e) { console.error(e); }
  }

  function showToast(msg) {
    let t = document.getElementById('toast');
    if (!t) {
      t = document.createElement('div');
      t.id = 'toast';
      t.style.cssText = 'position:fixed;bottom:30px;left:50%;transform:translateX(-50%) translateY(80px);background:var(--ink);color:#fff;padding:14px 28px;border-radius:30px;font-size:14px;font-weight:600;z-index:500;opacity:0;transition:all .35s;box-shadow:0 8px 30px rgba(36,27,12,.3);white-space:nowrap;';
      document.body.appendChild(t);
    }
    t.textContent = msg;
    t.style.opacity = '1';
    t.style.transform = 'translateX(-50%) translateY(0)';
    setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(-50%) translateY(80px)'; }, 2800);
  }

  updateCartUI();
</script>
@stack('scripts')
</body>
</html>