@extends('admin.layouts.app')
@section('title', 'تعديل التصنيف')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">تعديل التصنيف: {{ $category->name }}</div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">اسم التصنيف <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">صورة التصنيف</label>
                @if($category->image_path)
                    <div class="mb-2"><img src="{{ asset('storage/' . $category->image_path) }}" style="width: 100px; height: 130px; object-fit: cover; border-radius: 8px;"></div>
                @endif
                <input type="file" name="image_path" class="form-control" accept="image/*">
                <small class="text-muted">اتركه فارغاً إن لم ترد التغيير</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-crimson"><i class="fas fa-save ms-1"></i> تحديث</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
