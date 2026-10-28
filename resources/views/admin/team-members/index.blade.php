@extends('admin.layout')

@section('title', 'Team Members')

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
                <i class="fas fa-users"></i>Team Members
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Team Members</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="plus"></i>
            Add New Team Member
        </a>
    </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">All Team Members</h5>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('admin.team-members.index') }}" class="mb-4">
          <div class="row g-3">
            <div class="col-md-8">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by name or designation...">
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search me-1"></i> Search
                </button>
                <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-times me-1"></i> Clear
                </a>
              </div>
            </div>
          </div>
        </form>

        @if($teamMembers->count() > 0)
          <div class="row">
            @foreach($teamMembers as $member)
              <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-body text-center">
                    <div class="mb-3">
                      @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                      @else
                        <div class="avatar avatar-xl mx-auto mb-2">
                          <span class="avatar-initial rounded-circle bg-label-primary">
                            {{ substr($member->name, 0, 1) }}
                          </span>
                        </div>
                      @endif
                    </div>
                    <h5 class="card-title mb-1">{{ $member->name }}</h5>
                    <p class="text-muted mb-3">{{ $member->designation }}</p>
                    <div class="dropdown">
                      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.team-members.show', $member) }}">
                          <i class="fas fa-eye me-1"></i> View
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.team-members.edit', $member) }}">
                          <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this team member?')">
                            <i class="fas fa-trash me-1"></i> Delete
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-muted">
                    <small>Added {{ $member->created_at->format('M d, Y') }}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          @include('admin.components.pagination', ['paginator' => $teamMembers])

        @else
          <div class="text-center py-4">
            <div class="mb-3">
              <i class="fas fa-users display-1 text-muted"></i>
            </div>
            <h5 class="mb-2">No Team Members Found</h5>
            <p class="text-muted mb-3">Get started by adding your first team member.</p>
            <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">
              <i class="fas fa-plus me-1"></i>
              Add First Team Member
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
