@extends('layouts.backend.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">My Profile</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <!-- Profile Information -->
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <h6 class="mb-4">Profile Information</h6>
                        <p class="text-muted mb-4">Update your account's profile information and email address.</p>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="mb-4">
                                <label class="form-label">Profile Image</label>
                                <div class="d-flex align-items-center gap-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile" class="rounded-circle"
                                            width="60" height="60" style="object-fit: cover">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-secondary"
                                            style="width: 60px; height: 60px;">
                                            <i class="feather-user fs-4"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <input type="file" class="form-control" name="avatar" accept="image/*">
                                        <div class="form-text small">Accepted formats: jpeg, png, jpg, gif, svg. Max size:
                                            2MB.</div>
                                    </div>
                                </div>
                                @error('avatar')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-muted small">
                                            Your email address is unverified.
                                            <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                                                Click here to re-send the verification email.
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="text-success small mt-2">
                                                A new verification link has been sent to your email address.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                @if (session('status') === 'profile-updated')
                                    <span class="text-muted small fade-out">Saved.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <h6 class="mb-4">Update Password</h6>
                        <p class="text-muted mb-4">Ensure your account is using a long, random password to stay secure.</p>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    autocomplete="current-password">
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary">Save Password</button>
                                @if (session('status') === 'password-updated')
                                    <span class="text-muted small fade-out">Saved.</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <h6 class="mb-4 text-danger">Delete Account</h6>
                        <p class="text-muted mb-4">Once your account is deleted, all of its resources and data will be
                            permanently deleted. Before deleting your account, please download any data or information that
                            you wish to retain.</p>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmUserDeletionModal">
                            Delete Account
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1"
                            aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                                    @csrf
                                    @method('delete')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">Are you sure you want to
                                            delete your account?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-muted">Once your account is deleted, all of its resources and data
                                            will be permanently deleted. Please enter your password to confirm you would
                                            like to permanently delete your account.</p>

                                        <div class="mb-3">
                                            <label for="password_delete" class="form-label visually-hidden">Password</label>
                                            <input type="password" class="form-control" id="password_delete" name="password"
                                                placeholder="Password" required>
                                            @error('password', 'userDeletion')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fade-out {
            animation: fadeOut 2s forwards;
            animation-delay: 1s;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
@endsection