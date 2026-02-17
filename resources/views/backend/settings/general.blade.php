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
        @include('components.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.settings.general.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- ===== Section 1: Site Identity ===== --}}
                            <h6 class="fw-bold mb-3"><i class="feather-globe me-2"></i>Site Identity</h6>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Site Title</label>
                                    <input type="text" class="form-control" name="site_title"
                                        value="{{ \App\Models\Setting::get('site_title') }}" required>
                                    <small class="text-muted">The name of your website, shown in browser tabs and search results.</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Business Description</label>
                                    <textarea class="form-control" name="site_description"
                                        rows="3" placeholder="Briefly describe your business...">{{ \App\Models\Setting::get('site_description') }}</textarea>
                                    <small class="text-muted">Used for meta description, social sharing, and footer/about sections.</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- ===== Section 2: Logo & Branding ===== --}}
                            <h6 class="fw-bold mb-3"><i class="feather-image me-2"></i>Logo & Branding</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Display Type</label>
                                    <div class="d-flex gap-4 mt-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="logo_type" id="logo_text"
                                                value="text" {{ \App\Models\Setting::get('logo_type', 'text') == 'text' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="logo_text">Text Logo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="logo_type" id="logo_image_radio"
                                                value="image" {{ \App\Models\Setting::get('logo_type') == 'image' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="logo_image_radio">Image Logo</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Choose how your logo appears on the website.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Text <span class="text-muted">(HTML allowed)</span></label>
                                    <input type="text" class="form-control" name="logo_text"
                                        value="{{ \App\Models\Setting::get('logo_text', 'AZM<span style=&quot;color: #F7941D;&quot;> CLAN</span>') }}">
                                    <small class="text-muted">Used when "Text Logo" is selected.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Logo Image</label>
                                    <div class="mb-2 p-3 bg-light rounded border text-center" style="min-height: 70px; display: flex; align-items: center; justify-content: center;">
                                        @if(\App\Models\Setting::get('logo_image'))
                                            <img src="{{ image_url(\App\Models\Setting::get('logo_image')) }}" alt="Current Logo"
                                                style="max-height: 60px; max-width: 100%;">
                                        @else
                                            <span class="text-muted small">No logo uploaded</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" name="logo_image">
                                    <small class="text-muted">Recommended: 250x100px, transparent PNG.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Favicon</label>
                                    <div class="mb-2 p-3 bg-light rounded border text-center" style="min-height: 70px; display: flex; align-items: center; justify-content: center;">
                                        @if(\App\Models\Setting::get('site_favicon'))
                                            <img src="{{ image_url(\App\Models\Setting::get('site_favicon')) }}" alt="Current Favicon"
                                                style="height: 32px; width: 32px; object-fit: contain;">
                                        @else
                                            <span class="text-muted small">No favicon uploaded</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" name="site_favicon">
                                    <small class="text-muted">Recommended: 32x32px or 64x64px, PNG or ICO.</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- ===== Section 3: Hero Image ===== --}}
                            <h6 class="fw-bold mb-3"><i class="feather-monitor me-2"></i>Hero Image (Homepage)</h6>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="mb-2 p-3 bg-light rounded border text-center" style="min-height: 120px; display: flex; align-items: center; justify-content: center;">
                                        @if(\App\Models\Setting::get('hero_image'))
                                            <img src="{{ image_url(\App\Models\Setting::get('hero_image')) }}" alt="Current Hero Image"
                                                style="max-height: 150px; max-width: 100%; object-fit: contain;">
                                        @else
                                            <span class="text-muted small">No hero image uploaded — default image will be used.</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" name="hero_image">
                                    <small class="text-muted">Recommended: 1920x700px. Displayed as the main banner on the homepage.</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- ===== Section 4: Contact Information ===== --}}
                            <h6 class="fw-bold mb-3"><i class="feather-phone me-2"></i>Contact Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" name="site_email"
                                        value="{{ \App\Models\Setting::get('site_email') }}"
                                        placeholder="info@example.com">
                                    <small class="text-muted">Shown in the header and footer of the website.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" name="site_phone"
                                        value="{{ \App\Models\Setting::get('site_phone') }}"
                                        placeholder="+1 (800) 123-4567">
                                    <small class="text-muted">Shown in the header and footer of the website.</small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="site_address"
                                        rows="2" placeholder="Street address, City, State, ZIP">{{ \App\Models\Setting::get('site_address') }}</textarea>
                                    <small class="text-muted">Displayed in the footer contact section.</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="feather-save me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
