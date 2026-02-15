@extends('layouts.frontend.app')

@section('title', 'Returns & Exchanges - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Returns & Exchanges</a></li>
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
                        <h3>Wholesale Return Policy</h3>
                        <p>We have a streamlined return process for our B2B partners to ensure inventory issues are resolved
                            quickly and efficiently.
                            Transparency is key to our partnership.</p>

                        <h4 class="mt-4 mb-2">Return Eligibility:</h4>
                        <ol class="list-main" style="padding-left: 20px;">
                            <li><strong>Damaged/Defective Details:</strong> Must be reported within 5 business days of
                                delivery with photographic evidence.</li>
                            <li><strong>Shipping Errors:</strong> Incorrect items received will be replaced at no cost.</li>
                            <li><strong>Non-Compliant Items:</strong> Products not meeting marketplace authorization
                                standards.</li>
                        </ol>

                        <h4 class="mt-4 mb-2">Process & Fees:</h4>
                        <p>All returns require an RMA (Return Merchandise Authorization) number. Returns for non-defective
                            items may be subject to a restocking fee to cover logistics and inspection costs. Please contact
                            support to initiate a claim.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection