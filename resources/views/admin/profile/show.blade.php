@extends('admin.layout')

@section('title', 'My Profile')

@section('content')

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-user"></i>My Profile
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Profile</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="edit"></i>
            Edit Profile
        </a>
    </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Profile Information</h5>
      </div>
      <div class="card-body">
        <div class="row">

          <div class="col-md-4 text-center mb-4">
            <div class="profile-picture-container">
              @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                     alt="Profile Picture"
                     class="rounded-circle shadow-lg mb-3"
                     style="width: 150px; height: 150px; object-fit: cover;">
              @else
                <div class="avatar avatar-xxl mb-3">
                  <span class="avatar-initial rounded-circle bg-primary text-white shadow-lg d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; font-size: 3rem;">
                    {{ substr($user->name, 0, 1) }}
                  </span>
                </div>
              @endif
              <h4 class="mb-1">{{ $user->name }}</h4>
              <p class="text-muted mb-0">{{ $user->email }}</p>
              @if($user->is_admin)
                <span class="badge bg-success mt-2">
                  <i class="align-middle me-1" data-feather="shield"></i>
                  Administrator
                </span>
              @endif
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-12 mb-4">
                <h6 class="text-muted text-uppercase mb-3">
                  <i class="align-middle me-2" data-feather="info"></i>
                  Personal Information
                </h6>
                <div class="row g-3">
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Full Name</label>
                    <div class="form-control-plaintext">{{ $user->name }}</div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="form-control-plaintext">{{ $user->email }}</div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Account Type</label>
                    <div class="form-control-plaintext">
                      @if($user->is_admin)
                        <span class="badge bg-success">
                          <i class="align-middle me-1" data-feather="shield"></i>
                          Administrator
                        </span>
                      @else
                        <span class="badge bg-info">
                          <i class="align-middle me-1" data-feather="user"></i>
                          User
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Member Since</label>
                    <div class="form-control-plaintext">
                      <i class="align-middle me-1" data-feather="calendar"></i>
                      {{ $user->created_at->format('F d, Y') }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <h6 class="text-muted text-uppercase mb-3">
                  <i class="align-middle me-2" data-feather="shield"></i>
                  Security Information
                </h6>
                <div class="row g-3">
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Last Updated</label>
                    <div class="form-control-plaintext">
                      <i class="align-middle me-1" data-feather="clock"></i>
                      {{ $user->updated_at->format('F d, Y \a\t g:i A') }}
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label fw-semibold">Password Status</label>
                    <div class="form-control-plaintext">
                      <span class="badge bg-success">
                        <i class="align-middle me-1" data-feather="check"></i>
                        Secured
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h6 class="text-muted text-uppercase mb-3">
              <i class="align-middle me-2" data-feather="zap"></i>
              Quick Actions
            </h6>
            <div class="d-flex gap-2 flex-wrap">
              <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                <i class="align-middle me-1" data-feather="edit"></i>
                Edit Profile
              </a>
              @if($user->profile_picture)
                <form action="{{ route('admin.profile.remove-picture') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger"
                          onclick="return confirm('Are you sure you want to remove your profile picture?')">
                    <i class="align-middle me-1" data-feather="trash-2"></i>
                    Remove Picture
                  </button>
                </form>
              @endif
              <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="align-middle me-1" data-feather="arrow-left"></i>
                Back to Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
