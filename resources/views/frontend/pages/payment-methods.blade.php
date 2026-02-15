@extends('layouts.frontend.app')

@section('title', 'Payment Methods - ' . config('app.name'))

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Payment Methods</a></li>
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
                        <h3>Secure B2B Payment Solutions</h3>
                        <p>At AZM CLAN, we offer flexible and secure payment options tailored for high-volume wholesale
                            transactions.
                            Our systems are designed to support the financial needs of brands and professional resellers.
                        </p>

                        <h4 class="mt-4 mb-2">Accepted Methods:</h4>
                        <ul class="list-main" style="list-style: disc; padding-left: 20px;">
                            <li><strong>Wire Transfers & ACH:</strong> Preferred for bulk wholesale orders to ensure fast
                                processing.</li>
                            <li><strong>Corporate Credit Cards:</strong> We accept Visa, MasterCard, and Amex for immediate
                                inventory purchases.</li>
                            <li><strong>Net 30/60 Terms:</strong> Available for approved long-term partners and qualified
                                resellers.</li>
                            <li><strong>Letter of Credit:</strong> Supported for large-scale international freight
                                transactions.</li>
                        </ul>

                        <p class="mt-4">All financial data is encrypted and handled with strict confidentiality. For credit
                            application inquiries or billing support, please contact our finance team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection