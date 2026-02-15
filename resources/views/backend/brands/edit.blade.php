@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Edit Brand</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.brands.update', $brand) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $brand->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    @if($brand->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $brand->image) }}" alt="Current Image" width="100"
                                                class="rounded">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                        name="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $brand->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="table-actions">
                                    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection