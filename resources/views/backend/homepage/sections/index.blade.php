@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Homepage Sections</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Homepage Sections</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Heading</th>
                                        <th>Section Key</th>
                                        <th>Cards</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sections as $section)
                                        <tr>
                                            <td>{{ $section->order_num }}</td>
                                            <td>{{ $section->heading }}</td>
                                            <td><code>{{ $section->section_key }}</code></td>
                                            <td>{{ $section->cards->count() }} Cards</td>
                                            <td>
                                                <span class="badge {{ $section->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $section->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.homepage-sections.edit', $section) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="feather-edit"></i> Manage Section & Cards
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection