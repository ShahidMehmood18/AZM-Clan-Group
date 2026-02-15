@extends('layouts.frontend.app')

@section('title', 'Shipping Information - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Shipping Information</a></li>
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
                        <h3>Global Logistics & Supply Chain</h3>
                        <p>AZM CLAN provides end-to-end shipping solutions designed to optimize speed and reduce costs for
                            brands and resellers.
                            Our infrastructure supports global product reach.</p>

                        <h4 class="mt-4 mb-2">Our Capabilities:</h4>
                        <ul class="list-main" style="list-style: disc; padding-left: 20px;">
                            <li><strong>Freight Forwarding:</strong> Efficient Air and Sea freight options for international
                                bulk orders.</li>
                            <li><strong>FBA/WFS Prep:</strong> We offer labeling and prep services compliant with Amazon FBA
                                and Walmart Fulfillment Services.</li>
                            <li><strong>Climate-Controlled Transport:</strong> Ensuring integrity for sensitive medical and
                                beauty products.</li>
                            <li><strong>Drop-Shipping Support:</strong> Direct-to-consumer fulfillment for qualifying
                                partners.</li>
                        </ul>

                        <h4 class="mt-4 mb-2">Tracking & Optimization:</h4>
                        <p>We utilize advanced logistics software to track shipments in real-time and optimize routes.
                            Wholesale partners benefit from our negotiated high-volume freight rates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection