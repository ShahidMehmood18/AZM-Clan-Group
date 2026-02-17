@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Products</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="feather-plus me-2"></i> Create Product
            </a>
        </div>
    </div>

    <div class="main-content">
        @include('components.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="table-layout: fixed; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">Thumbnail</th>
                                        <th>Name</th>
                                        <th style="width: 130px;">Category</th>
                                        <th style="width: 120px;">Brand</th>
                                        <th style="width: 90px;">Price</th>
                                        <th style="width: 140px;">Status</th>
                                        <th style="width: 100px;" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ product_image_url($product->thumbnail, 'https://via.placeholder.com/50x50') }}"
                                                    alt="{{ $product->name }}" width="70" class="rounded">
                                            </td>
                                            <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $product->name }}">{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand ? $product->brand->name : '-' }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if($product->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                                @if($product->is_trending)
                                                    <span class="badge bg-info">Trending</span>
                                                @endif
                                                @if($product->is_hot)
                                                    <span class="badge bg-warning">Hot</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.products.edit', $product) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "paging": false,
                "info": false,
                "searching": false
            });
        });
    </script>
@endpush