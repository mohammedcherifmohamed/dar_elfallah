@extends('admin.layouts.app')
@section('title', 'إضافة تصنيف جديد')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">إضافة تصنيف جديد</div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">اسم التصنيف <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">صورة التصنيف</label>
                <input type="file" name="image_path" class="form-control" accept="image/*">
                <small class="text-muted">اختياري. يفضل صورة 400×600</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-crimson"><i class="fas fa-save ms-1"></i> حفظ</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
