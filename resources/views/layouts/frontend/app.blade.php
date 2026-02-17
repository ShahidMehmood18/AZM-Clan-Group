<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="{{ \App\Models\Setting::get('meta_title') }}">
    <meta name="description" content="{{ \App\Models\Setting::get('meta_description') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::get('meta_keywords') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ \App\Models\Setting::get('meta_title') }}">
    <meta property="og:description" content="{{ \App\Models\Setting::get('meta_description') }}">
    @if($og_image = \App\Models\Setting::get('og_image'))
        <meta property="og:image" content="{{ image_url($og_image) }}">
    @endif
    <!-- Title Tag  -->
    <title>@yield('title', \App\Models\Setting::get('site_title', config('app.name', 'AZM CLAN')))</title>
    <!-- Favicon -->
    @if($favicon = \App\Models\Setting::get('site_favicon'))
        <link rel="icon" type="image/png" href="{{ image_url($favicon) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    @endif
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- StyleSheet -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/niceselect.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl-carousel.css') }}">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <!-- Color CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/color/color1.css') }}">

    @stack('styles')
    <style>
        /* ===== Product Card – Global ===== */
        .single-product {
            background: #fff;
            padding: 0;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            height: calc(100% - 20px);
            display: flex;
            flex-direction: column;
            border: 1px solid #f0f0f0;
            overflow: hidden;
        }

        .single-product:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
            border-color: #e0e0e0;
        }

        .single-product .product-img {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1;
            background: #efefef;
            padding: 0;
            border-radius: 0;
        }

        .single-product .product-img a {
            display: block;
            width: 100%;
            height: 100%;
        }

        .single-product .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .single-product:hover .product-img img {
            transform: scale(1.03);
        }

        .single-product .product-content {
            padding: 14px;
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .single-product .product-content h3 {
            font-size: 14px;
            margin: 0 0 8px;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.4;
            flex-shrink: 0;
        }

        .single-product .product-content h3 a {
            color: #333;
        }

        .single-product .product-content h3 a:hover {
            color: #F7941D;
        }

        .single-product .product-price {
            margin-bottom: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #F7941D;
            flex-shrink: 0;
        }

        .single-product .inquiry-btn-wrap {
            margin-top: auto;
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        .btn-card {
            flex: 1;
            display: block;
            text-align: center;
            padding: 8px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-transform: uppercase;
            white-space: nowrap;
            border: none;
            letter-spacing: 0.3px;
        }

        .btn-inquiry-primary {
            background: #333;
            color: #fff !important;
        }

        .btn-inquiry-primary:hover {
            background: #F7941D;
        }

        .btn-quickview-secondary {
            background: #fff;
            color: #333 !important;
            border: 1px solid #ddd;
        }

        .btn-quickview-secondary:hover {
            background: #eee;
            border-color: #ccc;
        }

        /* 5-column grid */
        @media (min-width: 1200px) {
            .product-grid-5 > .col-xl {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        /* Carousel card spacing override */
        .most-popular .single-product {
            margin-top: 0;
            margin-left: 8px;
            margin-right: 8px;
        }

        /* Mobile card adjustments */
        @media (max-width: 576px) {
            .single-product .product-content h3 { font-size: 13px; min-height: 36px; }
            .single-product .product-price { font-size: 15px; }
            .btn-card { padding: 7px 8px; font-size: 10px; }
        }

        /* List View Fixes */
        .single-product.list-view-card {
            height: 280px !important;
            flex-direction: row;
            align-items: stretch;
            padding: 0;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .list-view-card .product-img {
            width: 240px;
            height: 100%;
            flex-shrink: 0;
            margin-bottom: 0;
            border-radius: 0;
            padding: 0 !important;
            background: #fff;
            border-right: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .list-view-card .list-content {
            padding: 15px 15px 15px 0 !important;
            margin-top: 0 !important;
            flex-grow: 1;
            overflow-y: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .list-view-card .inquiry-btn-wrap {
            margin-top: auto !important;
            padding-top: 15px;
        }

        .list-view-card .product-img a {
            display: block;
            height: 100%;
            width: 100%;
        }

        .list-view-card .product-img img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .list-view-card .product-content {
            margin-top: 0;
        }

        .product-detail-row {
            display: flex;
            margin-bottom: 6px;
            border-bottom: 1px solid #f9f9f9;
            padding-bottom: 4px;
            align-items: center;
        }

        .product-detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            width: 80px;
            font-weight: 700;
            color: #444;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .detail-value {
            flex: 1;
            color: #555;
            font-size: 13px;
            line-height: 1.2;
        }

        .list-view-card .product-price {
            margin-bottom: 0px;
        }

        .list-view-card .product-des {
            margin-bottom: 20px;
            color: #666;
            line-height: 1.6;
        }

        /* Hide legacy button-head */
        .single-product .button-head {
            display: none !important;
        }

        .main-img-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .text-orange {
            color: #F7941D !important;
        }
    </style>
</head>

<body class="js">

    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div> -->
    <!-- End Preloader -->

    @include('layouts.frontend.partials.header')



    @yield('content')

    @include('layouts.frontend.partials.footer')

    <!-- Modal -->
    <style>
        /* ===== Quick View Modal ===== */
        #quickViewModal .modal-dialog { max-width: 860px; }

        #quickViewModal .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.14);
        }

        #quickViewModal .modal-header {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 10;
            border: none;
            padding: 12px 14px;
            background: transparent;
        }

        #quickViewModal .modal-header .close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            opacity: 0.7;
            font-size: 14px;
            transition: all 0.2s ease;
            margin: 0;
            padding: 0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        #quickViewModal .modal-header .close:hover {
            opacity: 1;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        #quickViewModal .modal-body { padding: 0; }

        /* Image section */
        #quickViewModal .qv-img-section {
            background: #f3f3f3;
            height: 460px;
            overflow: hidden;
            position: relative;
        }

        #quickViewModal .qv-img-section .quickview-slider-active { height: 100%; }

        #quickViewModal .qv-img-section .single-slider {
            height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #quickViewModal .qv-img-section .single-slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Owl nav arrows inside quickview */
        #quickViewModal .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            padding: 0 8px;
            margin: 0;
        }

        #quickViewModal .owl-nav div {
            pointer-events: auto;
            width: 34px;
            height: 34px;
            line-height: 32px;
            text-align: center;
            background: rgba(255, 255, 255, 0.85) !important;
            color: #444 !important;
            border-radius: 50%;
            font-size: 13px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
            margin: 0;
        }

        #quickViewModal .owl-nav div:hover {
            background: #fff !important;
            color: #F7941D !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        /* Content section */
        #quickViewModal .qv-content {
            padding: 36px 28px 24px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 460px;
            overflow-y: auto;
        }

        #quickViewModal .qv-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
            margin: 0 0 16px;
            max-width: 380px;
        }

        #quickViewModal .qv-rating-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        #quickViewModal .qv-stars .fa {
            color: #F7941D;
            font-size: 15px;
        }

        #quickViewModal .qv-stock {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        #quickViewModal .qv-stock-in { background: #28a745; color: #fff; }
        #quickViewModal .qv-stock-out { background: #dc3545; color: #fff; }

        #quickViewModal .qv-meta {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        #quickViewModal .qv-meta-row {
            display: flex;
            align-items: center;
            padding: 5px 0;
        }

        #quickViewModal .qv-meta-row + .qv-meta-row {
            border-top: 1px solid #eef0f2;
        }

        #quickViewModal .qv-meta-label {
            width: 80px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            flex-shrink: 0;
        }

        #quickViewModal .qv-meta-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        #quickViewModal .qv-desc {
            margin-bottom: 20px;
        }

        #quickViewModal .qv-desc-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #999;
            margin-bottom: 6px;
        }

        #quickViewModal .qv-desc p {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        #quickViewModal .qv-cta {
            display: block;
            width: 100%;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            text-align: center;
            background: #F7941D;
            color: #fff !important;
            border: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 3px 12px rgba(247, 148, 29, 0.25);
            margin-top: auto;
        }

        #quickViewModal .qv-cta:hover {
            background: #e68516;
            box-shadow: 0 5px 16px rgba(247, 148, 29, 0.35);
            transform: translateY(-1px);
        }

        @media (max-width: 991px) {
            #quickViewModal .qv-img-section,
            #quickViewModal .qv-img-section .single-slider,
            #quickViewModal .qv-content { height: auto; }
            #quickViewModal .qv-img-section .single-slider { height: 320px; }
            #quickViewModal .qv-content { padding: 20px; }
        }
    </style>

    <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body" id="quickViewContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Loading product details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Jquery -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('frontend/js/nicesellect.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('frontend/js/scrollup.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('frontend/js/active.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.quickview-btn', function (e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var url = "{{ route('products.quickview', ':id') }}";
                url = url.replace(':id', productId);

                $('#quickViewContent').html(`
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Loading product details...</p>
                    </div>
                `);

                setTimeout(function () {
                    $('#quickViewModal').modal('show');
                }, 10);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        $('#quickViewContent').html(response);
                    },
                    error: function () {
                        $('#quickViewContent').html('<p class="text-center text-danger">Something went wrong. Please try again.</p>');
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>