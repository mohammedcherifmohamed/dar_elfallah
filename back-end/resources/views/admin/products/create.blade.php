@extends('admin.layouts.app')
@section('title', 'إضافة منتج جديد')

@section('content')
<div class="card" style="max-width: 700px;">
    <div class="card-header">إضافة منتج جديد</div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">التصنيف <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select" required>
                    <option value="">اختر التصنيف</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">عنوان الكتاب <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">المؤلف</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}" placeholder="يمكن تركه فارغاً">
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">السعر (دج) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" min="0" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">صورة الكتاب</label>
                    <input type="file" name="image_path" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="available" value="1" class="form-check-input" id="available" checked>
                <label class="form-check-label" for="available">الكتاب متاح للبيع</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-crimson"><i class="fas fa-save ms-1"></i> حفظ</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
