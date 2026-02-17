@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">SEO Settings</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item">SEO</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form action="{{ route('admin.settings.seo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-info mb-4">
                                <i class="feather-info me-2"></i> These settings will be used as defaults for pages that
                                don't have specific SEO metadata defined.
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Title Default</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        value="{{ \App\Models\Setting::get('meta_title') }}">
                                    <small class="text-muted">Will be appended to page titles (e.g., "Page Name - Site
                                        Title")</small>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description"
                                        rows="3">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                                    <small class="text-muted">Recommended length: 150-160 characters</small>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords"
                                        value="{{ \App\Models\Setting::get('meta_keywords') }}">
                                    <small class="text-muted">Comma separated keyphrases</small>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">OpenGraph Image (Social Share)</label>
                                    <div class="mb-2 p-3 bg-light rounded border text-center" style="min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                        @if(\App\Models\Setting::get('og_image'))
                                            <img src="{{ image_url(\App\Models\Setting::get('og_image')) }}"
                                                alt="Social Share Image" class="img-fluid rounded" style="max-height: 200px">
                                        @else
                                            <span class="text-muted small">No social share image uploaded</span>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control" name="og_image">
                                    <small class="text-muted">Recommended size: 1200x630 pixels</small>
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