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
        <meta property="og:image" content="{{ asset('storage/' . $og_image) }}">
    @endif
    <!-- Title Tag  -->
    <title>@yield('title', \App\Models\Setting::get('site_title', config('app.name', 'AZM CLAN')))</title>
    <!-- Favicon -->
    @if($favicon = \App\Models\Setting::get('site_favicon'))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
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
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/niceselect.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flex-slider.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl-carousel.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <!-- Color CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/color/color1.css') }}">

    <link rel="stylesheet" href="#" id="colors">

    @stack('styles')
    <style>
        .single-product {
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            height: calc(100% - 20px);
            display: flex;
            flex-direction: column;
            border: 1px solid #f0f0f0;
        }

        .single-product:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transform: translateY(-5px);
            border-color: #F7941D;
        }

        .single-product .product-img {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            aspect-ratio: 1/1;
            background: #fff;
            padding: 10px;
        }

        .single-product .product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .single-product .product-content {
            margin-top: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .single-product .product-content h3 {
            font-size: 16px;
            margin-bottom: 10px;
            height: auto;
            min-height: 48px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.5;
        }

        .single-product .product-price {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 700;
            color: #F7941D;
        }

        .single-product .inquiry-btn-wrap {
            margin-top: auto;
            display: flex;
            gap: 10px;
        }

        .btn-card {
            flex: 1;
            display: block;
            text-align: center;
            padding: 12px 15px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            white-space: nowrap;
            border: none;
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
    <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body" id="quickViewContent">
                    <!-- Dynamic content will be loaded here -->
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
    <!-- Color JS -->
    <script src="{{ asset('frontend/js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('frontend/js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('frontend/js/facnybox.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('frontend/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('frontend/js/nicesellect.js') }}"></script>
    <!-- Ytplayer JS -->
    <script src="{{ asset('frontend/js/ytplayer.min.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('frontend/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('frontend/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('frontend/js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('frontend/js/easing.js') }}"></script>
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