@extends('layouts.app')
@section('title', 'إتمام الطلب - jass.books')

@push('styles')
<style>
.checkout-section { max-width: 900px; margin: 0 auto; padding: 40px 24px 80px; }
.checkout-header { text-align: center; margin-bottom: 40px; }
.checkout-header h1 { font-family: 'Amiri', serif; font-size: 32px; color: var(--ink); margin-bottom: 8px; }
.checkout-header p { color: var(--warm-gray); font-size: 14px; }

.order-summary { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(36,27,12,.08); padding: 24px; margin-bottom: 24px; }
.order-summary h3 { font-size: 18px; font-weight: 700; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #eee; }
.cart-item-row { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f5f0e8; }
.cart-item-row:last-child { border-bottom: none; }
.cart-item-row .item-img { width: 40px; height: 52px; border-radius: 6px; background: var(--parchment); overflow: hidden; flex-shrink: 0; }
.cart-item-row .item-img img { width: 100%; height: 100%; object-fit: cover; }
.cart-item-row .item-info { flex: 1; }
.cart-item-row .item-title { font-size: 14px; font-weight: 700; }
.cart-item-row .item-qty-price { font-size: 13px; color: var(--warm-gray); }
.cart-item-row .item-total { font-size: 15px; font-weight: 700; color: var(--crimson); }
.cart-item-row .qty-controls { display: flex; align-items: center; gap: 4px; }
.cart-item-row .qty-controls button { width: 26px; height: 26px; border-radius: 50%; border: 1px solid #ddd; background: #fff; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; transition: all .15s; }
.cart-item-row .qty-controls button:hover { border-color: var(--crimson); color: var(--crimson); }
.cart-item-row .qty-controls .qty-val { min-width: 20px; text-align: center; font-weight: 700; font-size: 14px; }

.subtotal-row { display: flex; justify-content: space-between; padding: 12px 0; font-weight: 700; font-size: 16px; border-top: 1px solid #eee; margin-top: 8px; }

.delivery-section { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(36,27,12,.08); padding: 24px; margin-bottom: 24px; }
.delivery-section h3 { font-size: 18px; font-weight: 700; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #eee; }

.form-group { margin-bottom: 16px; }
.form-group label { display: block; font-size: 14px; font-weight: 700; margin-bottom: 6px; color: var(--ink); }
.form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #e0d6c8; border-radius: 8px; font-family: 'Cairo', sans-serif; font-size: 14px; outline: none; transition: border-color .2s; background: #fff; }
.form-control:focus { border-color: var(--crimson); box-shadow: 0 0 0 3px rgba(128,0,32,.1); }
.form-control.error { border-color: var(--crimson); }
textarea.form-control { resize: vertical; min-height: 80px; }

.delivery-type { display: flex; gap: 12px; margin-bottom: 16px; }
.delivery-option { flex: 1; padding: 16px; border: 2px solid #e0d6c8; border-radius: 10px; cursor: pointer; text-align: center; transition: all .2s; }
.delivery-option:hover { border-color: var(--gold); }
.delivery-option.selected { border-color: var(--crimson); background: rgba(128,0,32,.04); }
.delivery-option .icon { font-size: 24px; display: block; margin-bottom: 6px; }
.delivery-option .label { font-size: 14px; font-weight: 700; }
.delivery-option .price { font-size: 12px; color: var(--warm-gray); margin-top: 4px; }

.price-display { background: var(--parchment); border-radius: 10px; padding: 16px 20px; margin-top: 12px; }
.price-display .row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
.price-display .row.total { border-top: 2px solid var(--gold); padding-top: 12px; margin-top: 8px; font-size: 18px; font-weight: 900; color: var(--crimson); }

.btn-submit { width: 100%; padding: 16px; background: #25d366; color: #fff; border: none; border-radius: 10px; font-family: 'Cairo', sans-serif; font-size: 18px; font-weight: 700; cursor: pointer; transition: all .25s; display: flex; align-items: center; justify-content: center; gap: 10px; }
.btn-submit:hover { background: #128c7e; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(18,140,126,.3); }
.btn-submit:disabled { opacity: .5; cursor: not-allowed; transform: none; box-shadow: none; }

.error-msg { color: var(--crimson); font-size: 13px; margin-top: 4px; display: none; }
.error-msg.show { display: block; }
.stopdesk-card:hover { border-color: var(--gold) !important; }
@media (max-width: 600px) { #stopdeskList { grid-template-columns: 1fr !important; } }
</style>
@endpush

@section('content')
<div class="checkout-section">
    <div class="checkout-header">
        <h1>إتمام الطلب</h1>
        <p>يرجى مراجعة طلبك واختيار طريقة التوصيل</p>
    </div>

    <!-- Order Summary -->
    <div class="order-summary">
        <h3> ملخص الطلب</h3>
        <div id="checkoutItems"></div>
        <div class="subtotal-row">
            <span>المجموع  الكلي</span>
            <span id="checkoutSubtotal">{{ number_format($subtotal, 0) }} دج</span>
        </div>
    </div>

    <!-- Delivery & Customer Info -->
    <form id="checkoutForm" method="POST" action="{{ route('checkout.submit') }}">
        @csrf
        <input type="hidden" name="cart_data" id="cartDataInput" value='{{ $cartJson }}'>

        <div class="delivery-section">
            <h3> معلومات التوصيل</h3>

            <div class="form-group">
                <label>الولاية <span class="text-danger">*</span></label>
                <select name="wilaya_id" id="wilayaSelect" class="form-control" required onchange="updateDeliveryPrice()">
                    <option value="">-- اختر الولاية --</option>
                    @foreach($wilayas as $w)
                        <option value="{{ $w->id }}" data-home="{{ $w->home_delivery_price }}" data-stopdesk="{{ $w->stopdesk_price }}">{{ $w->name }}</option>
                    @endforeach
                </select>
                <div class="error-msg" id="wilayaError">الرجاء اختيار الولاية</div>
            </div>

            <div class="form-group">
                <label>نوع التوصيل <span class="text-danger">*</span></label>
                <div class="delivery-type">
                    <div class="delivery-option selected" data-type="home" onclick="selectDeliveryType(this)">
                        <span class="icon"></span>
                        <div class="label">توصيل إلى المنزل</div>
                        <div class="price" id="homePriceLabel">— دج</div>
                    </div>
                    <div class="delivery-option" data-type="stopdesk" onclick="selectDeliveryType(this)">
                        <span class="icon"></span>
                        <div class="label">تسليم في المكتب</div>
                        <div class="price" id="stopdeskPriceLabel">— دج</div>
                    </div>
                </div>
                <input type="hidden" name="delivery_type" id="deliveryType" value="home">
                <div class="error-msg" id="deliveryError">الرجاء اختيار نوع التوصيل</div>
            </div>

            <div id="stopdeskSection" style="display:none;">
                <label style="display:block;font-size:14px;font-weight:700;margin-bottom:10px;color:var(--ink);">المكاتب المتوفره في هذه الولايه</label>
                <div id="stopdeskList" style="display:grid;grid-template-columns:1fr 1fr;gap:10px;"></div>
                <input type="hidden" name="stopdesk_id" id="stopdeskId">
                <div class="error-msg" id="stopdeskError">الرجاء اختيار مكتب التسليم</div>
            </div>

            <div class="price-display">
                <div class="row">
                    <span>المجموع  الكلي للكتب</span>
                    <span id="displaySubtotal">{{ number_format($subtotal, 0) }} دج</span>
                </div>
                <div class="row">
                    <span>سعر التوصيل</span>
                    <span id="displayDelivery">— دج</span>
                </div>
                <div class="row total">
                    <span>اجمالي الدفع</span>
                    <span id="displayTotal">{{ number_format($subtotal, 0) }} دج</span>
                </div>
            </div>
        </div>

        <div class="delivery-section">
            <h3> معلومات العميل</h3>

            <div class="form-group">
                <label>الاسم الكامل <span class="text-danger">*</span></label>
                <input type="text" name="full_name" class="form-control" required placeholder="أدخل اسمك الكامل">
                <div class="error-msg" id="nameError">الاسم الكامل مطلوب</div>
            </div>

            <div class="form-group">
                <label>رقم الهاتف <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control" required placeholder="10 أرقام: 0555123456" oninput="validatePhone(this)" onkeypress="return /^\d$/.test(event.key)">
                <div class="error-msg" id="phoneError">رقم الهاتف مطلوب</div>
            </div>

            <div class="form-group">
                <label>ملاحظة (اختياري)</label>
                <textarea name="note" class="form-control" placeholder="أي ملاحظة إضافية..."></textarea>
            </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
            إرسال الطلب عبر واتساب
        </button>
    </form>
</div>

<script>
let checkoutCart = {!! $cartJson !!};
let stopdesksData = @json($stopdesks);

function renderCheckoutItems() {
    const container = document.getElementById('checkoutItems');
    const storageUrl = '{{ asset('storage') }}';
    let html = '';
    checkoutCart.forEach((item, idx) => {
        const lineTotal = item.price * item.qty;
        const imgHtml = item.image ? `<img src="${storageUrl}/${item.image}" alt="${item.title}">` : '';
        html += `<div class="cart-item-row">
            <div class="item-img">${imgHtml}</div>
            <div class="item-info">
                <div class="item-title">${item.title}</div>
                <div class="item-qty-price">${item.price.toLocaleString()} دج للنسخة</div>
            </div>
            <div class="qty-controls">
                <button onclick="checkoutQty(${idx},-1)">−</button>
                <span class="qty-val" id="cqty-${idx}">${item.qty}</span>
                <button onclick="checkoutQty(${idx},1)">+</button>
            </div>
            <div class="item-total" id="ctotal-${idx}">${lineTotal.toLocaleString()} دج</div>
            <button onclick="checkoutRemove(${idx})" style="background:none;border:none;cursor:pointer;color:#ccc;font-size:16px;padding:4px;flex-shrink:0;" title="حذف">✕</button>
        </div>`;
    });
    container.innerHTML = html;
}

function checkoutRemove(idx) {
    checkoutCart.splice(idx, 1);
    if (!checkoutCart.length) {
        window.location.href = '{{ route('home') }}';
        return;
    }
function validatePhone(el) {
    const err = document.getElementById('phoneError');
    const v = el.value.trim();
    if (!v) {
        err.textContent = 'رقم الهاتف مطلوب';
        err.classList.add('show');
    } else if (v.length < 10) {
        err.textContent = 'تبقى ' + (10 - v.length) + ' أرقام';
        err.classList.add('show');
    } else if (!/^\d{10}$/.test(v)) {
        err.textContent = 'رقم الهاتف يجب أن يتكون من 10 أرقام';
        err.classList.add('show');
    } else {
        err.classList.remove('show');
    }
}

renderCheckoutItems();
    updateCheckoutSummary();
}

function checkoutQty(idx, delta) {
    checkoutCart[idx].qty = Math.max(1, checkoutCart[idx].qty + delta);
    document.getElementById('cqty-' + idx).textContent = checkoutCart[idx].qty;
    const lineTotal = checkoutCart[idx].price * checkoutCart[idx].qty;
    document.getElementById('ctotal-' + idx).textContent = lineTotal.toLocaleString() + ' دج';
    updateCheckoutSummary();
}

function updateCheckoutSummary() {
    const subtotal = checkoutCart.reduce((s, i) => s + i.price * i.qty, 0);
    document.getElementById('checkoutSubtotal').textContent = subtotal.toLocaleString() + ' دج';
    document.getElementById('displaySubtotal').textContent = subtotal.toLocaleString() + ' دج';
    document.getElementById('cartDataInput').value = JSON.stringify(checkoutCart);
    updateDeliveryPrice();
}

function selectDeliveryType(el) {
    document.querySelectorAll('.delivery-option').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('deliveryType').value = el.dataset.type;
    updateDeliveryPrice();
    renderStopdesks();
}

function renderStopdesks() {
    const section = document.getElementById('stopdeskSection');
    const list = document.getElementById('stopdeskList');
    const wilayaId = document.getElementById('wilayaSelect').value;
    const deliveryType = document.getElementById('deliveryType').value;

    if (deliveryType !== 'stopdesk' || !wilayaId) {
        section.style.display = 'none';
        document.getElementById('stopdeskId').value = '';
        return;
    }

    const desks = stopdesksData[wilayaId] || [];
    if (!desks.length) {
        section.style.display = 'none';
        document.getElementById('stopdeskId').value = '';
        return;
    }

    section.style.display = 'block';
    let html = '';
    desks.forEach((d, i) => {
        const mapsIcon = d.maps_link ? `<a href="${d.maps_link}" target="_blank" style="color:var(--crimson);font-size:12px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;margin-top:4px;">عرض على الخريطة</a>` : '';
        html += `<div class="stopdesk-card" data-id="${d.id}" onclick="selectStopdesk(this, ${d.id})" style="padding:12px;border:2px solid #e0d6c8;border-radius:10px;cursor:pointer;transition:all .2s;">
            <div style="font-weight:700;font-size:14px;margin-bottom:4px;">${d.office_name}</div>
            <div style="font-size:12px;color:var(--warm-gray);margin-bottom:2px;">${d.address}</div>
            <div style="font-size:12px;color:var(--warm-gray);margin-bottom:2px;direction:ltr;text-align:right;">${d.phone}</div>
            ${mapsIcon}
        </div>`;
    });
    list.innerHTML = html;
}

function selectStopdesk(el, id) {
    document.querySelectorAll('.stopdesk-card').forEach(c => c.style.borderColor = '#e0d6c8');
    el.style.borderColor = 'var(--crimson)';
    el.style.background = 'rgba(128,0,32,.04)';
    document.getElementById('stopdeskId').value = id;
}

function updateDeliveryPrice() {
    const select = document.getElementById('wilayaSelect');
    const option = select.options[select.selectedIndex];
    const deliveryType = document.getElementById('deliveryType').value;

    if (!option.value) {
        document.getElementById('displayDelivery').textContent = '— دج';
        document.getElementById('homePriceLabel').textContent = '— دج';
        document.getElementById('stopdeskPriceLabel').textContent = '— دج';
        document.getElementById('displayTotal').textContent = document.getElementById('displaySubtotal').textContent;
        renderStopdesks();
        return;
    }

    const homePrice = parseFloat(option.dataset.home);
    const stopdeskPrice = parseFloat(option.dataset.stopdesk);
    const price = deliveryType === 'home' ? homePrice : stopdeskPrice;

    document.getElementById('homePriceLabel').textContent = homePrice + ' دج';
    document.getElementById('stopdeskPriceLabel').textContent = stopdeskPrice + ' دج';
    document.getElementById('displayDelivery').textContent = price + ' دج';

    const subtotal = checkoutCart.reduce((s, i) => s + i.price * i.qty, 0);
    const total = subtotal + price;
    document.getElementById('displayTotal').textContent = total.toLocaleString() + ' دج';
    renderStopdesks();
}

renderCheckoutItems();

document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    let valid = true;

    if (!document.getElementById('wilayaSelect').value) {
        document.getElementById('wilayaError').classList.add('show');
        valid = false;
    } else {
        document.getElementById('wilayaError').classList.remove('show');
    }

    const name = this.querySelector('[name="full_name"]').value.trim();
    if (!name) {
        document.getElementById('nameError').classList.add('show');
        valid = false;
    } else {
        document.getElementById('nameError').classList.remove('show');
    }

    const phone = this.querySelector('[name="phone"]').value.trim();
    if (!phone || !/^\d{10}$/.test(phone)) {
        document.getElementById('phoneError').textContent = phone ? 'رقم الهاتف يجب أن يتكون من 10 أرقام' : 'رقم الهاتف مطلوب';
        document.getElementById('phoneError').classList.add('show');
        valid = false;
    } else {
        document.getElementById('phoneError').classList.remove('show');
    }

    if (!valid) {
        e.preventDefault();
    }
});
</script>
@endsection
