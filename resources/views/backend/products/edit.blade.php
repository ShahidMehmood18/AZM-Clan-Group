@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Product</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                        value="{{ old('price', $product->price) }}">
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
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                            </option>
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
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="short_description" class="form-label">UPC</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                        id="short_description" name="short_description"
                                        rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description"
                                        rows="5">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <div class="mb-2">
                                        @if($product->thumbnail)
                                            <img src="{{ product_image_url($product->thumbnail) }}" alt="Current Thumbnail" width="100"
                                                class="rounded">
                                        @else
                                            <span class="text-muted">No thumbnail uploaded</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        id="thumbnail" name="thumbnail">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gallery Images</label>
                                    @if($product->images && count($product->images) > 0)
                                        <div class="mb-2 d-flex gap-2 flex-wrap" id="existing-images">
                                            @foreach($product->images as $index => $image)
                                                <div class="position-relative" data-image-index="{{ $index }}"
                                                    style="display: inline-block;">
                                                    <img src="{{ product_image_url($image) }}" alt="Gallery Image" width="80" height="80"
                                                        class="rounded" style="object-fit: cover;">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-existing-image"
                                                        data-product-id="{{ $product->id }}" data-image-index="{{ $index }}"
                                                        style="padding: 2px 6px; font-size: 12px; border-radius: 50%; margin: 2px;">
                                                        ×
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div id="images-container">
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" name="images[]">
                                            <button type="button" class="btn btn-danger remove-image"
                                                style="display:none;">&times;</button>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mb-2">Upload new images to append.</small>
                                    <button type="button" class="btn btn-sm btn-success" id="add-image">
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
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_trending" name="is_trending"
                                            {{ $product->is_trending ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_trending">Trending (Welcome Page)</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_hot" name="is_hot" {{ $product->is_hot ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_hot">Hot Item (Product Slider)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="table-actions">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Product</button>
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

            // Add new image input field
            addButton.addEventListener('click', function () {
                const newItem = document.createElement('div');
                newItem.className = 'input-group mb-2';
                newItem.innerHTML = `
                                <input type="file" class="form-control" name="images[]">
                                <button type="button" class="btn btn-danger remove-image">×</button>
                            `;
                container.appendChild(newItem);
            });

            // Remove new image input field
            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-image')) {
                    e.target.closest('.input-group').remove();
                }
            });

            // Delete existing images - using event delegation on document
            document.body.addEventListener('click', function (e) {
                // Check if clicked element or its parent is the delete button
                const deleteButton = e.target.closest('.delete-existing-image');

                if (deleteButton) {
                    e.preventDefault();
                    e.stopPropagation();

                    console.log('Delete button clicked');

                    if (!confirm('Are you sure you want to delete this image?')) {
                        return;
                    }

                    const productId = deleteButton.getAttribute('data-product-id');
                    const imageIndex = deleteButton.getAttribute('data-image-index');
                    const imageContainer = deleteButton.closest('[data-image-index]');

                    console.log('Product ID:', productId, 'Image Index:', imageIndex);
                    console.log('Image Container:', imageContainer);

                    if (!imageContainer) {
                        console.error('Image container not found');
                        alert('Error: Could not find image container');
                        return;
                    }

                    // Disable button during request
                    deleteButton.disabled = true;
                    deleteButton.style.pointerEvents = 'none';
                    const originalHTML = deleteButton.innerHTML;
                    deleteButton.innerHTML = '\u003cspan class=\"spinner-border spinner-border-sm\"\u003e\u003c/span\u003e';

                    console.log('Sending delete request...');

                    // Send AJAX request
                    fetch(`/admin/products/${productId}/images/${imageIndex}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => {
                            console.log('Response received:', response);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success) {
                                console.log('Delete successful, removing from DOM...');

                                // Immediately remove the image from DOM with fade effect
                                imageContainer.style.opacity = '0';
                                imageContainer.style.transition = 'opacity 0.3s ease';

                                setTimeout(() => {
                                    console.log('Removing image container from DOM');
                                    imageContainer.remove();

                                    // Check if there are no more images
                                    const existingImagesContainer = document.getElementById('existing-images');
                                    if (existingImagesContainer && existingImagesContainer.children.length === 0) {
                                        console.log('No more images, removing container');
                                        existingImagesContainer.remove();
                                    }

                                    console.log('Image removed successfully from DOM');
                                }, 300);

                                // Show success message
                                console.log('Image deleted successfully');
                            } else {
                                console.error('Delete failed:', data.message);
                                alert(data.message || 'Failed to delete image');
                                deleteButton.disabled = false;
                                deleteButton.style.pointerEvents = 'auto';
                                deleteButton.innerHTML = originalHTML;
                            }
                        })
                        .catch(error => {
                            console.error('Error during delete:', error);
                            alert('An error occurred while deleting the image. Please check the console for details.');
                            deleteButton.disabled = false;
                            deleteButton.style.pointerEvents = 'auto';
                            deleteButton.innerHTML = originalHTML;
                        });
                }
            });
        });
    </script>
@endpush