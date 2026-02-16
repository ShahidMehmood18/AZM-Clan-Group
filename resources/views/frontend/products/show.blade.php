@extends('layouts.frontend.app')

@section('title', $product->name . ' - ' . config('app.name'))

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
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        <li
                                            data-thumb="{{ $product->thumbnail ? asset($product->thumbnail) : 'https://via.placeholder.com/570x520' }}">
                                            <div class="main-img-wrap" style="height: 600px;">
                                                <img src="{{ $product->thumbnail ? asset($product->thumbnail) : 'https://via.placeholder.com/570x520' }}"
                                                    alt="{{ $product->name }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        </li>
                                        @if($product->images)
                                            @foreach($product->images as $image)
                                                <li data-thumb="{{ asset($image) }}">
                                                    <div class="main-img-wrap" style="height: 600px;">
                                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                                            style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <div class="short">
                                    <h4 style="font-size: 28px; margin-bottom: 10px;">{{ $product->name }}</h4>

                                    <div class="short-description mb-4">
                                        <h6 class="mb-2">Introduction</h6>
                                        <p>{{ $product->short_description }}</p>
                                    </div>

                                    <div class="full-description mb-4">
                                        <h6 class="mb-2">Detailed Specifications</h6>
                                        <div class="content" style="color: #666; line-height: 1.6;">
                                            {!! $product->description !!}
                                        </div>
                                    </div>

                                    <div class="product-meta-list"
                                        style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="meta-item d-flex align-items-center">
                                                    <strong class="text-muted small text-uppercase"
                                                        style="width: 100px;">Brand:</strong>
                                                    <span
                                                        class="text-orange font-weight-bold">{{ $product->brand ? $product->brand->name : 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="meta-item d-flex align-items-center">
                                                    <strong class="text-muted small text-uppercase"
                                                        style="width: 100px;">Category:</strong>
                                                    <span
                                                        class="text-orange font-weight-bold">{{ $product->category->name }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <h3 class="price"
                                                    style="font-size: 32px; color: #F7941D; font-weight: 700; margin: 0;">
                                                    ${{ number_format($product->price, 2) }}
                                                </h3>
                                            </div>
                                            <div class="col-12">
                                                <div class="rating-main"
                                                    style="display: flex; align-items: center; gap: 10px;">
                                                    <ul class="rating" style="margin: 0; padding: 0;">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                    <span style="color: #666; line-height: 1;">(4.5 Rating)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buy">
                                    <div class="add-to-cart">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#inquiryModal"
                                            style="width: 100%; height: 55px; font-size: 18px;">
                                            Send Inquiry
                                        </button>
                                    </div>
                                    <p class="availability mt-3">
                                        <strong>Availability:</strong>
                                        <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $product->is_active ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </p>
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
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('products.show', $relProduct->slug) }}">
                                        @if($relProduct->thumbnail)
                                            <img class="default-img" src="{{ asset($relProduct->thumbnail) }}"
                                                alt="{{ $relProduct->name }}">
                                        @else
                                            <img class="default-img" src="https://via.placeholder.com/550x750"
                                                alt="{{ $relProduct->name }}">
                                        @endif
                                    </a>

                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('products.show', $relProduct->slug) }}">{{ $relProduct->name }}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span>${{ number_format($relProduct->price, 2) }}</span>
                                    </div>
                                    <div class="inquiry-btn-wrap">
                                        <a href="{{ route('products.show', $relProduct->slug) }}"
                                            class="btn-card btn-inquiry-primary">Inquiry</a>
                                        <a href="javascript:void(0)" class="btn-card btn-quickview-secondary quickview-btn"
                                            data-id="{{ $relProduct->id }}">Quick View</a>
                                    </div>
                                </div>
                            </div>
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
    <script>     $(document).ready(function () {
            $('.btn-number').click(function (e) {
                e.preventDefault();
                var fieldName = $(this).attr('data-field'); var type = $(this).attr('data-type'); var input = $("input[name='" + fieldName + "']"); var currentVal = parseInt(input.val()); if (!isNaN(currentVal)) { if (type == 'minus') { if (currentVal > input.attr('data-min')) { input.val(currentVal - 1).change(); } if (parseInt(input.val()) == input.attr('data-min')) { $(this).attr('disabled', true); } } else if (type == 'plus') { if (currentVal < input.attr('data-max')) { input.val(currentVal + 1).change(); } if (parseInt(input.val()) == input.attr('data-max')) { $(this).attr('disabled', true); } } } else { input.val(0); }
            });
            $('.input-number').focusin(function () { $(this).data('oldValue', $(this).val()); });
            $('.input-number').change(function () {
                var minValue = parseInt($(this).attr('data-min')); var maxValue = parseInt($(this).attr('data-max')); var valueCurrent = parseInt($(this).val());
                var name = $(this).attr('name'); if (valueCurrent >= minValue) { $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled') } else { alert('Sorry, the minimum value was reached'); $(this).val($(this).data('oldValue')); } if (valueCurrent <= maxValue) { $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled') } else { alert('Sorry, the maximum value was reached'); $(this).val($(this).data('oldValue')); }
            });
        });
    </script>
@endpush