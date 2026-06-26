@extends('layouts.app')
@section('title', $category->name . ' – jass.books للكتب الشرعية')

@section('content')

<div style="background:var(--parchment);padding:48px 0 12px;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--warm-gray);margin-bottom:32px;">
      <a href="{{ route('home') }}" style="color:var(--warm-gray);text-decoration:none;">الرئيسية</a>
      <span style="font-size:16px;">›</span>
      <span style="color:var(--ink);font-weight:600;">{{ $category->name }}</span>
    </div>
    <div style="text-align:center;margin-bottom:48px;">
      <span style="display:inline-block;color:var(--crimson);font-size:13px;font-weight:700;letter-spacing:2px;margin-bottom:12px;">{{ $category->name }}</span>
      <h1 style="font-family:'Amiri',serif;font-size:clamp(26px,3vw,40px);color:var(--ink);font-weight:700;line-height:1.35;">الكتب المتوفرة في هذا التصنيف</h1>
      <div style="width:60px;height:3px;background:linear-gradient(90deg,var(--gold),var(--crimson));margin:20px auto 0;border-radius:2px;"></div>
    </div>
  </div>
</div>

<div style="max-width:1280px;margin:0 auto;padding:48px 24px 80px;">
  <div class="product-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:28px;">
    @forelse($products as $product)
    <div class="book-card {{ !$product->available ? 'product-unavailable' : '' }}" style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(36,27,12,.08);cursor:pointer;transition:transform .3s ease,box-shadow .3s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 32px rgba(36,27,12,.18)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(36,27,12,.08)'" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
      <div style="position:relative;aspect-ratio:3/4;overflow:hidden;background:linear-gradient(135deg,var(--deep),var(--crimson));">
        @if($product->image_path)
          <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" style="width:100%;height:100%;object-fit:cover;">
        @endif
        @if(!$product->available)
          <span class="unavailable-badge">غير متاح</span>
        @endif
      </div>
      <div style="padding:16px;">
        <div style="font-size:11px;color:var(--crimson);font-weight:700;margin-bottom:6px;">{{ $product->category->name ?? '' }}</div>
        <div style="font-family:'Amiri',serif;font-size:16px;font-weight:700;color:var(--ink);line-height:1.4;margin-bottom:4px;">{{ $product->title }}</div>
        @if($product->author)
        <div style="font-size:12px;color:var(--warm-gray);margin-bottom:12px;">{{ $product->author }}</div>
        @endif
        <div style="display:flex;align-items:center;justify-content:space-between;">
          <div style="font-size:16px;font-weight:700;color:var(--crimson);">{{ number_format($product->price, 0) }} دج</div>
          @if($product->available)
          <button class="btn-add" style="background:var(--crimson);color:#fff;border:none;width:32px;height:32px;border-radius:50%;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;" onmouseover="this.style.background='var(--gold)';this.style.color='var(--ink)';this.style.transform='rotate(90deg)'" onmouseout="this.style.background='var(--crimson)';this.style.color='#fff';this.style.transform='rotate(0)'" onclick="event.stopPropagation();addToCartBtn(this, {{ $product->id }}, '{{ addslashes($product->title) }}', {{ $product->price }}, '{{ $product->image_path }}')">+</button>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:60px 20px;color:var(--warm-gray);grid-column:1/-1;">لا توجد كتب في هذا التصنيف حالياً</div>
    @endforelse
  </div>
</div>

<style>
.book-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(36,27,12,.18); }
.product-unavailable { opacity: .55; filter: grayscale(.7); pointer-events: none; }
.product-unavailable .btn-add { display: none; }
.unavailable-badge { position: absolute; top: 10px; right: 10px; background: #666; color: #fff; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; z-index: 2; }
@media (max-width: 600px) {
  .product-grid { grid-template-columns: repeat(2,1fr) !important; gap: 12px !important; }
}
</style>

@endsection
