@extends('layouts.frontend.app')

@section('title', 'Welcome to - ' . config('app.name'))

@push('styles')
	<style>
		.hero-slider {
			background: #000;
			overflow: hidden;
			position: relative;
			margin-top: 0 !important;
			padding-top: 0 !important;
			top: 0;
		}

		.hero-slider .single-slider {
			height: 700px;
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			display: flex;
			align-items: center;
			position: relative;
		}

		.hero-slider .single-slider::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.4);
			/* Darker overlay for better image contrast */
			z-index: 1;
		}

		.hero-slider .content {
			position: relative;
			z-index: 2;
			background: #ffffff;
			/* Solid white for absolute readability */
			padding: 50px 60px;
			border-radius: 15px;
			max-width: 600px;
			box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
			margin-left: 0;
			border-left: 8px solid #F7941D;
			/* Brand accent */
			animation: fadeInUp 0.8s both;
		}

		.hero-slider .title {
			font-size: 44px !important;
			color: #1a1a1a !important;
			font-weight: 900 !important;
			line-height: 1.1 !important;
			margin: 15px 0 25px 0 !important;
			text-transform: capitalize !important;
		}

		.hero-slider .sub-title {
			color: #F7941D !important;
			font-weight: 800 !important;
			letter-spacing: 2px;
			text-transform: uppercase;
			display: block;
			font-size: 15px !important;
		}

		.hero-slider .des {
			font-size: 17px !important;
			color: #444 !important;
			margin-bottom: 30px !important;
			line-height: 1.6 !important;
		}

		.hero-slider .btn {
			background: #F7941D !important;
			/* Theme Color */
			color: #fff !important;
			padding: 18px 40px !important;
			font-size: 16px !important;
			font-weight: 700 !important;
			height: auto !important;
			line-height: 1 !important;
			border-radius: 5px !important;
			border: none !important;
			transition: background 0.3s ease !important;
		}

		.hero-slider .btn:hover {
			background: #e68516 !important;
			color: #fff !important;
			box-shadow: 0 5px 15px rgba(247, 148, 29, 0.4) !important;
		}

		/* Navigation Buttons */
		.hero-slider .owl-nav div {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			background: rgba(255, 255, 255, 0.9) !important;
			color: #333 !important;
			width: 55px !important;
			height: 55px !important;
			line-height: 55px !important;
			border-radius: 50% !important;
			font-size: 18px !important;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
			transition: all 0.3s ease !important;
			margin: 0 !important;
			opacity: 0.8;
		}

		.hero-slider .owl-nav .owl-prev {
			left: 40px !important;
		}

		.hero-slider .owl-nav .owl-next {
			right: 40px !important;
		}

		.hero-slider .owl-nav div:hover {
			opacity: 1;
			background: #F7941D !important;
			color: #fff !important;
			transform: translateY(-50%) scale(1.1) !important;
		}

		/* Wholesale Banner Redesign */
		.midium-banner {
			background: #000;
			padding: 80px 0;
		}

		.wholesale-card {
			background: #111;
			border-radius: 12px;
			overflow: hidden;
			display: flex;
			height: 300px;
			border: 1px solid #222;
			transition: transform 0.3s ease;
		}

		.wholesale-card:hover {
			transform: translateY(-5px);
			border-color: #F7941D;
		}

		.wholesale-card .card-text {
			padding: 20px;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.wholesale-card .card-image {
			background-size: cover;
			background-position: center;
		}

		@media (min-width: 992px) {
			.wholesale-card.d-flex {
				align-items: stretch !important;
			}

			.wholesale-card .card-text {
				width: 50%;
				padding: 40px;
			}

			.wholesale-card .card-image {
				width: 50%;
				align-self: stretch;
			}
		}

		.wholesale-card h3 {
			color: #fff;
			font-size: 24px;
			font-weight: 700;
			margin-bottom: 15px;
			line-height: 1.2;
		}

		.wholesale-card p {
			color: #fff;
			font-size: 14px;
			line-height: 1.5;
			margin-bottom: 20px;
		}

		/* Features Section (Image Left, Text Right) */
		.features-section {
			background: #000;
			padding: 80px 0;
			border-top: 1px solid #222;
		}

		.feature-card {
			background: #111;
			border-radius: 12px;
			overflow: hidden;
			display: flex;
			border: 1px solid #222;
			transition: all 0.3s ease;
			margin-bottom: 30px;
		}

		.feature-card:hover {
			border-color: #F7941D;
			transform: translateY(-5px);
		}

		.feature-card .card-image {
			background-size: cover;
			background-position: center;
		}

		.feature-card .card-text {
			padding: 20px;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		@media (min-width: 768px) {
			.feature-card.d-flex {
				align-items: stretch !important;
			}

			.feature-card {
				height: 340px;
			}

			.feature-card .card-image {
				width: 35%;
				align-self: stretch;
			}

			.feature-card .card-text {
				width: 65%;
				padding: 40px;
			}
		}

		.feature-card h4 {
			color: #fff;
			font-size: 24px;
			font-weight: 700;
			margin-bottom: 15px;
		}

		.feature-card p {
			color: #fff;
			font-size: 15px;
			line-height: 1.6;
			margin-bottom: 0;
		}

		.feature-card .btn-outline {
			color: #F7941D;
			font-weight: 700;
			text-transform: uppercase;
			font-size: 12px;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 5px;
		}

		.product-area.section {
			padding-top: 40px;
			/* Reduced space below carousel */
		}

		/* Category Carousel Cards */
		.category-card {
			text-align: center;
			padding: 10px;
		}

		.category-card a {
			text-decoration: none;
			display: block;
		}

		.category-card-img {
			aspect-ratio: 1 / 1;
			border-radius: 12px;
			overflow: hidden;
			background: #f8f8f8;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		.category-card a:hover .category-card-img {
			transform: translateY(-4px);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
		}

		.category-card-img img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.category-card-name {
			font-size: 15px;
			font-weight: 600;
			color: #333;
			margin: 12px 0 0;
			transition: color 0.2s ease;
		}

		.category-card a:hover .category-card-name {
			color: #F7941D;
		}

		/* Category carousel nav arrows - reuse most-popular positioning */
		.category-carousel .owl-nav {
			margin: 0;
			position: absolute;
			top: 50%;
			width: 100%;
			margin-top: -15px;
		}

		.category-carousel .owl-carousel .owl-nav div {
			height: 50px;
			width: 28px;
			line-height: 48px;
			background: #fff;
			color: #333;
			position: absolute;
			margin: 0;
			border-radius: 0;
			font-size: 14px;
			text-align: center;
			transition: all 0.3s ease;
			box-shadow: 0 0 10px rgba(51, 51, 51, 0.1);
		}

		.category-carousel .owl-carousel .owl-nav div:hover {
			color: #fff;
			background: #F7941D;
		}

		.category-carousel .owl-carousel .owl-nav .owl-prev {
			left: -5px;
		}

		.category-carousel .owl-carousel .owl-nav .owl-next {
			right: -5px;
		}

		/* ===== RESPONSIVE HERO SECTION ===== */
		@media (max-width: 991px) {
			.hero-slider .single-slider {
				height: 500px;
			}

			.hero-slider .content {
				padding: 30px 25px;
				max-width: 100%;
				margin: 0 15px;
			}

			.hero-slider .title {
				font-size: 32px !important;
				margin: 10px 0 15px 0 !important;
			}

			.hero-slider .sub-title {
				font-size: 13px !important;
			}

			.hero-slider .des {
				font-size: 15px !important;
				margin-bottom: 20px !important;
			}

			.hero-slider .btn {
				padding: 14px 30px !important;
				font-size: 14px !important;
			}

			.hero-slider .owl-nav div {
				width: 45px !important;
				height: 45px !important;
				line-height: 45px !important;
				font-size: 16px !important;
			}

			.hero-slider .owl-nav .owl-prev {
				left: 15px !important;
			}

			.hero-slider .owl-nav .owl-next {
				right: 15px !important;
			}
		}

		@media (max-width: 767px) {
			.hero-slider .single-slider {
				height: 450px;
			}

			.hero-slider .content {
				padding: 25px 20px;
				border-left-width: 5px;
			}

			.hero-slider .title {
				font-size: 26px !important;
				margin: 8px 0 12px 0 !important;
			}

			.hero-slider .sub-title {
				font-size: 12px !important;
				letter-spacing: 1px;
			}

			.hero-slider .des {
				font-size: 14px !important;
				margin-bottom: 18px !important;
			}

			.hero-slider .btn {
				padding: 12px 25px !important;
				font-size: 13px !important;
			}
		}

		@media (max-width: 480px) {
			.hero-slider .single-slider {
				height: 400px;
			}

			.hero-slider .content {
				padding: 20px 18px;
			}

			.hero-slider .title {
				font-size: 22px !important;
			}

			.hero-slider .des {
				font-size: 13px !important;
			}
		}
	</style>
@endpush

@section('content')
	@include('layouts.frontend.partials.alerts')
	<!-- Start Hero Area -->
	<section class="hero-slider">
		<!-- Static Hero (No Slider) -->
		<div class="single-slider"
			style="background-image:url('{{ image_url(\App\Models\Setting::get('hero_image'), asset('wholesale_hero_1.png')) }}');">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="content">
							<h1 class="title">Your B2B distributor partner </h1>
							<p class="des">Helping brands grow through smart partnerships and safeguarding product listings
								across online marketplaces with expert reseller management.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ End Hero Area -->

	<!-- Start Category Carousel -->
	@php
		$carouselCategories = \App\Models\Category::where('is_active', true)
			->whereNotNull('image')
			->where('image', '!=', '')
			->get();
	@endphp
	@if($carouselCategories->count())
		<div class="product-area most-popular category-carousel section" style="background: #fff; padding: 50px 0 30px;">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title" style="margin-bottom: 30px;">
						<h2>Top Categories</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="owl-carousel category-slider">
							@foreach($carouselCategories as $cat)
								<div class="category-card">
									<a href="{{ route('products.category', $cat->slug) }}">
										<div class="category-card-img">
											<img src="{{ image_url($cat->image) }}" alt="{{ $cat->name }}">
										</div>
										<h4 class="category-card-name">{{ $cat->name }}</h4>
									</a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	<!-- End Category Carousel -->

	<!-- Start Product Area -->
	<div class="product-area section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Trending Items</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="product-info">
						<!-- <div class="nav-main">

															<ul class="nav nav-tabs" id="myTab" role="tablist">
																<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all" role="tab">All
																		Products</a></li>
															</ul>

														</div> -->
						<div class="tab-content" id="myTabContent">
							<!-- Start Single Tab -->
							<div class="tab-pane fade show active" id="all" role="tabpanel">
								<div class="tab-single">
									<div class="row product-grid-5">
										@forelse(\App\Models\Product::where('is_trending', true)->take(10)->get() as $product)
											<div class="col-xl col-lg-3 col-md-4 col-6">
												@include('frontend.products.partials.card', ['product' => $product])
											</div>
										@empty
											<div class="col-12">
												<p class="text-center">No trending products found.</p>
											</div>
										@endforelse
									</div>
								</div>
							</div>
							<!--/ End Single Tab -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Area -->

	<!-- Start Dynamic Wholesale Section 1  -->
	@php $section1 = \App\Models\HomepageSection::where('section_key', 'wholesale_1')->with('cards')->first(); @endphp
	@if($section1 && $section1->is_active)
		<section class="midium-banner">
			<div class="container-fluid px-5">
				<div class="row">
					<div class="col-12 text-center mb-5">
						<h2 style="color: #fff; font-size: 36px; font-weight: 800; margin-bottom: 20px;">
							{{ $section1->heading }}
						</h2>
						<p style="color: white; max-width: 800px; margin: 0 auto; font-size: 16px; line-height: 1.6;">
							{{ $section1->description }}
						</p>
					</div>
				</div>
				<div class="row">
					@foreach($section1->cards as $card)
						<div class="col-lg-6 col-md-12 col-12 mb-4">
							<div class="wholesale-card d-flex flex-column flex-lg-row align-items-center">
								<div class="card-image w-100 w-lg-50"
									style="background-image: url('{{ $card->image ? (str_contains($card->image, 'http') ? $card->image : asset($card->image)) : asset('wholesale_hero_1.png') }}'); min-height: 200px;">
								</div>
								<div class="card-text w-100 w-lg-50 p-4">
									<h3>{{ $card->heading }}</h3>
									<p>{{ $card->description }}</p>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif
	<!-- End Midium Banner -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular section" style="background: #fff; padding-bottom: 80px;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Hot Items</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						@foreach(\App\Models\Product::where('is_hot', true)->take(10)->get() as $product)
							@include('frontend.products.partials.card', ['product' => $product])
						@endforeach
						<!-- End Single Product -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Most Popular -->

	<!-- Wholesale Capabilities Section -->
	@php $section2 = \App\Models\HomepageSection::where('section_key', 'wholesale_2')->with('cards')->first(); @endphp
	@if($section2 && $section2->is_active)
		<section class="features-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 text-center mb-5">
						<h2 style="color: #fff; font-size: 36px; font-weight: 800; margin-bottom: 20px;">
							{{ $section2->heading }}
						</h2>
						<p style="color: white; max-width: 800px; margin: 0 auto; font-size: 16px; line-height: 1.6;">
							{{ $section2->description }}
						</p>
					</div>
				</div>
				<div class="row">
					@foreach($section2->cards as $card)
						<div class="col-lg-6 col-12">
							<div class="feature-card d-flex flex-column flex-md-row align-items-center">
								<div class="card-image w-100 w-md-35"
									style="background-image: url('{{ $card->image ? (str_contains($card->image, 'http') ? $card->image : asset($card->image)) : asset('wholesale_hero_1.png') }}'); min-height: 150px;">
								</div>
								<div class="card-text w-100 w-md-65 p-3">
									<h4>{{ $card->heading }}</h4>
									<p>{{ $card->description }}</p>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-shield"></i>
						<h4>Authorized Distribution</h4>
						<p>Brand-approved products from verified suppliers</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-package"></i>
						<h4>Bulk Order Support</h4>
						<p>ptimized pricing for wholesale & volume buyers</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-back-left"></i>
						<h4>Hassle-Free Returns</h4>
						<p>Clear return policies aligned with brand terms</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-money"></i>
						<h4>Best Price Assurance</h4>
						<p>Competitive B2B pricing with margin protection</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	<!-- Start Shop Newsletter  -->
	<!-- <section class="shop-newsletter section">
																													<div class="container">
																														<div class="inner-top">
																															<div class="row">
																																<div class="col-lg-8 offset-lg-2 col-12">

																																	<div class="inner">
																																		<h4>Newsletter</h4>
																																		<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
																																		<form action="#" method="get" target="_blank" class="newsletter-inner">
																																			<input name="EMAIL" placeholder="Your email address" required="" type="email">
																																			<button class="btn">Subscribe</button>
																																		</form>
																																	</div>

																																</div>
																															</div>
																														</div>
																													</div>
																												</section> -->
	<!-- End Shop Newsletter -->
@endsection