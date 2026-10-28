@extends('admin.layout')

@section('title', 'Client Details - Admin Panel')

@section('content')
<div class="container-fluid">

    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.clients.index') }}">
                        <i class="fas fa-users"></i>Clients
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-user"></i>Client Details
                </li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Client Details</h1>
            <p class="text-muted">Detailed information about {{ $client->name }}</p>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        @if($client->profile_picture)
                        <img src="{{ asset('storage/' . $client->profile_picture) }}"
                            alt="Profile Picture" class="profile-image">
                        @else
                        <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <h4 class="font-weight-bold">{{ $client->name }}</h4>
                    <p class="text-muted">Client ID: {{ $client->id }}</p>

                    <div class="client-details mt-4">
                        @if($client->phone)
                        <div class="detail-item mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <strong>Phone:</strong> {{ $client->phone }}
                        </div>
                        @endif
                        <div class="detail-item mb-3">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <strong>Member Since:</strong> {{ $client->created_at->format('F j, Y') }}
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <strong>Last Login:</strong> {{ $client->updated_at->format('M j, Y g:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Estimations</span>
                            <span class="badge badge-primary">{{ $clientStats['total_estimations'] }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Spent</span>
                            <span class="badge badge-success">₹{{ number_format($clientStats['total_spent'], 2) }}</span>
                        </div>
                    </div>
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Average Estimation</span>
                            <span class="badge badge-info">₹{{ number_format($clientStats['average_estimation'], 2) }}</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Last Activity</span>
                            <small class="text-muted">{{ $clientStats['last_activity']->format('M j, Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Estimations</h6>
                    <span class="badge badge-primary">{{ $recentEstimations->count() }} Total</span>
                </div>
                <div class="card-body">
                    @if($recentEstimations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Estimation ID</th>
                                    <th>Event Date</th>
                                    <th>Guests</th>
                                    <th>Total Cost</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentEstimations as $estimation)
                                <tr>
                                    <td>
                                        <strong>#{{ $estimation->id }}</strong>
                                    </td>
                                    <td>
                                        {{ $estimation->event->event_date->format('M j, Y') }}
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $estimation->guest_count }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-success">₹{{ number_format($estimation->total_cost, 2) }}</strong>
                                    </td>
                                    <td>
                                        <div>{{ $estimation->created_at->format('M j, Y') }}</div>
                                        <small class="text-muted">{{ $estimation->created_at->format('g:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.estimations.show', $estimation->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="View Estimation Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-calculator fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-gray-600">No Estimations</h5>
                        <p class="text-muted">This client hasn't created any estimations yet.</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activity Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Account Created</h6>
                                <p class="timeline-text">Client registered on the platform</p>
                                <small class="text-muted">{{ $client->created_at->format('F j, Y \a\t g:i A') }}</small>
                            </div>
                        </div>

                        @foreach($recentEstimations->take(5) as $estimation)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Estimation Created</h6>
                                <p class="timeline-text">
                                    Created estimation #{{ $estimation->id }} for event on {{ $estimation->event->event_date->format('M j, Y') }}
                                    <br>
                                    <strong>Total Cost: ₹{{ number_format($estimation->total_cost, 2) }}</strong>
                                </p>
                                <small class="text-muted">{{ $estimation->created_at->format('F j, Y \a\t g:i A') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #962C50 0%, #802544 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto;
        box-shadow: 0 4px 15px rgba(150, 44, 80, 0.3);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .client-details .detail-item {
        text-align: left;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .client-details .detail-item:last-child {
        border-bottom: none;
    }

    .stat-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .badge {
        font-size: 0.75rem;
    }

    .table th {
        background-color: #f8f9fc;
        border-color: #e3e6f0;
        font-weight: 600;
        color: #5a5c69;
    }

    .table td {
        vertical-align: middle;
        border-color: #e3e6f0;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e3e6f0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }

    .timeline-marker {
        position: absolute;
        left: -22px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 0 3px #e3e6f0;
    }

    .timeline-content {
        background: #f8f9fc;
        padding: 1rem;
        border-radius: 8px;
        border-left: 4px solid #4e73df;
    }

    .timeline-title {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 0.5rem;
    }

    .timeline-text {
        color: #858796;
        margin-bottom: 0.5rem;
    }
</style>
@endsection