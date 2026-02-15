@extends('layouts.frontend.app')

@section('title', 'Privacy Policy - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Privacy Policy</a></li>
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
                        <h3>Data Privacy & Brand Protection</h3>
                        <p>At AZM CLAN, protecting your business intelligence is our priority. We understand the sensitivity
                            of supply chain data for both brands and resellers.</p>

                        <h4 class="mt-4 mb-2">1. Confidentiality Commitment</h4>
                        <p>We maintain strict confidentiality regarding Brand partners' distribution channels and Resellers'
                            sourcing strategies. Your data is never shared with competitors.</p>

                        <h4 class="mt-4 mb-2">2. Reseller Vetting Data</h4>
                        <p>Information collected during the reseller application process (Business Licenses, Tax IDs,
                            Storefront Links) is used solely for compliance verification and authorization purposes.</p>

                        <h4 class="mt-4 mb-2">3. Strategic Data Usage</h4>
                        <p>We leverage aggregated sales data to assist brands with demand forecasting and inventory
                            planning, ensuring long-term channel stability without compromising individual partner privacy.
                        </p>

                        <p class="mt-4">For full details on our data protection framework, legal counsel inquiries are
                            welcome.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection