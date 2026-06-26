@extends('layouts.app')
@section('title', ($product->title ?? '') . ' – jass.books للكتب الشرعية')

@push('styles')
<style>
  :root {
    --border: #e8ddd0;
  }
  .breadcrumb-bar {
    background: var(--parchment);
    border-bottom: 1px solid var(--border);
    padding: 12px 0;
  }
  .breadcrumb-inner {
    max-width: 1280px; margin: 0 auto; padding: 0 24px;
    display: flex; align-items: center; gap: 8px; font-size: 13px;
    color: var(--warm-gray);
  }
  .breadcrumb-inner a { color: var(--warm-gray); text-decoration: none; transition: color .2s; }
  .breadcrumb-inner a:hover { color: var(--crimson); }
  .bc-sep { color: var(--border); font-size: 16px; }
  .bc-current { color: var(--ink); font-weight: 600; }

  .product-section {
    max-width: 1280px; margin: 0 auto; padding: 48px 24px 60px;
    display: grid; grid-template-columns: 380px 1fr; gap: 60px;
    align-items: start;
  }
  .cover-col { position: sticky; top: 90px; }
  .cover-main {
    position: relative; border-radius: 12px; overflow: hidden;
    aspect-ratio: 3/4;
    background: linear-gradient(160deg, #2c1810 0%, #800020 60%, #5a0016 100%);
    box-shadow: -8px 8px 40px rgba(90,0,22,.45), 8px 0 0 0 rgba(0,0,0,.2);
  }
  .cover-main img { width: 100%; height: 100%; object-fit: cover; }
  .cover-badge {
    position: absolute; top: 16px; left: 16px;
    background: var(--gold); color: var(--ink);
    font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px;
    z-index: 3;
  }
  .book-category-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(128,0,32,.08); color: var(--crimson);
    border: 1px solid rgba(128,0,32,.2);
    padding: 5px 14px; border-radius: 20px;
    font-size: 12px; font-weight: 700; margin-bottom: 16px;
  }
  .book-main-title {
    font-family: 'Amiri', serif;
    font-size: clamp(26px, 3.5vw, 38px); font-weight: 700;
    color: var(--ink); line-height: 1.4; margin-bottom: 8px;
  }
  .author-row {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 20px; padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
  }
  .author-avatar {
    width: 44px; height: 44px; border-radius: 50%;
    background: linear-gradient(135deg, var(--deep), var(--crimson));
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
  }
  .author-info .label { font-size: 11px; color: var(--warm-gray); }
  .author-info .name { font-size: 15px; font-weight: 700; color: var(--ink); }
  .price-block {
    background: var(--parchment); border-radius: 12px;
    padding: 24px; margin-bottom: 24px;
    border: 1px solid var(--border);
  }
  .price-label { font-size: 12px; color: var(--warm-gray); margin-bottom: 6px; }
  .price-current { font-size: 36px; font-weight: 900; color: var(--crimson); line-height: 1; }
  .price-note { font-size: 12px; color: var(--warm-gray); margin-top: 8px; }
  .buy-row { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
  .qty-control {
    display: flex; align-items: center; gap: 0;
    border: 1.5px solid var(--border); border-radius: 8px; overflow: hidden;
  }
  .qty-btn {
    width: 40px; height: 48px; background: var(--parchment); border: none;
    font-size: 20px; cursor: pointer; font-family: 'Cairo', sans-serif;
    transition: background .2s; color: var(--ink); font-weight: 700;
  }
  .qty-btn:hover { background: var(--gold-light); }
  .qty-input {
    width: 52px; height: 48px; border: none; border-right: 1.5px solid var(--border);
    border-left: 1.5px solid var(--border);
    text-align: center; font-family: 'Cairo', sans-serif;
    font-size: 16px; font-weight: 700; background: #fff; color: var(--ink);
    outline: none;
  }
  .btn-add-cart {
    flex: 1; background: var(--crimson); color: #fff; border: none;
    height: 48px; border-radius: 8px; font-family: 'Cairo', sans-serif;
    font-size: 16px; font-weight: 700; cursor: pointer;
    transition: all .25s; display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .btn-add-cart:hover { background: var(--deep); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(90,0,22,.3); }
  .btn-add-cart.added { background: #2a7a2a; }
  .btn-order-wa {
    width: 100%; height: 48px; border-radius: 8px;
    background: #25d366; color: #fff; border: none;
    font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 700;
    cursor: pointer; transition: all .25s;
    display: flex; align-items: center; justify-content: center; gap: 10px;
  }
  .btn-order-wa:hover { background: #128c7e; transform: translateY(-2px); }
  .trust-row { display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
  .unavailable-badge-detail { display: inline-block; background: #666; color: #fff; font-size: 13px; font-weight: 700; padding: 6px 16px; border-radius: 20px; margin-bottom: 16px; }
  .product-unavailable-msg { text-align: center; padding: 20px; background: #f5f5f5; border-radius: 12px; color: #666; font-weight: 700; font-size: 15px; margin-bottom: 16px; }
  .trust-badge {
    display: flex; align-items: center; gap: 6px;
    background: #fff; border: 1px solid var(--border);
    border-radius: 8px; padding: 8px 14px;
    font-size: 12px; color: var(--warm-gray); font-weight: 600;
  }
  .description-section { max-width: 1280px; margin: 0 auto 60px; padding: 0 24px; }
  .desc-text {
    font-family: 'Amiri', serif; font-size: 18px;
    line-height: 2; color: var(--ink);
  }
  .desc-text p { margin-bottom: 20px; }

  .related-section { background: var(--parchment); padding: 60px 0; border-top: 1px solid var(--border); }
  .related-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
  .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
  .product-unavailable { opacity: .55; filter: grayscale(.7); pointer-events: none; }
  .product-unavailable .btn-add-sm { display: none; }
  .unavailable-badge-sm { position: absolute; top: 6px; right: 6px; background: #666; color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 10px; z-index: 2; }
  .book-card {
    background:#fff; border-radius:12px; overflow:hidden;
    box-shadow:0 2px 12px rgba(36,27,12,.08);
    transition:transform .3s ease, box-shadow .3s ease; cursor:pointer;
  }
  .book-card:hover { transform:translateY(-6px); box-shadow:0 12px 32px rgba(36,27,12,.18); }
  .book-cover-sm {
    aspect-ratio:3/4; overflow:hidden;
    background: linear-gradient(160deg, #2c1810, #800020);
  }
  .book-cover-sm img { width:100%; height:100%; object-fit:cover; }
  .book-card-info { padding:14px; }
  .book-card-cat { font-size:11px; color:var(--crimson); font-weight:700; margin-bottom:4px; }
  .book-card-title { font-family:'Amiri',serif; font-size:15px; font-weight:700; color:var(--ink); line-height:1.3; margin-bottom:4px; }
  .book-card-author { font-size:12px; color:var(--warm-gray); margin-bottom:10px; }
  .book-card-footer { display:flex; align-items:center; justify-content:space-between; }
  .book-card-price { font-size:15px; font-weight:700; color:var(--crimson); }
  .btn-add-sm {
    background:var(--crimson); color:#fff; border:none;
    width:28px; height:28px; border-radius:50%;
    font-size:16px; cursor:pointer; transition:all .2s;
    display:flex; align-items:center; justify-content:center;
  }
  .btn-add-sm:hover { background:var(--gold); color:var(--ink); transform:rotate(90deg); }
  .section-header { margin-bottom: 36px; }
  .section-title { font-family:'Amiri',serif; font-size:32px; font-weight:700; color:var(--ink); }
  .section-title span { color:var(--crimson); }
  .divider { width:50px; height:3px; background:linear-gradient(90deg,var(--gold),var(--crimson)); margin-top:14px; border-radius:2px; }
  @media (max-width: 900px) {
    .product-section { grid-template-columns: 1fr; gap: 32px; }
    .cover-col { position: static; }
    .related-grid { grid-template-columns: repeat(2,1fr); }
  }
  @media (max-width: 600px) {
    .buy-row { flex-wrap:wrap; }
    .btn-add-cart { flex:1 1 100%; order:1; }
  }
</style>
@endpush

@section('content')

<!-- BREADCRUMB -->
<div class="breadcrumb-bar">
  <div class="breadcrumb-inner">
    <a href="{{ route('home') }}">الرئيسية</a>
    <span class="bc-sep">›</span>
    <a href="{{ route('home') }}">الكتب الشرعية</a>
    <span class="bc-sep">›</span>
    <a href="{{ route('home') }}#categories">{{ $product->category->name ?? '' }}</a>
    <span class="bc-sep">›</span>
    <span class="bc-current">{{ $product->title }}</span>
  </div>
</div>

<!-- MAIN PRODUCT -->
<div class="product-section">
  <div class="cover-col">
    <div class="cover-main">
      @if($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" style="{{ !$product->available ? 'filter:grayscale(.8);opacity:.6;' : '' }}">
      @else
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;padding:40px;text-align:center;{{ !$product->available ? 'filter:grayscale(.8);opacity:.6;' : '' }}">
          <div>
            <div style="font-family:'Amiri',serif;font-size:24px;font-weight:700;color:var(--gold-light);line-height:1.5;margin-bottom:12px;">{{ $product->title }}</div>
            @if($product->author)
            <div style="font-family:'Amiri',serif;font-size:14px;color:rgba(232,213,163,.7);">{{ $product->author }}</div>
            @endif
          </div>
        </div>
      @endif
      @if(!$product->available)
        <span class="cover-badge" style="background:#666;">غير متاح</span>
      @endif
    </div>
  </div>

  <div class="info-col">
    <div class="book-category-tag">{{ $product->category->name ?? '' }}</div>
    <h1 class="book-main-title">{{ $product->title }}</h1>
    @if($product->author)
    <div class="author-row">
      <div class="author-avatar"></div>
      <div class="author-info">
        <div class="label">المؤلف</div>
        <div class="name">{{ $product->author }}</div>
      </div>
    </div>
    @endif
<!-- DESCRIPTION -->
@if($product->description)
<div class="description-section">
  <div class="section-header">
    <div class="section-title">الوصف</div>
    <div class="divider"></div>
  </div>
  <div class="desc-text">
    <p>{{ $product->description }}</p>
  </div>
</div>
@endif
    <div class="price-block">
      <div class="price-label">السعر</div>
      <div class="price-current">{{ number_format($product->price, 0) }} <span style="font-size:18px;font-weight:400;">دج</span></div>
      <div class="price-note">السعر يشمل التغليف • التوصيل يُحسب عند الطلب</div>
    </div>

    @if(!$product->available)
      <div class="product-unavailable-msg">هذا المنتج غير متاح حالياً</div>
    @else
    <div class="buy-row">
      <div class="qty-control">
        <button class="qty-btn" onclick="changeQty(-1)">−</button>
        <input class="qty-input" type="number" value="1" min="1" max="99" id="qtyInput" readonly />
        <button class="qty-btn" onclick="changeQty(1)">+</button>
      </div>
      <button class="btn-add-cart" id="addCartBtn" onclick="addToCart({{ $product->id }}, '{{ addslashes($product->title) }}', {{ $product->price }}, '{{ $product->image_path }}')">
        أضف إلى السلة
      </button>
    </div>

    <button class="btn-order-wa" onclick="orderWhatsApp()">
      إتمام الطلب
    </button>
    @endif

    <div class="trust-row">
      <div class="trust-badge"><span class="icon"></span> توصيل لجل  الولايات</div>
      <div class="trust-badge"><span class="icon"></span> كتاب أصلي مضمون</div>
    </div>
  </div>
</div>



<!-- SIMILAR PRODUCTS -->
@if($similarProducts->count() > 0)
<div class="related-section">
  <div class="related-inner">
    <div class="section-header">
      <div class="section-title">كتب مشابهة</div>
      <div class="divider"></div>
    </div>
    <div class="related-grid">
      @foreach($similarProducts as $related)
      <div class="book-card {{ !$related->available ? 'product-unavailable' : '' }}" onclick="window.location.href='{{ route('products.show', $related->id) }}'">
        <div class="book-cover-sm">
          @if($related->image_path)
            <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}" style="{{ !$related->available ? 'filter:grayscale(.8);opacity:.6;' : '' }}">
          @endif
          @if(!$related->available)
            <span class="unavailable-badge-sm">غير متاح</span>
          @endif
        </div>
        <div class="book-card-info">
          <div class="book-card-cat">{{ $related->category->name ?? '' }}</div>
          <div class="book-card-title">{{ $related->title }}</div>
          @if($related->author)
          <div class="book-card-author">{{ $related->author }}</div>
          @endif
          <div class="book-card-footer">
            <div class="book-card-price">{{ number_format($related->price, 0) }} دج</div>
            @if($related->available)
            <button class="btn-add-sm" onclick="event.stopPropagation();addToCartBtn(this, {{ $related->id }}, '{{ addslashes($related->title) }}', {{ $related->price }}, '{{ $related->image_path }}')">+</button>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif



<script>
function changeQty(delta) {
  const input = document.getElementById('qtyInput');
  let val = parseInt(input.value) + delta;
  input.value = Math.max(1, Math.min(99, val));
  updatePrice();
}

function updatePrice() {
  const qty = parseInt(document.getElementById('qtyInput').value);
  const priceEl = document.getElementById('priceDisplay');
  const basePrice = parseFloat(priceEl.dataset.basePrice);
  const total = basePrice * qty;
  priceEl.innerHTML = total.toLocaleString() + ' <span style="font-size:18px;font-weight:400;">دج</span>';
}

function addToCart(id, title, price, image) {
  const qty = parseInt(document.getElementById('qtyInput').value);
  const idx = cart.findIndex(i => i.id === id);
  if (idx > -1) {
    cart[idx].qty += qty;
  } else {
    cart.push({ id, title, price, qty, image });
  }
  saveCart();
  const btn = document.getElementById('addCartBtn');
  btn.textContent = 'تمت الإضافة!';
  btn.classList.add('added');
  showToast('تمت إضافة ' + qty + ' نسخة');
  setTimeout(() => {
    btn.innerHTML = 'أضف إلى السلة';
    btn.classList.remove('added');
  }, 2000);
}

function orderWhatsApp() {
  const qty = parseInt(document.getElementById('qtyInput')?.value || 1);
  const cartData = JSON.stringify([{
    id: {{ $product->id }},
    title: '{{ addslashes($product->title) }}',
    price: {{ $product->price }},
    qty: qty,
    image: '{{ $product->image_path }}'
  }]);
  const encoded = btoa(cartData);
  window.location.href = '{{ route('checkout.index') }}?cart=' + encodeURIComponent(encoded);
}
</script>

@endsection
