@extends('layouts.frontend.app')

@section('title', $product->name . ' - ' . config('app.name'))

@push('styles')
<style>
    /* ===== Product Detail Page ===== */
    .pdp-gallery {
        display: flex;
        gap: 14px;
    }

    .pdp-thumbs {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 540px;
        overflow-y: auto;
        flex-shrink: 0;
        scrollbar-width: thin;
        scrollbar-color: #ddd transparent;
    }

    .pdp-thumbs::-webkit-scrollbar { width: 3px; }
    .pdp-thumbs::-webkit-scrollbar-thumb { background: #ddd; border-radius: 3px; }

    .pdp-thumb {
        width: 70px;
        height: 70px;
        border: 2px solid #e8e8e8;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        flex-shrink: 0;
        transition: all 0.2s ease;
        background: #f5f5f5;
    }

    .pdp-thumb:hover,
    .pdp-thumb.active {
        border-color: #F7941D;
        box-shadow: 0 0 0 1px rgba(247, 148, 29, 0.2);
    }

    .pdp-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pdp-main-img {
        flex: 1;
        border-radius: 10px;
        overflow: hidden;
        background: #f5f5f5;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .pdp-main-img img {
        width: 100%;
        height: 540px;
        object-fit: cover;
        display: block;
    }

    /* Right Column */
    .pdp-title {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.3;
        margin: 0 0 20px;
    }

    .pdp-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #999;
        margin-bottom: 6px;
    }

    .pdp-upc {
        font-size: 15px;
        color: #555;
        line-height: 1.5;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .pdp-specs {
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .pdp-specs .content {
        color: #555;
        line-height: 1.8;
        font-size: 14px;
        max-width: 560px;
    }

    .pdp-specs .content p {
        margin-bottom: 10px;
    }

    .pdp-specs .content p:last-child {
        margin-bottom: 0;
    }

    /* Meta Card */
    .pdp-meta {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px 22px;
        margin-bottom: 24px;
    }

    .pdp-meta-row {
        display: flex;
        align-items: center;
        padding: 6px 0;
    }

    .pdp-meta-row + .pdp-meta-row {
        border-top: 1px solid #eef0f2;
    }

    .pdp-meta-label {
        width: 90px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #999;
        flex-shrink: 0;
    }

    .pdp-meta-value {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .pdp-price {
        font-size: 30px;
        font-weight: 800;
        color: #F7941D;
        line-height: 1;
        padding: 10px 0;
    }

    .pdp-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 0;
    }

    .pdp-rating .fa {
        color: #F7941D;
        font-size: 16px;
    }

    .pdp-rating .rating-text {
        font-size: 13px;
        color: #888;
        font-weight: 500;
    }

    /* CTA */
    .pdp-cta-btn {
        display: block;
        width: 100%;
        padding: 16px 20px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #F7941D;
        color: #fff !important;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 14px rgba(247, 148, 29, 0.3);
    }

    .pdp-cta-btn:hover {
        background: #e68516;
        box-shadow: 0 6px 20px rgba(247, 148, 29, 0.4);
        transform: translateY(-1px);
    }

    .pdp-availability {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 14px;
        font-size: 13px;
        color: #666;
    }

    .pdp-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .pdp-badge-success {
        background: #28a745;
        color: #fff;
    }

    .pdp-badge-danger {
        background: #dc3545;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .pdp-gallery { flex-direction: column-reverse; }
        .pdp-thumbs {
            flex-direction: row;
            max-height: none;
            overflow-x: auto;
            overflow-y: hidden;
            gap: 8px;
        }
        .pdp-main-img img { height: 400px; }
        .pdp-title { font-size: 22px; margin-bottom: 16px; }
    }

    @media (max-width: 576px) {
        .pdp-main-img img { height: 300px; }
        .pdp-thumb { width: 56px; height: 56px; }
        .pdp-title { font-size: 20px; }
        .pdp-price { font-size: 26px; }
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
                            <li><a href="{{ route('products.all') }}">Shop<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">{{ $product->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    @include('layouts.frontend.partials.alerts')

    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Gallery -->
                            @php
                                $allImages = [];
                                if ($product->thumbnail) $allImages[] = $product->thumbnail;
                                if ($product->images) $allImages = array_merge($allImages, $product->images);
                            @endphp
                            <div class="pdp-gallery">
                                <!-- Thumbnail Column -->
                                @if(count($allImages) > 1)
                                    <div class="pdp-thumbs">
                                        @foreach($allImages as $index => $img)
                                            <div class="pdp-thumb {{ $index === 0 ? 'active' : '' }}"
                                                onclick="changeMainImage(this, '{{ product_image_url($img) }}')">
                                                <img src="{{ product_image_url($img) }}" alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- Main Image -->
                                <div class="pdp-main-img">
                                    <img id="main-product-image"
                                        src="{{ product_image_url($product->thumbnail, 'https://via.placeholder.com/570x520') }}"
                                        alt="{{ $product->name }}">
                                </div>
                            </div>
                            <!-- End Product Gallery -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <div class="short">
                                    <h4 class="pdp-title">{{ $product->name }}</h4>

                                    @if($product->short_description)
                                        <div class="pdp-upc">
                                            <div class="pdp-section-label">UPC</div>
                                            <span>{{ $product->short_description }}</span>
                                        </div>
                                    @endif

                                    @if($product->description)
                                        <div class="pdp-specs">
                                            <div class="pdp-section-label">Detailed Specifications</div>
                                            <div class="content">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="pdp-meta">
                                        <div class="pdp-meta-row">
                                            <span class="pdp-meta-label">Brand</span>
                                            <span class="pdp-meta-value">{{ $product->brand ? $product->brand->name : 'N/A' }}</span>
                                        </div>
                                        <div class="pdp-meta-row">
                                            <span class="pdp-meta-label">Category</span>
                                            <span class="pdp-meta-value">{{ $product->category->name }}</span>
                                        </div>
                                        <div class="pdp-meta-row">
                                            <div class="pdp-price">${{ number_format($product->price, 2) }}</div>
                                        </div>
                                        <div class="pdp-meta-row">
                                            <div class="pdp-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <span class="rating-text">4.5 Rating</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buy">
                                    <button type="button" class="pdp-cta-btn" data-toggle="modal" data-target="#inquiryModal">
                                        Send Inquiry
                                    </button>
                                    <div class="pdp-availability">
                                        Availability:
                                        <span class="pdp-badge {{ $product->is_active ? 'pdp-badge-success' : 'pdp-badge-danger' }}">
                                            {{ $product->is_active ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .custom-close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 24px;
            line-height: 1;
            opacity: 0.5;
            background: transparent !important;
            border: none;
            padding: 0;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #333 !important;
            cursor: pointer;
            z-index: 10;
        }

        .custom-close:hover {
            opacity: 1 !important;
            background-color: #f5f5f5 !important;
            color: #F7941D !important;
        }
    </style>

    <!-- Inquiry Modal -->
    <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content"
                style="border-radius: 12px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="modal-header"
                    style="background: #fff; border-bottom: 1px solid #f0f0f0; padding: 20px 25px; display: block; position: relative;">
                    <h5 class="modal-title"
                        style="color: #333; font-weight: 700; font-size: 20px; margin: 0; text-align: left;">Send Inquiry
                    </h5>
                    <button type="button" class="custom-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="modal-body p-4" style="background: #fff;">
                        <div class="selected-product-info mb-4 p-3"
                            style="background: #f8f9fa; border-left: 4px solid #F7941D; border-radius: 6px;">
                            <p class="mb-1 text-muted small uppercase tracking-wide" style="letter-spacing: 0.5px;">Product
                                Target:</p>
                            <h6 class="mb-0 font-weight-bold" style="color: #333; font-size: 16px;">{{ $product->name }}
                            </h6>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label class="font-weight-600 small text-uppercase"
                                    style="color: #666; margin-bottom: 8px; display: block;">Full Name *</label>
                                <input type="text" name="name" class="form-control form-control-md" required
                                    placeholder="John Doe" style="border-radius: 6px; padding: 12px 15px;">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label class="font-weight-600 small text-uppercase"
                                    style="color: #666; margin-bottom: 8px; display: block;">Email Address *</label>
                                <input type="email" name="email" class="form-control form-control-md" required
                                    placeholder="john@example.com" style="border-radius: 6px; padding: 12px 15px;">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-600 small text-uppercase"
                                    style="color: #666; margin-bottom: 8px; display: block;">Phone Number *</label>
                                <input type="text" name="phone" class="form-control form-control-md" required
                                    placeholder="+1 234 567 890" style="border-radius: 6px; padding: 12px 15px;">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-600 small text-uppercase"
                                    style="color: #666; margin-bottom: 8px; display: block;">Quantity *</label>
                                <input type="number" name="quantity" class="form-control form-control-md" required min="1"
                                    value="1" style="border-radius: 6px; padding: 12px 15px;">
                            </div>
                            <div class="col-12 form-group mb-0">
                                <label class="font-weight-600 small text-uppercase"
                                    style="color: #666; margin-bottom: 8px; display: block;">Inquiry Details</label>
                                <textarea name="message" class="form-control form-control-md" rows="3"
                                    placeholder="I would like to know more about..."
                                    style="border-radius: 6px; padding: 12px 15px; resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"
                        style="border-top: 1px solid #f0f0f0; background: #fafafa; padding: 15px 25px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="background: transparent; color: #666; border: none; font-weight: 600;">Cancel</button>
                        <button type="submit" class="btn"
                            style="background: #F7941D; color: #fff; border: none; padding: 12px 30px; border-radius: 6px; font-weight: 700; box-shadow: 0 4px 15px rgba(247, 148, 29, 0.3);">Send
                            Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/ End Shop Single -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        @foreach($relatedProducts as $relProduct)
                            @include('frontend.products.partials.card', ['product' => $relProduct])
                        @endforeach
                        <!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->
@endsection

@push('scripts')
    <script>
        function changeMainImage(thumb, src) {
            document.getElementById('main-product-image').src = src;
            document.querySelectorAll('.pdp-thumb').forEach(function(el) {
                el.classList.remove('active');
            });
            thumb.classList.add('active');
        }
    </script>
@endpush
