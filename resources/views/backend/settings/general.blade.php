@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">General Settings</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item">General</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.settings.general.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h6 class="mb-4">Site Identity</h6>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Site Title</label>
                                    <input type="text" class="form-control" name="site_title"
                                        value="{{ \App\Models\Setting::get('site_title') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Create a short business description</label>
                                    <textarea class="form-control" name="site_description"
                                        rows="1">{{ \App\Models\Setting::get('site_description') }}</textarea>
                                </div>
                            </div>

                            <h6 class="mb-4">Logos & Favicon</h6>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Display Type</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="logo_type" id="logo_text"
                                                value="text" {{ \App\Models\Setting::get('logo_type', 'text') == 'text' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="logo_text">Text Logo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="logo_type" id="logo_image"
                                                value="image" {{ \App\Models\Setting::get('logo_type') == 'image' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="logo_image">Image Logo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Text (HTML allowed)</label>
                                    <input type="text" class="form-control" name="logo_text"
                                        value="{{ \App\Models\Setting::get('logo_text', 'AZM<span style=\"color: #F7941D;\"> CLAN</span>') }}">
                                    <small class="text-muted">Used if Text Logo is selected.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Image</label>
                                    @if(\App\Models\Setting::get('logo_image'))
                                        <div class="mb-2 p-2 bg-light rounded border">
                                            <img src="{{ asset('storage/' . \App\Models\Setting::get('logo_image')) }}"
                                                alt="Logo" height="50">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_image">
                                    <small class="text-muted">Best size: 250x100px or similar (transparent PNG
                                        recommended).</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Favicon</label>
                                    @if(\App\Models\Setting::get('site_favicon'))
                                        <div class="mb-2 text-center">
                                            <img src="{{ asset('storage/' . \App\Models\Setting::get('site_favicon')) }}"
                                                alt="Favicon" height="32">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="site_favicon">
                                </div>
                            </div>

                            <h6 class="mb-4">Contact Information</h6>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" name="site_email"
                                        value="{{ \App\Models\Setting::get('site_email') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" name="site_phone"
                                        value="{{ \App\Models\Setting::get('site_phone') }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="site_address"
                                        rows="2">{{ \App\Models\Setting::get('site_address') }}</textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection