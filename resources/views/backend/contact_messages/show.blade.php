@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Contact Message Details</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.inquiries.contact.index') }}">Inquiries</a></li>
                <li class="breadcrumb-item active">View Contact Message</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <a href="{{ route('admin.inquiries.contact.index') }}" class="btn btn-secondary">
                <i class="feather-arrow-left me-2"></i> Back to List
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Subject: {{ $message->subject ?: 'No Subject' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded mb-4">
                            <p style="white-space: pre-line; line-height: 1.6;">
                                {{ $message->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Message Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Status</span>
                                @if($message->status == 'pending')
                                    <span class="badge bg-warning">New</span>
                                @else
                                    <span class="badge bg-success">Read</span>
                                @endif
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Date</span>
                                <span>{{ $message->created_at->format('M d, Y h:i A') }}</span>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Customer Name</span>
                                <h6>{{ $message->name }}</h6>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Email</span>
                                <h6><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></h6>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted d-block mb-1">Phone</span>
                                <h6>{{ $message->phone ?: 'N/A' }}</h6>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('admin.inquiries.contact.destroy', $message->id) }}"
                            method="POST" class="w-100"
                            onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="feather-trash-2 me-2"></i> Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
