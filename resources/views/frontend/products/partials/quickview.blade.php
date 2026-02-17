<div class="row no-gutters">
    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <!-- Product Slider -->
        <div class="product-gallery">
            <style>
                .quickview-slider-active .single-slider img {
                    height: 500px !important;
                    width: 100% !important;
                    object-fit: cover !important;
                    background: #fff;
                }

                .product-gallery {
                    background: #fff;
                    border-right: 1px solid #eee;
                    height: 500px;
                    overflow: hidden;
                }
            </style>
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
        <!-- End Product slider -->
    </div>
    <div class="col-lg-6 col-md-12 col-12" style="display: flex; align-items: center;">
        <div class="quickview-content" style="width: 100%; padding: 30px;">
            <h2 style="font-size: 24px; font-weight: 700; color: #333; margin-bottom: 15px;">{{ $product->name }}</h2>

            <div class="quickview-ratting-review" style="margin-bottom: 20px;">
                <div class="quickview-ratting-wrap">
                    <div class="quickview-ratting">
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="quickview-stock" style="margin-left: 20px;">
                    @if($product->is_active)
                        <span class="badge badge-success" style="padding: 5px 10px; font-weight: 600;"><i
                                class="fa fa-check-circle-o"></i> In Stock</span>
                    @else
                        <span class="badge badge-danger" style="padding: 5px 10px; font-weight: 600;"><i
                                class="fa fa-times-circle-o"></i> Out of Stock</span>
                    @endif
                </div>
            </div>

            <div class="product-metadata"
                style="margin-bottom: 25px; background: #f9f9f9; padding: 15px; border-radius: 8px;">
                <div class="metadata-row" style="display: flex; margin-bottom: 10px;">
                    <div style="width: 100px; font-weight: 700; color: #666;">Category:</div>
                    <div style="color: #333;">{{ $product->category->name }}</div>
                </div>
                <div class="metadata-row" style="display: flex;">
                    <div style="width: 100px; font-weight: 700; color: #666;">Brand:</div>
                    <div style="color: #333;">{{ $product->brand ? $product->brand->name : 'N/A' }}</div>
                </div>
            </div>

            <div class="quickview-peragraph" style="margin-bottom: 25px;">
                <h4 style="font-size: 16px; font-weight: 700; color: #333; margin-bottom: 10px;">Description:</h4>
                <p style="color: #666; line-height: 1.6;">{{ $product->short_description ?: $product->description }}</p>
            </div>

            <div class="add-to-cart">
                <a href="{{ route('products.show', $product->slug) }}" class="btn primary"
                    style="width: 100%; text-align: center; justify-content: center;">View Full Details</a>
            </div>
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
        navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
    });

</script>