@extends('admin.layouts.app')
@section('title', 'المنتجات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">المنتجات</h4>
    <a href="{{ route('admin.products.create') }}" class="btn btn-crimson"><i class="fas fa-plus ms-1"></i> إضافة منتج</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">كل التصنيفات</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="بحث بالعنوان أو المؤلف..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-crimson w-100"><i class="fas fa-search"></i> بحث</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100">إعادة تعيين</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>العنوان</th>
                    <th>التصنيف</th>
                    <th>المؤلف</th>
                    <th>السعر</th>
                    <th>متاح</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="thumb">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->name ?? '—' }}</td>
                    <td>{{ $product->author ?? '—' }}</td>
                    <td>{{ number_format($product->price, 0) }} دج</td>
                    <td>
                        @if($product->available)
                            <span class="badge bg-success">متاح</span>
                        @else
                            <span class="badge bg-danger">غير متاح</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-gold"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">لا توجد منتجات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
