@extends('admin.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
          <i class="fas fa-edit me-2"></i>
          Edit Profile
        </h5>
        <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
          <i class="fas fa-arrow-left me-1"></i>
          Back to Profile
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">

            <div class="col-md-4 mb-4">
              <div class="text-center">
                <h6 class="text-muted text-uppercase mb-3">
                  <i class="fas fa-camera me-2"></i>
                  Profile Picture
                </h6>

                <div class="mb-3">
                  @if($user->profile_picture)
                    <img src="{{ Storage::url($user->profile_picture) }}"
                         alt="Current Profile Picture"
                         class="rounded-circle shadow-lg mb-3"
                         style="width: 120px; height: 120px; object-fit: cover;"
                         id="current-picture">
                  @else
                    <div class="avatar avatar-xxl mb-3">
                      <span class="avatar-initial rounded-circle bg-label-primary shadow-lg">
                        <i class="fas fa-user fs-1"></i>
                      </span>
                    </div>
                  @endif
                </div>

                <div class="mb-3">
                  <input type="file"
                         class="form-control @error('profile_picture') is-invalid @enderror"
                         id="profile_picture"
                         name="profile_picture"
                         accept="image/*"
                         onchange="previewImage(this)">
                  @error('profile_picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div id="image-preview" class="mb-3" style="display: none;">
                  <img id="preview-img" class="rounded-circle shadow-lg"
                       style="width: 120px; height: 120px; object-fit: cover;">
                  <p class="text-muted small mt-2">Preview</p>
                </div>

                <small class="text-muted">
                  <i class="fas fa-info-circle me-1"></i>
                  JPG, PNG, GIF up to 2MB
                </small>
              </div>
            </div>

            <div class="col-md-8">

              <div class="mb-4">
                <h6 class="text-muted text-uppercase mb-3">
                  <i class="fas fa-user me-2"></i>
                  Personal Information
                </h6>

                <div class="row g-3">
                  <div class="col-12">
                    <label for="name" class="form-label fw-semibold">
                      Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           required>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="email" class="form-label fw-semibold">
                      Email Address <span class="text-danger">*</span>
                    </label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           required>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <h6 class="text-muted text-uppercase mb-3">
                  <i class="fas fa-lock me-2"></i>
                  Change Password
                </h6>
                <p class="text-muted small mb-3">
                  <i class="fas fa-info-circle me-1"></i>
                  Leave password fields empty if you don't want to change your password.
                </p>

                <div class="row g-3">
                  <div class="col-12">
                    <label for="current_password" class="form-label fw-semibold">
                      Current Password
                    </label>
                    <input type="password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password"
                           name="current_password">
                    @error('current_password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-sm-6">
                    <label for="password" class="form-label fw-semibold">
                      New Password
                    </label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password">
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-sm-6">
                    <label for="password_confirmation" class="form-label fw-semibold">
                      Confirm New Password
                    </label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation">
                  </div>
                </div>
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save me-1"></i>
                  Update Profile
                </button>
                <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-times me-1"></i>
                  Cancel
                </a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function previewImage(input) {
  const preview = document.getElementById('image-preview');
  const previewImg = document.getElementById('preview-img');
  const currentPicture = document.getElementById('current-picture');

  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function(e) {
      previewImg.src = e.target.result;
      preview.style.display = 'block';
      if (currentPicture) {
        currentPicture.style.display = 'none';
      }
    }

    reader.readAsDataURL(input.files[0]);
  } else {
    preview.style.display = 'none';
    if (currentPicture) {
      currentPicture.style.display = 'block';
    }
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const passwordField = document.getElementById('password');
  const currentPasswordField = document.getElementById('current_password');
  const confirmPasswordField = document.getElementById('password_confirmation');

  function toggleCurrentPasswordRequired() {
    if (passwordField.value.length > 0) {
      currentPasswordField.required = true;
    } else {
      currentPasswordField.required = false;
    }
  }

  passwordField.addEventListener('input', toggleCurrentPasswordRequired);

  confirmPasswordField.addEventListener('input', function() {
    if (this.value !== passwordField.value) {
      this.setCustomValidity('Passwords do not match');
    } else {
      this.setCustomValidity('');
    }
  });
});
</script>
@endsection
