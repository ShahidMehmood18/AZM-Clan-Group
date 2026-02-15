@extends('layouts.frontend.app')

@section('title', 'Money-back Guarantee - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Money-back Guarantee</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-content">
                        <h3>Authenticity & Performance Promise</h3>
                        <p>We guarantee that all products sourced through AZM CLAN are 100% authentic and compliant with
                            marketplace standards.
                            Our commitment to brand integrity means you can sell with confidence.</p>

                        <h4 class="mt-4 mb-2">Our Guarantee Includes:</h4>
                        <ul class="list-main" style="list-style: disc; padding-left: 20px;">
                            <li><strong>100% Authentic Inventory:</strong> Sourced directly from brands or authorized master
                                distributors.</li>
                            <li><strong>Marketplace Compliance:</strong> We provide necessary invoices and Letters of
                                Authorization (LOA) for approval.</li>
                            <li><strong>Freshness Guarantee:</strong> All medical and beauty products meet strict expiration
                                date criteria.</li>
                        </ul>

                        <p class="mt-4">If stock does not meet these compliance standards or is proven inauthentic, we offer
                            a full refund or immediate replacement. Your business reputation is our priority.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection