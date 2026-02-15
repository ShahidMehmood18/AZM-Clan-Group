@extends('layouts.frontend.app')

@section('title', 'About Us - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- About Us -->
    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="about-content">
                        <h3>About
                            {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}
                        </h3>
                        <p>We are distributors and partners with brands, especially those with strong sales volume on
                            marketplaces. We help brands connect with authorized resellers who work fully in alignment with
                            brand policies, such as following MAP pricing and other guidelines. We also operate as a
                            retailer and serve as an exclusive partner on marketplaces. We purchase in bulk and reorder
                            continuously.
                        </p>
                        <p>
                            We also support brands with end-to-end marketplace management, including listing optimization,
                            inventory planning, and demand forecasting. By leveraging data-driven insights and long-term
                            purchasing commitments, we help stabilize sales performance, reduce channel conflict, and ensure
                            consistent brand representation across all marketplaces.
                        </p>
                        <div class="button">
                            <a href="{{ route('products.all') }}" class="btn">All Products</a>
                            <a href="{{ route('contact') }}" class="btn primary">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-img overlay">
                        <!-- <div class="button">
                                                        <a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i
                                                                class="fa fa-play"></i></a>
                                                    </div> -->
                        <img src="{{ asset('frontend/images/about-us.png') }}" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us -->
    <section class="shop-services pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-world"></i>
                        <h4>Extensive Network</h4>
                        <p>1,000+ brands and distributors across marketplaces</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-shield"></i>
                        <h4>Brand Protection</h4>
                        <p>MAP enforcement and authorized reseller alignment</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-package"></i>
                        <h4>Bulk Purchasing</h4>
                        <p>Continuous bulk buying with reliable reordering</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-shopping-cart"></i>
                        <h4>Marketplace Expertise</h4>
                        <p>Hands-on experience as both distributor and retailer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection