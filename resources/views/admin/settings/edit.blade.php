@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Edit Setting: {{ $setting->label }}</h5>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>
                    Back to Settings
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="key" class="form-label">Setting Key <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key', $setting->key) }}" placeholder="e.g., facebook_url" required>
                                <div class="form-text">Unique identifier for this setting (lowercase, underscores only)</div>
                                @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="label" class="form-label">Display Label <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label', $setting->label) }}" placeholder="e.g., Facebook URL" required>
                                @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="group" class="form-label">Group <span class="text-danger">*</span></label>
                                <select class="form-select @error('group') is-invalid @enderror" id="group" name="group" required>
                                    <option value="">Select Group</option>
                                    <option value="general" {{ old('group', $setting->group) == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="social" {{ old('group', $setting->group) == 'social' ? 'selected' : '' }}>Social Media</option>
                                    <option value="contact" {{ old('group', $setting->group) == 'contact' ? 'selected' : '' }}>Contact Information</option>
                                </select>
                                @error('group')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Input Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="text" {{ old('type', $setting->type) == 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="url" {{ old('type', $setting->type) == 'url' ? 'selected' : '' }}>URL</option>
                                    <option value="email" {{ old('type', $setting->type) == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="phone" {{ old('type', $setting->type) == 'phone' ? 'selected' : '' }}>Phone</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $setting->value) }}" placeholder="Enter the setting value">
                        @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Optional description for this setting">{{ old('description', $setting->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $setting->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i>
                            Update Setting
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection