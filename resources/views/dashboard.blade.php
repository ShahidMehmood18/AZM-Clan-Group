{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.backend.app')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ul>
        </div>
        {{-- <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                        <span class="reportrange-picker-field"></span>
                    </div>
                    <div class="dropdown filter-dropdown">
                        <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                            data-bs-auto-close="outside">
                            <i class="feather-filter me-2"></i>
                            <span>Filter</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Role" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Role">Role</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Team" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Team">Team</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Email" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Email">Email</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Member" checked="checked" />
                                    <label class="custom-control-label c-pointer" for="Member">Member</label>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Recommendation"
                                        checked="checked" />
                                    <label class="custom-control-label c-pointer"
                                        for="Recommendation">Recommendation</label>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-plus me-3"></i>
                                <span>Create New</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-filter me-3"></i>
                                <span>Manage Filter</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div> --}}
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <!-- [Total Products] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary border-soft-primary rounded">
                                    <i class="feather-box"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalProducts }}</span>
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Products</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Products] end -->

            <!-- [Total Categories] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-success text-success border-soft-success rounded">
                                    <i class="feather-layers"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalCategories }}</span>
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Categories</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Categories] end -->

            <!-- [Total Brands] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-warning text-warning border-soft-warning rounded">
                                    <i class="feather-tag"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalBrands }}</span>
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Total Brands</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Brands] end -->

            <!-- [Total Users] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-danger text-danger border-soft-danger rounded">
                                    <i class="feather-users"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalUsers }}</span></div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Registered Users</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Users] end -->
        </div>
        <div class="row">
            <!-- [Total Contact Messages] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-info text-info border-soft-info rounded">
                                    <i class="feather-mail"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span
                                            class="counter">{{ $totalContactMessages }}</span>
                                        <span class="fs-11 fw-normal text-muted ms-1">({{ $newContactMessages }} New)</span>
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Contact Messages</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Contact Messages] end -->

            <!-- [Total Product Inquiries] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex gap-4 align-items-center">
                                <div class="avatar-text avatar-lg bg-soft-primary text-primary border-soft-primary rounded">
                                    <i class="feather-message-circle"></i>
                                </div>
                                <div>
                                    <div class="fs-4 fw-bold text-dark"><span class="counter">{{ $totalInquiries }}</span>
                                        <span class="fs-11 fw-normal text-muted ms-1">({{ $newInquiries }} New)</span>
                                    </div>
                                    <h3 class="fs-13 fw-semibold text-truncate-1-line">Product Inquiries</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Total Product Inquiries] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
@endsection