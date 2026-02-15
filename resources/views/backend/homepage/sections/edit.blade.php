@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manage Section: {{ $section->heading }}</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.homepage-sections.index') }}">Homepage Sections</a>
                </li>
                <li class="breadcrumb-item">Manage</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Section Details -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Section Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.homepage-sections.update', $section) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $section->heading }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Section Key (Reference Only)</label>
                                    <input type="text" class="form-control" value="{{ $section->section_key }}" disabled>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"
                                        rows="3">{{ $section->description }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $section->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Section</button>
                        </form>
                    </div>
                </div>

                <!-- Section Cards -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Section Cards</h5>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addCardModal">
                            <i class="feather-plus"></i> Add Card
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($section->cards as $card)
                                <div class="col-md-6 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @if($card->image)
                                                        <img src="{{ str_contains($card->image, 'http') ? $card->image : asset('storage/' . $card->image) }}"
                                                            class="img-fluid rounded" alt="Card Image">
                                                    @else
                                                        <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                            style="height: 60px;">
                                                            <span class="text-muted small">No Image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-9">
                                                    <h6>{{ $card->heading }}</h6>
                                                    <p class="small text-muted">{{ Str::limit($card->description, 200) }}</p>
                                                    <div class="d-flex gap-2">
                                                        <!-- Edit Button only -->
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editCardModal{{ $card->id }}">Edit</button>
                                                        <form action="{{ route('admin.homepage-cards.destroy', $card) }}"
                                                            method="POST" onsubmit="return confirm('Delete this card?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <!-- Modals Section -->
        @foreach($section->cards as $card)
            <!-- Edit Card Modal -->
            <div class="modal fade" id="editCardModal{{ $card->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('admin.homepage-cards.update', $card) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Card</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $card->heading }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ $card->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    @if($card->image)
                                        <div class="mb-2">
                                            <img src="{{ str_contains($card->image, 'http') ? $card->image : asset('storage/' . $card->image) }}"
                                                alt="current" style="max-height: 100px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" name="image">
                                    <div class="form-text text-muted">Ideal size: 600x400px. Leave empty to keep current image.
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Add Card Modal -->
        <div class="modal fade" id="addCardModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.homepage-sections.cards.store', $section) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Card</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="text" class="form-control" name="heading" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                                <div class="form-text text-muted">Ideal size: 600x400px.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Card</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
@endsection