@extends('admin.layout')

@section('title', 'Settings')

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
                <i class="fas fa-cog"></i>Settings
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Settings</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="plus"></i>
            Add New Setting
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @foreach($groups as $groupName => $groupSettings)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    @switch($groupName)
                    @case('social')
                    <i class="fas fa-share-alt me-2"></i>Social Media Links
                    @break
                    @case('contact')
                    <i class="fas fa-phone me-2"></i>Contact Information
                    @break
                    @default
                    <i class="fas fa-cog me-2"></i>General Settings
                    @endswitch
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.bulk-update') }}" method="POST" class="settings-form">
                    @csrf
                    <div class="row">
                        @foreach($groupSettings as $setting)
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="setting_{{ $setting->id }}" class="form-label">
                                    {{ $setting->label }}
                                    @if($setting->description)
                                    <small class="text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </label>

                                @switch($setting->type)
                                @case('url')
                                <input type="url"
                                    class="form-control @error('settings.'.$setting->id.'.value') is-invalid @enderror"
                                    id="setting_{{ $setting->id }}"
                                    name="settings[{{ $setting->id }}][value]"
                                    value="{{ old('settings.'.$setting->id.'.value', $setting->value) }}"
                                    placeholder="https://example.com">
                                @break
                                @case('email')
                                <input type="email"
                                    class="form-control @error('settings.'.$setting->id.'.value') is-invalid @enderror"
                                    id="setting_{{ $setting->id }}"
                                    name="settings[{{ $setting->id }}][value]"
                                    value="{{ old('settings.'.$setting->id.'.value', $setting->value) }}"
                                    placeholder="example@email.com">
                                @break
                                @case('phone')
                                <input type="tel"
                                    class="form-control @error('settings.'.$setting->id.'.value') is-invalid @enderror"
                                    id="setting_{{ $setting->id }}"
                                    name="settings[{{ $setting->id }}][value]"
                                    value="{{ old('settings.'.$setting->id.'.value', $setting->value) }}"
                                    placeholder="+1 (555) 123-4567">
                                @break
                                @default
                                <input type="text"
                                    class="form-control @error('settings.'.$setting->id.'.value') is-invalid @enderror"
                                    id="setting_{{ $setting->id }}"
                                    name="settings[{{ $setting->id }}][value]"
                                    value="{{ old('settings.'.$setting->id.'.value', $setting->value) }}"
                                    placeholder="Enter {{ strtolower($setting->label) }}">
                                @endswitch

                                <input type="hidden" name="settings[{{ $setting->id }}][id]" value="{{ $setting->id }}">

                                @error('settings.'.$setting->id.'.value')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active_{{ $groupName }}"
                                @if($groupSettings->where('is_active', true)->count() === $groupSettings->count()) checked @endif>
                            <label class="form-check-label" for="is_active_{{ $groupName }}">
                                All settings in this group are active
                            </label>
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update {{ ucfirst($groupName) }} Settings
                            </button>
                            <a href="{{ route('admin.settings.create') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-plus me-1"></i>
                                Add Setting
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

        @if($settings->count() === 0)
        <div class="text-center py-4">
            <div class="mb-3">
                <i class="fas fa-cog display-1 text-muted"></i>
            </div>
            <h5 class="mb-2">No Settings Found</h5>
            <p class="text-muted mb-3">Get started by creating your first setting.</p>
            <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Add First Setting
            </a>
        </div>
        @endif
    </div>
</div>

@if($settings->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Settings</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Label</th>
                                <th>Group</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <td><code>{{ $setting->key }}</code></td>
                                <td>{{ $setting->label }}</td>
                                <td>
                                    <span class="badge bg-label-{{ $setting->group === 'social' ? 'info' : ($setting->group === 'contact' ? 'success' : 'primary') }}">
                                        {{ ucfirst($setting->group) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-label-secondary">{{ ucfirst($setting->type) }}</span>
                                </td>
                                <td>
                                    @if($setting->value)
                                    @if($setting->type === 'url')
                                    <a href="{{ $setting->value }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($setting->value, 30) }}
                                        <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                    @else
                                    {{ Str::limit($setting->value, 30) }}
                                    @endif
                                    @else
                                    <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($setting->is_active)
                                    <span class="badge bg-label-success">Active</span>
                                    @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.settings.show', $setting) }}">
                                                <i class="fas fa-eye me-1"></i> View
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.settings.edit', $setting) }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this setting?')">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection