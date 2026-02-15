@extends('layouts.frontend.app')

@section('title', 'Partner With Us - ' . config('app.name'))
@push('styles')
    <style>
        .about-img {
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 0px 5px;
            border-width: 10px;
            border-style: solid;
            border-color: rgb(255, 255, 255);
            border-image: initial;
        }

        .nice-select {
            width: 100%;
            border-radius: 0px;
            height: 48px;
            line-height: 48px;
        }

        .nice-select .list {
            width: 100%;
            border-radius: 0px;
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
                            <li class="active"><a href="#">Partner With Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    @include('layouts.frontend.partials.alerts')

    <!-- Partner With Us -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
                        <div class="about-content">
                            <h3>Partner With
                                {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}
                            </h3>
                            <p>If you are a new marketplace seller struggling with product sourcing, we offer access to a
                                network of 1,000+ brands and distributors. Our network includes full compliance support such
                                as
                                invoice acceptance, compliance documents, and Letters of Authorization (LOA) directly from
                                the
                                brand to your company.</p>
                            <p>If you are a brand facing violations from resellers and having difficulty removing
                                unauthorized
                                sellers from your listings, we can help. We connect you with experienced, authorized
                                resellers
                                who understand marketplaces, follow your MAP policies, and reorder consistently. We work
                                with a
                                network of 300+ experienced resellers.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mb-5">
                        <div class="about-img overlay">
                            <img src="{{ asset('frontend/images/partner-with-us.png') }}" alt="Partner With Us">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h3>Write us a message</h3>
                            </div>
                            <form class="form" method="post" action="{{ route('partner.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Name<span>*</span></label>
                                            <input name="name" type="text" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>I am a<span>*</span></label>
                                            <select name="business_type" required>
                                                <option value="" selected disabled>Select Option</option>
                                                <option value="Brand">Brand</option>
                                                <option value="Reseller">Reseller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Subjects<span>*</span></label>
                                            <input name="subject" type="text" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Email<span>*</span></label>
                                            <input name="email" type="email" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Phone<span>*</span></label>
                                            <input name="phone" type="text" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <label>your message<span>*</span></label>
                                            <textarea name="message" placeholder="" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn ">Send Inquiry</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-head">
                            <div class="single-info">
                                <i class="fa fa-phone"></i>
                                <h4 class="title">Call us Now:</h4>
                                <ul>
                                    <li>{{ \App\Models\Setting::get('site_phone', '+123 456-789-1120') }}</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-envelope-open"></i>
                                <h4 class="title">Email:</h4>
                                <ul>
                                    <li><a
                                            href="mailto:{{ \App\Models\Setting::get('site_email', 'info@viraldistributors.com') }}">{{
                                            \App\Models\Setting::get('site_email', 'info@viraldistributors.com') }}</a></li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-location-arrow"></i>
                                <h4 class="title">Our Address:</h4>
                                <ul>
                                    <li>{{ \App\Models\Setting::get('site_address', 'NO. 342 - London Oxford Street, 012 United Kingdom.') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Partner With Us -->
    <section class="shop-services pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-hand-open"></i>
                        <h4>Authorized Partnerships</h4>
                        <p>Work only with vetted and policy-compliant sellers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-bar-chart"></i>
                        <h4>Sales Growth</h4>
                        <p>Consistent reordering and scalable demand</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-file"></i>
                        <h4>Compliance Support</h4>
                        <p>Invoices, LOAs, and full marketplace documentation</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Brand Control</h4>
                        <p>Reduced violations and cleaner listings</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection