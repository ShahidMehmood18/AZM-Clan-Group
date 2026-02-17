<div class="row no-gutters">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="qv-img-section">
            <div class="quickview-slider-active">
                <div class="single-slider">
                    <img src="{{ product_image_url($product->thumbnail, 'https://via.placeholder.com/569x528') }}" alt="{{ $product->name }}">
                </div>
                @if($product->images)
                    @foreach($product->images as $image)
                        <div class="single-slider">
                            <img src="{{ product_image_url($image) }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12">
        <div class="qv-content">
            <h2 class="qv-title">{{ $product->name }}</h2>

            <div class="qv-rating-row">
                <div class="qv-stars">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                @if($product->is_active)
                    <span class="qv-stock qv-stock-in"><i class="fa fa-check-circle-o"></i> In Stock</span>
                @else
                    <span class="qv-stock qv-stock-out"><i class="fa fa-times-circle-o"></i> Out of Stock</span>
                @endif
            </div>

            <div class="qv-meta">
                <div class="qv-meta-row">
                    <span class="qv-meta-label">Category</span>
                    <span class="qv-meta-value">{{ $product->category->name }}</span>
                </div>
                <div class="qv-meta-row">
                    <span class="qv-meta-label">Brand</span>
                    <span class="qv-meta-value">{{ $product->brand ? $product->brand->name : 'N/A' }}</span>
                </div>
            </div>

            @if($product->short_description || $product->description)
                <div class="qv-desc">
                    <div class="qv-desc-label">Description</div>
                    <p>{{ $product->short_description ?: strip_tags($product->description) }}</p>
                </div>
            @endif

            <a href="{{ route('products.show', $product->slug) }}" class="qv-cta">View Full Details</a>
        </div>
    </div>
</div>

<script>
    $('.quickview-slider-active').owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 400,
        autoplayHoverPause: true,
        nav: true,
        loop: true,
        merge: true,
        dots: false,
        navText: ['<i class="ti-arrow-left"></i>', '<i class="ti-arrow-right"></i>'],
    });
</script>
