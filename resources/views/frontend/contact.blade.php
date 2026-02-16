@extends('layouts.frontend.app')

@section('title', 'Contact Us - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    @include('layouts.frontend.partials.alerts')

    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section py-5">
        <div class="container">
            <div class="contact-head">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="about-content  pb-4">
                            <h3>Get In Touch With
                                {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}
                            </h3>
                            <p>Whether you’re a brand looking to protect your listings or a marketplace seller seeking
                                reliable product sourcing, we’re here to help. With access to 1,000+ brands and a network of
                                300+ compliant resellers, we simplify partnerships, ensure policy compliance, and drive
                                consistent growth. Reach out to start a conversation.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <!-- <h4>Get in touch</h4> -->
                                <h3>Write us a message</h3>
                            </div>
                            <form class="form" method="post" action="{{ route('contact.store') }}">
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
                                            <button type="submit" class="btn ">Send Message</button>
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
    <!--/ End Contact -->
    <section class="shop-services py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-headphone-alt"></i>
                        <h4>Dedicated Support</h4>
                        <p>Speak directly with our B2B and marketplace experts</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-shield"></i>
                        <h4>Policy-Compliant Partners</h4>
                        <p>We work strictly with authorized and compliant sellers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-briefcase"></i>
                        <h4>B2B Focused</h4>
                        <p>Solutions built specifically for brands and resellers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-service">
                        <i class="ti-check-box"></i>
                        <h4>Trusted Network</h4>
                        <p>Access to verified brands and experienced resellers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@push('styles')
    <style>
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

@push('scripts')
@endpush