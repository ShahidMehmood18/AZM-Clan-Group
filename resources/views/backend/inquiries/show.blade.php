@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Inquiry Details</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.inquiries.index') }}">Inquiries</a></li>
                <li class="breadcrumb-item">View</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">
                <i class="feather-arrow-left me-2"></i> Back to List
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Customer Message</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded mb-4">
                            <p style="white-space: pre-line; line-height: 1.6;">
                                {{ $inquiry->message ?: 'No message provided.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Inquiry Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Status</span>
                                @if($inquiry->status == 'pending')
                                    <span class="badge bg-warning">New</span>
                                @else
                                    <span class="badge bg-success">Responded</span>
                                @endif
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Date</span>
                                <span>{{ $inquiry->created_at->format('M d, Y h:i A') }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Customer Name</span>
                                <h6>{{ $inquiry->name }}</h6>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Email</span>
                                <h6><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></h6>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Phone</span>
                                <h6>{{ $inquiry->phone }}</h6>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card stretch stretch-full mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset($inquiry->product->thumbnail) }}" alt="" width="60" class="rounded me-3">
                            <div>
                                <h6 class="mb-0">{{ $inquiry->product->name }}</h6>
                                <small class="text-muted">Qty: {{ $inquiry->quantity }} units</small>
                            </div>
                        </div>
                        <a href="{{ route('products.show', $inquiry->product->slug) }}" target="_blank"
                            class="btn btn-outline-primary btn-sm w-100">
                            View Product Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection