@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Contact Us Inquiries</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Inquiries</li>
                <li class="breadcrumb-item active">Contact Us</li>
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
                                        <th>Type</th>
                                        <th>Business Type</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr @if($message->status == 'pending') style="background: rgba(247, 148, 29, 0.05);"
                                        @endif>
                                            <td>{{ $message->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($message->type == 'partner')
                                                    <span class="badge bg-primary">Partner</span>
                                                @else
                                                    <span class="badge bg-secondary">Contact</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $message->business_type ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{{ Str::limit($message->subject, 30) }}</td>
                                            <td>
                                                @if($message->status == 'pending')
                                                    <span class="badge bg-warning">New</span>
                                                @else
                                                    <span class="badge bg-success">Read</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.inquiries.contact.show', $message->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.inquiries.contact.destroy', $message->id) }}"
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
                                            <td colspan="7" class="text-center py-4">No contact messages found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection