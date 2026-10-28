@extends('admin.layout')

@section('title', 'Event Teams')

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
                <i class="fas fa-user-friends"></i>Event Teams
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Event Teams</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.event-teams.create') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="plus"></i>
            Add New Team
        </a>
    </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">All Event Teams</h5>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('admin.event-teams.index') }}" class="mb-4">
          <div class="row g-3">
            <div class="col-md-8">
              <div class="input-group">
                <span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by team name or district...">
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="align-middle me-1" data-feather="search"></i> Search
                </button>
                <a href="{{ route('admin.event-teams.index') }}" class="btn btn-outline-secondary">
                  <i class="align-middle me-1" data-feather="x"></i> Clear
                </a>
              </div>
            </div>
          </div>
        </form>

        @if($eventTeams->count() > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Districts</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($eventTeams as $team)
                  <tr>
                    <td>{{ $team->id }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm me-2">
                          <span class="avatar-initial rounded bg-label-primary">{{ substr($team->name, 0, 1) }}</span>
                        </div>
                        <div>
                          <h6 class="mb-0">{{ $team->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      @if($team->districts->count() > 0)
                        <div class="d-flex flex-wrap gap-1">
                          @foreach($team->districts->take(3) as $district)
                            <span class="badge bg-label-info">{{ $district->name }}</span>
                          @endforeach
                          @if($team->districts->count() > 3)
                            <span class="badge bg-label-secondary">+{{ $team->districts->count() - 3 }} more</span>
                          @endif
                        </div>
                      @else
                        <span class="text-muted">No districts assigned</span>
                      @endif
                    </td>
                    <td>{{ $team->created_at->format('M d, Y') }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('admin.event-teams.show', $team) }}">
                            <i class="align-middle me-1" data-feather="eye"></i> View
                          </a>
                          <a class="dropdown-item" href="{{ route('admin.event-teams.edit', $team) }}">
                            <i class="align-middle me-1" data-feather="edit"></i> Edit
                          </a>
                          <div class="dropdown-divider"></div>
                          <form action="{{ route('admin.event-teams.destroy', $team) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this team?')">
                              <i class="align-middle me-1" data-feather="trash-2"></i> Delete
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

          @include('admin.components.pagination', ['paginator' => $eventTeams])

        @else
          <div class="text-center py-4">
            <div class="mb-3">
              <i class="align-middle" data-feather="users" style="width: 64px; height: 64px;" class="text-muted"></i>
            </div>
            <h5 class="mb-2">No Event Teams Found</h5>
            <p class="text-muted mb-3">Get started by creating your first event team.</p>
            <a href="{{ route('admin.event-teams.create') }}" class="btn btn-primary">
              <i class="align-middle me-1" data-feather="plus"></i>
              Add First Team
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
