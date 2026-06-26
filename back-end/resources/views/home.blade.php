@extends('layouts.app')
@section('title', 'jass.books للكتب الشرعية')

@section('content')

<!-- HERO -->
<section class="hero" style="position:relative;overflow:hidden;min-height:580px;display:flex;align-items:center;">
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,var(--deep) 0%,var(--crimson) 55%,#a0002a 100%);"></div>
  <div style="position:absolute;inset:0;opacity:.07;background-image:url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);"></div>
  <div style="position:absolute;left:-60px;top:-60px;width:400px;height:400px;border-radius:50%;border:80px solid rgba(200,168,75,.12);pointer-events:none;"></div>
  <div style="position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:80px 24px;display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">
    <div>
      <span style="display:inline-block;background:rgba(200,168,75,.2);border:1px solid rgba(200,168,75,.5);color:var(--gold-light);border-radius:30px;padding:5px 16px;font-size:12px;font-weight:600;margin-bottom:20px;"> jass.books للكتب الشرعية</span>
      <h1 style="font-family:'Amiri',serif;font-size:clamp(32px,4vw,56px);font-weight:700;color:#fff;line-height:1.35;margin-bottom:16px;">هنا حيث<br>الكُتُب<br>تجد طريقها إليك</h1>
      <p style="color:rgba(255,255,255,.75);font-size:16px;line-height:1.8;margin-bottom:32px;">
        "jass.books" متجركم لبيع الكتب الشرعية، نقدم أفضل المؤلفات للأئمة والعلماء.<br>
        التوصيل داخل الجزائر فقط 🇩🇿
      </p>
      <div style="display:flex;gap:14px;flex-wrap:wrap;">
        <a href="#featured" style="background:var(--gold);color:var(--ink);padding:14px 32px;border-radius:6px;font-family:'Cairo',sans-serif;font-size:15px;font-weight:700;text-decoration:none;box-shadow:0 4px 20px rgba(200,168,75,.4);"> تسوق الآن</a>
        <a href="#categories" style="background:transparent;color:#fff;padding:14px 32px;border-radius:6px;border:2px solid rgba(255,255,255,.4);font-family:'Cairo',sans-serif;font-size:15px;font-weight:700;text-decoration:none;"> التصنيفات</a>
      </div>
      <div style="display:flex;gap:32px;margin-top:40px;padding-top:32px;border-top:1px solid rgba(255,255,255,.15);">
        <div style="text-align:center;"><div style="font-size:28px;font-weight:900;color:var(--gold);line-height:1;">+{{ $products->count() }}</div><div style="font-size:12px;color:rgba(255,255,255,.6);margin-top:4px;">كتاب متوفر</div></div>
        <div style="text-align:center;"><div style="font-size:28px;font-weight:900;color:var(--gold);line-height:1;">{{ $categories->count() }}</div><div style="font-size:12px;color:rgba(255,255,255,.6);margin-top:4px;">تصنيف</div></div>
      </div>
    </div>
    <div style="display:flex;align-items:center;justify-content:center;">
      <div style="position:relative;width:300px;height:340px;">
        <div style="position:absolute;border-radius:4px 8px 8px 4px;box-shadow:4px 4px 20px rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;font-family:'Amiri',serif;font-weight:700;writing-mode:vertical-rl;text-orientation:mixed;letter-spacing:2px;width:52px;height:240px;background:#2c1810;color:var(--gold);left:30px;top:50px;transform:rotate(-5deg);font-size:14px;">إغاثة اللهفان</div>
        <div style="position:absolute;border-radius:4px 8px 8px 4px;box-shadow:4px 4px 20px rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;font-family:'Amiri',serif;font-weight:700;writing-mode:vertical-rl;text-orientation:mixed;letter-spacing:2px;width:48px;height:280px;background:#5a0016;color:#e8d5a3;left:90px;top:20px;font-size:12px;">الداء والدواء</div>
        <div style="position:absolute;border-radius:4px 8px 8px 4px;box-shadow:4px 4px 20px rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;font-family:'Amiri',serif;font-weight:700;writing-mode:vertical-rl;text-orientation:mixed;letter-spacing:2px;width:54px;height:260px;background:#800020;color:#fff;left:146px;top:40px;transform:rotate(3deg);font-size:13px;">مدارج السالكين</div>
        <div style="position:absolute;border-radius:4px 8px 8px 4px;box-shadow:4px 4px 20px rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;font-family:'Amiri',serif;font-weight:700;writing-mode:vertical-rl;text-orientation:mixed;letter-spacing:2px;width:50px;height:220px;background:#c8a84b;color:var(--ink);left:206px;top:60px;transform:rotate(-2deg);font-size:12px;">زاد المعاد</div>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<div style="background:var(--gold);overflow:hidden;white-space:nowrap;padding:10px 0;">
  <div style="display:inline-flex;gap:40px;animation:marqueeRTL 25s linear infinite;">
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> توصيل لجل  ولايات الجزائر</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> كتب ابن القيم رحمه الله</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> كتب ابن تيمية رحمه الله</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> أسعار تنافسية</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> جودة مضمونة</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> توصيل لجل  ولايات الجزائر</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> كتب ابن القيم رحمه الله</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> كتب ابن تيمية رحمه الله</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> أسعار تنافسية</span>
    <span style="font-size:13px;font-weight:700;color:var(--ink);display:inline-flex;align-items:center;gap:10px;"><span style="width:6px;height:6px;background:var(--crimson);border-radius:50%;"></span> جودة مضمونة</span>
  </div>
</div>

<!-- CATEGORIES -->
<div style="background:var(--parchment);" id="categories">
  <div style="max-width:1280px;margin:0 auto;padding:80px 24px;">
    <div style="text-align:center;margin-bottom:56px;" class="fade-in">
      <span style="display:inline-block;color:var(--crimson);font-size:13px;font-weight:700;letter-spacing:2px;margin-bottom:12px;">تصفح حسب الفئة</span>
      <div style="width:60px;height:3px;background:linear-gradient(90deg,var(--gold),var(--crimson));margin:20px auto 0;border-radius:2px;"></div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:24px;">
      @foreach($categories as $cat)
      <a href="{{ route('home') }}#featured" style="text-decoration:none;">
        <div style="position:relative;overflow:hidden;border-radius:12px;aspect-ratio:3/4;cursor:pointer;box-shadow:0 4px 20px rgba(36,27,12,.15);transition:transform .5s cubic-bezier(.22,.68,0,1.2),opacity .5s ease,box-shadow .3s;transform:translateY(40px);opacity:0;" class="cat-card" data-delay="{{ $loop->index * 100 }}" onmouseover="this.style.boxShadow='0 12px 40px rgba(36,27,12,.3)'" onmouseout="this.style.boxShadow='0 4px 20px rgba(36,27,12,.15)'">
          @if($cat->image_path)
            <img src="{{ asset('storage/' . $cat->image_path) }}" alt="{{ $cat->name }}" style="width:100%;height:100%;object-fit:cover;filter:brightness(.7);transition:transform .5s ease;" onmouseover="this.style.transform='scale(1.07)';this.style.filter='brightness(.5)'" onmouseout="this.style.transform='scale(1)';this.style.filter='brightness(.7)'">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--deep),var(--crimson));display:flex;align-items:center;justify-content:center;font-size:48px;"></div>
          @endif
          <div style="position:absolute;inset:0;background:linear-gradient(to top,var(--deep) 0%,rgba(90,0,22,.4) 50%,transparent 100%);"></div>
          <div style="position:absolute;bottom:0;left:0;right:0;padding:20px 16px;">
            <div style="font-family:'Amiri',serif;font-size:18px;font-weight:700;color:#fff;line-height:1.3;">{{ $cat->name }}</div>
            <div style="font-size:12px;color:var(--gold-light);margin-top:4px;opacity:0;transform:translateY(6px);transition:opacity .3s .05s,transform .3s .05s;" class="cat-count">{{ $cat->products_count }} منتج</div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

<!-- FEATURED BOOKS -->
<div id="featured">
  <div style="max-width:1280px;margin:0 auto;padding:80px 24px;">
    <div style="text-align:center;margin-bottom:56px;" class="fade-in">
      <span style="display:inline-block;color:var(--crimson);font-size:13px;font-weight:700;letter-spacing:2px;margin-bottom:12px;">أبرز الإصدارات</span>
      <h2 style="font-family:'Amiri',serif;font-size:clamp(26px,3vw,40px);color:var(--ink);font-weight:700;line-height:1.35;">اختر ما يناسبك من <span style="color:var(--crimson);">الكتب الشرعية</span></h2>
      <div style="width:60px;height:3px;background:linear-gradient(90deg,var(--gold),var(--crimson));margin:20px auto 0;border-radius:2px;"></div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:28px;">
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
      <div style="text-align:center;padding:60px 20px;color:var(--warm-gray);">لا توجد كتب متاحة حالياً</div>
      @endforelse
    </div>
  </div>
</div>

<!-- DELIVERY -->
<div style="background:var(--ink);padding:60px 0;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:40px;text-align:center;">
      <div class="fade-in">
        <div style="width:60px;height:60px;background:rgba(200,168,75,.15);border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:26px;border:1px solid rgba(200,168,75,.3);"><i class="fa-regular fa-box"></i></div>
        <div style="font-size:16px;font-weight:700;color:#fff;margin-bottom:6px;">توصيل لجل  الولايات</div>
        <div style="font-size:13px;color:rgba(255,255,255,.5);">نغطي  جل ولايات الجزائر الـ 55 بكل سهولة ويسر</div>
      </div>
      <div class="fade-in">
        <div style="width:60px;height:60px;background:rgba(200,168,75,.15);border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:26px;border:1px solid rgba(200,168,75,.3);"><i class="fa-solid fa-book"></i></div>
        <div style="font-size:16px;font-weight:700;color:#fff;margin-bottom:6px;">كتب أصيلة مضمونة</div>
        <div style="font-size:13px;color:rgba(255,255,255,.5);"> جل الكتب من دور نشر موثوقة وبجودة عالية</div>
      </div>
      <div class="fade-in">
        <div style="width:60px;height:60px;background:rgba(200,168,75,.15);border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:26px;border:1px solid rgba(200,168,75,.3);"><i class="fa-solid fa-headset"></i></div>
        <div style="font-size:16px;font-weight:700;color:#fff;margin-bottom:6px;">دعم على مدار الساعة</div>
        <div style="font-size:13px;color:rgba(255,255,255,.5);">تواصل معنا عبر إنستغرام في أي وقت</div>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes marqueeRTL {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.cat-card { transition: transform .5s cubic-bezier(.22,.68,0,1.2), opacity .5s ease, box-shadow .3s; }
.cat-card.visible { transform: translateY(0); opacity: 1; }
.cat-card:hover .cat-count { opacity: 1; transform: translateY(0); }
.product-unavailable { opacity: .55; filter: grayscale(.7); pointer-events: none; }
.product-unavailable .btn-add { display: none; }
.unavailable-badge { position: absolute; top: 10px; right: 10px; background: #666; color: #fff; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; z-index: 2; }
</style>

<script>
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add('visible');
  });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

const catObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), parseInt(entry.target.dataset.delay) || 0);
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.cat-card').forEach(el => catObserver.observe(el));
</script>

@endsection