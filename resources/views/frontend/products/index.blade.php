@extends('layouts.frontend.app')

@section('title', (isset($category) ? $category->name . ' - ' : (isset($brand) ? $brand->name . ' - ' : 'All Products - ')) . config('app.name'))

@push('styles')
<style>
    /* Sidebar Sticky & Scrollable */
    .shop-sidebar-wrapper {
        position: sticky;
        top: 20px;
    }

    .shop-sidebar .single-widget .categor-list {
        max-height: 280px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .shop-sidebar .single-widget .categor-list::-webkit-scrollbar {
        width: 4px;
    }

    .shop-sidebar .single-widget .categor-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .shop-sidebar .single-widget .categor-list::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .shop-sidebar .single-widget .categor-list::-webkit-scrollbar-thumb:hover {
        background: #F7941D;
    }

    /* Product grid equal height cards */
    .product-grid-row {
        display: flex;
        flex-wrap: wrap;
    }

    .product-grid-row > [class*="col-"] {
        display: flex;
    }

    .product-grid-row .single-product {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .product-grid-row .single-product .product-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-grid-row .single-product .inquiry-btn-wrap {
        margin-top: auto;
    }

    /* Pagination - override theme's display:block with flex for horizontal layout */
    .catalog-pagination {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #eee;
        text-align: center;
    }

    .catalog-pagination nav {
        display: flex;
        justify-content: center;
    }

    .catalog-pagination ul.pagination {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 4px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .catalog-pagination ul.pagination .page-item {
        display: inline-block;
    }

    .catalog-pagination ul.pagination .page-item .page-link {
        display: block;
        background: #F6F7FB;
        color: #666;
        padding: 8px 16px;
        font-weight: 500;
        border: 1px solid #e1e1e1;
        font-size: 14px;
        border-radius: 4px;
        transition: all 0.2s ease;
        line-height: 1.4;
        text-decoration: none;
    }

    .catalog-pagination ul.pagination .page-item.active .page-link,
    .catalog-pagination ul.pagination .page-item .page-link:hover {
        background: #F7941D;
        color: #fff;
        border-color: #F7941D;
    }

    .catalog-pagination ul.pagination .page-item.disabled .page-link {
        background: #f9f9f9;
        color: #ccc;
        border-color: #eee;
        pointer-events: none;
    }

    .catalog-pagination ul.pagination .page-item .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(247, 148, 29, 0.25);
    }

    /* Active filter highlight */
    .categor-list li a.active-filter {
        color: #F7941D !important;
        font-weight: 600 !important;
    }
</style>
@endpush

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            @if(isset($category))
                                <li><a href="{{ route('products.all') }}">Products<i class="ti-arrow-right"></i></a></li>
                                <li class="active"><a href="#">{{ $category->name }}</a></li>
                            @elseif(isset($brand))
                                <li><a href="{{ route('products.all') }}">Products<i class="ti-arrow-right"></i></a></li>
                                <li class="active"><a href="#">{{ $brand->name }}</a></li>
                            @else
                                <li class="active"><a href="#">All Products</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    @include('layouts.frontend.partials.alerts')

    <!-- Product Style -->
    <section class="product-area shop-sidebar {{ $viewMode == 'list' ? 'shop-list' : '' }} shop section">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar-wrapper">
                        <div class="shop-sidebar">
                            <!-- Categories Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Categories</h3>
                                <ul class="categor-list">
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{ route('products.category', $cat->slug) }}"
                                                class="{{ (isset($category) && $category->id == $cat->id) ? 'active-filter' : '' }}">
                                                {{ $cat->name }} <span>({{ $cat->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--/ End Categories Widget -->

                            <!-- Brands Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Brands</h3>
                                <ul class="categor-list">
                                    @foreach($brands as $brandItem)
                                        <li>
                                            <a href="{{ route('products.all', ['brand' => $brandItem->slug] + request()->except(['brand', 'page'])) }}"
                                                class="{{ request('brand') == $brandItem->slug ? 'active-filter' : '' }}">
                                                {{ $brandItem->name }} <span>({{ $brandItem->products_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--/ End Brands Widget -->
                        </div>
                    </div>
                </div>
                <!--/ End Sidebar -->

                <!-- Product Grid -->
                <div class="col-lg-9 col-md-8 col-12">
                    <!-- Shop Top Bar -->
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <select onchange="window.location.href=this.value">
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name</option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    <li class="{{ $viewMode == 'grid' ? 'active' : '' }}">
                                        <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"><i class="fa fa-th-large"></i></a>
                                    </li>
                                    <li class="{{ $viewMode == 'list' ? 'active' : '' }}">
                                        <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"><i class="fa fa-th-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/ End Shop Top Bar -->

                    <!-- Products -->
                    <div class="row product-grid-row">
                        @forelse($products as $product)
                            @if($viewMode == 'grid')
                                <div class="col-lg-4 col-md-6 col-12">
                                    @include('frontend.products.partials.card', ['product' => $product])
                                </div>
                            @else
                                <!-- List View Item -->
                                <div class="col-12">
                                    <div class="single-product list-view-card">
                                        <div class="row w-100 m-0">
                                            <div class="col-lg-4 col-md-4 col-12 p-0">
                                                <div class="product-img">
                                                    <a href="{{ route('products.show', $product->slug) }}">
                                                        <img src="{{ product_image_url($product->thumbnail) }}" alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-12 p-0">
                                                <div class="list-content">
                                                    <div class="product-content">
                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Name</div>
                                                            <div class="detail-value">
                                                                <div style="font-size: 16px; font-weight: 700; color: #333;">
                                                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Category</div>
                                                            <div class="detail-value">{{ $product->category->name }}</div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Brand</div>
                                                            <div class="detail-value">{{ $product->brand ? $product->brand->name : '-' }}</div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Price</div>
                                                            <div class="detail-value">
                                                                <span class="text-orange font-weight-bold" style="font-size: 18px;">
                                                                    ${{ number_format($product->price, 2) }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="inquiry-btn-wrap mt-4">
                                                            <a href="{{ route('products.show', $product->slug) }}"
                                                                class="btn-card btn-inquiry-primary">Send inquiry</a>
                                                            <a href="javascript:void(0)"
                                                                class="btn-card btn-quickview-secondary quickview-btn"
                                                                data-id="{{ $product->id }}" data-toggle="modal"
                                                                data-target="#quickViewModal">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End List View Item -->
                            @endif
                        @empty
                            <div class="col-12">
                                <p class="text-center py-5">No products found.</p>
                            </div>
                        @endforelse
                    </div>
                    <!--/ End Products -->

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="catalog-pagination">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
                <!--/ End Product Grid -->
            </div>
        </div>
    </section>
    <!--/ End Product Style -->
@endsection
