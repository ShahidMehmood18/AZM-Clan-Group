<!-- Start Footer Area -->
<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Customer Service</h4>
                        <ul>
                            <li><a href="{{ route('payment-methods') }}">Payment Methods</a></li>
                            <li><a href="{{ route('money-back') }}">Money-back</a></li>
                            <li><a href="{{ route('returns') }}">Returns</a></li>
                            <li><a href="{{ route('shipping') }}">Shipping</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Get In Tuch</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>{{ \App\Models\Setting::get('site_address', 'NO. 342 - London Oxford Street, 012 United Kingdom.') }}
                                </li>
                                <li>{{ \App\Models\Setting::get('site_email', 'info@viraldistributors.com') }}</li>
                                <li>{{ \App\Models\Setting::get('site_phone', '+032 3456 7890') }}</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <ul>
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-flickr"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">AZM CLAN</a> - All
                                Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="{{ asset('frontend/images/payments.png') }}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /End Footer Area -->