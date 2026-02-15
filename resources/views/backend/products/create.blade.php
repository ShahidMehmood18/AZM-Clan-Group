@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Create Product</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item">Create</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">Price</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                        name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id"
                                        name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                        id="short_description" name="short_description"
                                        rows="3">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        id="thumbnail" name="thumbnail" required>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gallery Images</label>
                                    <div id="images-container">
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" name="images[]">
                                            <button type="button" class="btn btn-danger remove-image"
                                                style="display:none;">&times;</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success mt-2" id="add-image">
                                        <i class="feather-plus"></i> Add Another Image
                                    </button>
                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            checked>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_trending" name="is_trending">
                                        <label class="form-check-label" for="is_trending">Trending (Welcome Page)</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_hot" name="is_hot">
                                        <label class="form-check-label" for="is_hot">Hot Item (Product Slider)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="table-actions">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('images-container');
        const addButton = document.getElementById('add-image');

        addButton.addEventListener('click', function () {
            const newItem = document.createElement('div');
            newItem.className = 'input-group mb-2';
            newItem.innerHTML = `
                <input type="file" class="form-control" name="images[]">
                <button type="button" class="btn btn-danger remove-image">&times;</button>
            `;
            container.appendChild(newItem);
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-image')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>