@extends('admin.layouts.app')
@section('title', 'التصنيفات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">التصنيفات</h4>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-crimson"><i class="fas fa-plus ms-1"></i> إضافة تصنيف</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>الاسم</th>
                    <th>عدد المنتجات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image_path)
                            <img src="{{ asset('storage/' . $category->image_path) }}" class="thumb">
                        @else
                            <span class="text-muted">لا توجد صورة</span>
                        @endif
                    </td>
                    <td>{{ $category->name }}</td>
                    <td><span class="badge bg-secondary">{{ $category->products_count }}</span></td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-gold"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ تحذير: حذف هذا التصنيف سيؤدي إلى حذف {{ $category->products_count }} منتج/منتجات مرتبطة به. هل أنت متأكد؟')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">لا توجد تصنيفات بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
