@extends('layouts.frontend.app')

@section('title', (isset($category) ? $category->name . ' - ' : (isset($brand) ? $brand->name . ' - ' : 'All Products - ')) . config('app.name'))

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
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Categories</h3>
                            <ul class="categor-list">
                                @foreach($categories as $cat)
                                    <li>
                                        <a href="{{ route('products.category', $cat->slug) }}"
                                            class="{{ (isset($category) && $category->id == $cat->id) ? 'font-weight-bold text-primary' : '' }}">
                                            {{ $cat->name }} <span>({{ $cat->products_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->

                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Brands</h3>
                            <ul class="categor-list">
                                @foreach($brands as $brand)
                                    <li>
                                        <a href="{{ route('products.all', ['brand' => $brand->slug] + request()->except(['brand', 'page'])) }}"
                                            class="{{ request('brand') == $brand->slug ? 'font-weight-bold text-primary' : '' }}">
                                            {{ $brand->name }} <span>({{ $brand->products_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <select onchange="window.location.href=this.value">
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name</option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High
                                            </option>
                                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    <li class="{{ $viewMode == 'grid' ? 'active' : '' }}">
                                        <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"><i
                                                class="fa fa-th-large"></i></a>
                                    </li>
                                    <li class="{{ $viewMode == 'list' ? 'active' : '' }}">
                                        <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"><i
                                                class="fa fa-th-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="row">
                        @forelse($products as $product)
                            @if($viewMode == 'grid')
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                @if($product->thumbnail)
                                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                                                @else
                                                    <img src="https://via.placeholder.com/550x750" alt="{{ $product->name }}">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                                            <div class="product-price">
                                                <span>${{ number_format($product->price, 2) }}</span>
                                            </div>
                                            <div class="inquiry-btn-wrap">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                    class="btn-card btn-inquiry-primary">Inquiry</a>
                                                <a href="javascript:void(0)" class="btn-card btn-quickview-secondary quickview-btn"
                                                    data-id="{{ $product->id }}" data-toggle="modal"
                                                    data-target="#quickViewModal">Quick View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Start Single List -->
                                <div class="col-12">
                                    <div class="single-product list-view-card">
                                        <div class="row w-100 m-0">
                                            <div class="col-lg-4 col-md-4 col-12 p-0">
                                                <div class="product-img">
                                                    <a href="{{ route('products.show', $product->slug) }}">
                                                        @if($product->thumbnail)
                                                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                                                        @else
                                                            <img src="https://via.placeholder.com/550x750" alt="{{ $product->name }}">
                                                        @endif
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
                                                                    <a
                                                                        href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Category</div>
                                                            <div class="detail-value">{{ $product->category->name }}</div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Brand</div>
                                                            <div class="detail-value">{{ $product->brand->name }}</div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Price</div>
                                                            <div class="detail-value">
                                                                <span class="text-orange font-weight-bold" style="font-size: 18px;">
                                                                    ${{ number_format($product->price, 2) }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="product-detail-row">
                                                            <div class="detail-label">Rating</div>
                                                            <div class="detail-value">
                                                                <div class="rating text-warning">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    <span class="text-muted small ml-1">(4.5/5)</span>
                                                                </div>
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
                                <!-- End Single List -->
                            @endif
                        @empty
                            <div class="col-12">
                                <p class="text-center py-5">No products found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Product Style 1  -->
@endsection