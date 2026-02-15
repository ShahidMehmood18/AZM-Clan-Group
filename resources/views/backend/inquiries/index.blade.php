@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Product Inquiries</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Inquiries</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        @include('components.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inquiries as $inquiry)
                                        <tr @if($inquiry->status == 'pending') style="background: rgba(247, 148, 29, 0.05);"
                                        @endif>
                                            <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $inquiry->product->slug) }}" target="_blank">
                                                    {{ Str::limit($inquiry->product->name, 30) }}
                                                </a>
                                            </td>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td>{{ $inquiry->phone }}</td>
                                            <td>{{ $inquiry->quantity }}</td>
                                            <td>
                                                @if($inquiry->status == 'pending')
                                                    <span class="badge bg-warning">New</span>
                                                @else
                                                    <span class="badge bg-success">Responded</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">No inquiries found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $inquiries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection