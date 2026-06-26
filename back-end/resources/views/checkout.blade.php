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
        @foreach($cart as $item)
        <div class="cart-item-row">
            <div class="item-img">
                @if($item['image'])
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}">
                @endif
            </div>
            <div class="item-info">
                <div class="item-title">{{ $item['title'] }}</div>
                <div class="item-qty-price">{{ $item['qty'] }} × {{ number_format($item['price'], 0) }} دج</div>
            </div>
            <div class="item-total">{{ number_format($item['price'] * $item['qty'], 0) }} دج</div>
        </div>
        @endforeach
        <div class="subtotal-row">
            <span>المجموع الفرعي</span>
            <span>{{ number_format($subtotal, 0) }} دج</span>
        </div>
    </div>

    <!-- Delivery & Customer Info -->
    <form id="checkoutForm" method="POST" action="{{ route('checkout.submit') }}">
        @csrf
        <input type="hidden" name="cart_data" value='{{ $cartJson }}'>

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
                        <div class="label">تسليم في المحطة</div>
                        <div class="price" id="stopdeskPriceLabel">— دج</div>
                    </div>
                </div>
                <input type="hidden" name="delivery_type" id="deliveryType" value="home">
                <div class="error-msg" id="deliveryError">الرجاء اختيار نوع التوصيل</div>
            </div>

            <div class="price-display">
                <div class="row">
                    <span>المجموع الفرعي للكتب</span>
                    <span id="displaySubtotal">{{ number_format($subtotal, 0) }} دج</span>
                </div>
                <div class="row">
                    <span>سعر التوصيل</span>
                    <span id="displayDelivery">— دج</span>
                </div>
                <div class="row total">
                    <span>المجموع الكلي</span>
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
                <input type="tel" name="phone" class="form-control" required placeholder="مثال: 0555123456">
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
function selectDeliveryType(el) {
    document.querySelectorAll('.delivery-option').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('deliveryType').value = el.dataset.type;
    updateDeliveryPrice();
}

function updateDeliveryPrice() {
    const select = document.getElementById('wilayaSelect');
    const option = select.options[select.selectedIndex];
    const deliveryType = document.getElementById('deliveryType').value;

    if (!option.value) {
        document.getElementById('displayDelivery').textContent = '— دج';
        document.getElementById('displayTotal').textContent = document.getElementById('displaySubtotal').textContent;
        document.getElementById('homePriceLabel').textContent = '— دج';
        document.getElementById('stopdeskPriceLabel').textContent = '— دج';
        return;
    }

    const homePrice = parseFloat(option.dataset.home);
    const stopdeskPrice = parseFloat(option.dataset.stopdesk);
    const price = deliveryType === 'home' ? homePrice : stopdeskPrice;

    document.getElementById('homePriceLabel').textContent = homePrice + ' دج';
    document.getElementById('stopdeskPriceLabel').textContent = stopdeskPrice + ' دج';
    document.getElementById('displayDelivery').textContent = price + ' دج';

    const subtotal = {{ $subtotal }};
    const total = subtotal + price;
    document.getElementById('displayTotal').textContent = total.toLocaleString() + ' دج';
}

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
    if (!phone) {
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
