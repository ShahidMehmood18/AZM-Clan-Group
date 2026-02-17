<div class="single-product">
    <div class="product-img">
        <a href="{{ route('products.show', $product->slug) }}">
            <img src="{{ product_image_url($product->thumbnail) }}" alt="{{ $product->name }}">
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
