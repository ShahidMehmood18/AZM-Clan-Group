@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Import Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item">Import</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        @include('components.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="alert alert-primary mb-4">
                            <h6 class="alert-heading fw-bold"><i class="feather-info me-2"></i>Instructions</h6>
                            <p class="mb-0">Use this feature to bulk upload products using a CSV file. </p>
                            <hr>
                            <ul class="mb-0 ps-3">
                                <li class="mb-1"><strong>Mandatory Fields:</strong> Product Name, Thumbnail, and
                                    Description.</li>
                                <li class="mb-1"><strong>How to Upload Images:</strong>
                                    <ul>
                                        <li>Create a folder on your computer.</li>
                                        <li>Put your <strong>CSV file</strong> and all <strong>Image files</strong> inside
                                            it.</li>
                                        <li>Compress (Zip) the folder.</li>
                                        <li>Upload the <strong>.zip</strong> file below.</li>
                                    </ul>
                                </li>
                                <li class="mb-1"><strong>In the CSV:</strong> Just enter the exact <strong>filename</strong>
                                    (e.g., <code>product-1.jpg</code>) in the <code>thumbnail</code> column.</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="mb-0">Upload File (CSV or ZIP)</h6>
                            <a href="{{ route('admin.products.import.template') }}" class="btn btn-outline-primary">
                                <i class="feather-download me-2"></i>Download Template
                            </a>
                        </div>

                        <form action="{{ route('admin.products.import.process') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="file" class="form-label">Choose File</label>
                                <input type="file" class="form-control" id="file" name="file" accept=".csv, .txt, .zip"
                                    required>
                                <div class="form-text">Supported formats: .csv, .txt, .zip (Max 10MB)</div>
                                <small class="text-muted d-block mt-1">Note: If uploading a ZIP, ensure the CSV file is at
                                    the root of the zip archive.</small>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="feather-upload me-2"></i>Start Import
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection