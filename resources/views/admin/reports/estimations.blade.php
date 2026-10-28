@extends('admin.layout')

@section('title', 'Estimation Reports - Admin Panel')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Estimation Reports</h1>
            <p class="text-muted">Comprehensive analysis and statistics of all estimations</p>
        </div>
        <div>
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.estimations') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Estimations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_estimations'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calculator fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($stats['total_revenue'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Average Estimation</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($stats['average_estimation'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Guests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_guests']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Breakdown</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Count</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($monthlyData as $month)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($month->month . '-01')->format('F Y') }}</td>
                                    <td><span class="badge badge-primary">{{ $month->count }}</span></td>
                                    <td><strong class="text-success">₹{{ number_format($month->revenue, 2) }}</strong></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category Breakdown</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><strong>Food</strong></span>
                            <span class="text-success">₹{{ number_format($categoryStats['total_food_cost'], 2) }}
                                <small class="text-muted">({{ $stats['total_revenue'] > 0 ? number_format($categoryStats['total_food_cost'] / $stats['total_revenue'] * 100, 1) : 0 }}%)</small>
                            </span>
                        </div>
                        <div class="progress" style="height: 25px; background-color: #e9ecef;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $stats['total_revenue'] > 0 ? ($categoryStats['total_food_cost'] / $stats['total_revenue'] * 100) : 0 }}%"
                                aria-valuenow="{{ $stats['total_revenue'] > 0 ? ($categoryStats['total_food_cost'] / $stats['total_revenue'] * 100) : 0 }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><strong>Decoration</strong></span>
                            <span class="text-primary">₹{{ number_format($categoryStats['total_decoration_cost'], 2) }}
                                <small class="text-muted">({{ $stats['total_revenue'] > 0 ? number_format($categoryStats['total_decoration_cost'] / $stats['total_revenue'] * 100, 1) : 0 }}%)</small>
                            </span>
                        </div>
                        <div class="progress" style="height: 25px; background-color: #e9ecef;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $stats['total_revenue'] > 0 ? ($categoryStats['total_decoration_cost'] / $stats['total_revenue'] * 100) : 0 }}%"
                                aria-valuenow="{{ $stats['total_revenue'] > 0 ? ($categoryStats['total_decoration_cost'] / $stats['total_revenue'] * 100) : 0 }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><strong>Service</strong></span>
                            <span class="text-warning">₹{{ number_format($categoryStats['total_service_cost'], 2) }}
                                <small class="text-muted">({{ $stats['total_revenue'] > 0 ? number_format($categoryStats['total_service_cost'] / $stats['total_revenue'] * 100, 1) : 0 }}%)</small>
                            </span>
                        </div>
                        <div class="progress" style="height: 25px; background-color: #e9ecef;">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $stats['total_revenue'] > 0 ? ($categoryStats['total_service_cost'] / $stats['total_revenue'] * 100) : 0 }}%"
                                aria-valuenow="{{ $stats['total_revenue'] > 0 ? ($categoryStats['total_service_cost'] / $stats['total_revenue'] * 100) : 0 }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><strong>Catering Boys</strong></span>
                            <span class="text-info">₹{{ number_format($stats['catering_revenue'], 2) }}
                                <small class="text-muted">({{ $stats['total_revenue'] > 0 ? number_format($stats['catering_revenue'] / $stats['total_revenue'] * 100, 1) : 0 }}%)</small>
                            </span>
                        </div>
                        <div class="progress" style="height: 25px; background-color: #e9ecef;">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ $stats['total_revenue'] > 0 ? ($stats['catering_revenue'] / $stats['total_revenue'] * 100) : 0 }}%"
                                aria-valuenow="{{ $stats['total_revenue'] > 0 ? ($stats['catering_revenue'] / $stats['total_revenue'] * 100) : 0 }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1">{{ $stats['with_catering'] }} estimations with catering</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row mb-4">

            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Revenue Chart</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyRevenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Category Breakdown Chart</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height:300px;">
                            <canvas id="categoryBreakdownChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Top 10 Clients by Spending</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Estimations</th>
                            <th>Total Spent</th>
                            <th>Average</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topClients as $index => $client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client->user_id) }}">
                                    {{ $client->user->name }}
                                </a>
                            </td>
                            <td><span class="badge badge-info">{{ $client->estimation_count }}</span></td>
                            <td><strong class="text-success">₹{{ number_format($client->total_spent, 2) }}</strong></td>
                            <td>₹{{ number_format($client->total_spent / $client->estimation_count, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent Estimations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Event Date</th>
                            <th>Guests</th>
                            <th>Total Cost</th>
                            <th>Catering</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEstimations as $estimation)
                        <tr>
                            <td><strong>#{{ $estimation->id }}</strong></td>
                            <td>
                                <a href="{{ route('admin.clients.show', $estimation->user_id) }}">
                                    {{ $estimation->user->name }}
                                </a>
                            </td>
                            <td>{{ $estimation->event->event_date->format('M j, Y') }}</td>
                            <td><span class="badge badge-info">{{ $estimation->guest_count }}</span></td>
                            <td><strong class="text-success">₹{{ number_format($estimation->total_cost, 2) }}</strong></td>
                            <td>
                                @if($estimation->catering_boys)
                                <span class="badge badge-success">Yes</span>
                                @else
                                <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td>{{ $estimation->created_at->format('M j, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.estimations.show', $estimation->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No estimations found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $recentEstimations->appends(['start_date' => $startDate, 'end_date' => $endDate])->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    const monthlyLabels = @json($monthlyData->pluck('month')->map(function($m){ return \Carbon\Carbon::parse($m . '-01')->format('F Y'); }));
    const monthlyRevenue = @json($monthlyData->pluck('revenue'));
    const ctxMonthly = document.getElementById('monthlyRevenueChart').getContext('2d');
    new Chart(ctxMonthly, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Revenue (₹)',
                data: monthlyRevenue,
                backgroundColor: 'rgba(78, 115, 223, 0.7)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const categoryLabels = ['Food', 'Decoration', 'Service', 'Catering Boys'];
    const categoryValues = [
        {{ $categoryStats['total_food_cost'] }},
        {{ $categoryStats['total_decoration_cost'] }},
        {{ $categoryStats['total_service_cost'] }},
        {{ $stats['catering_revenue'] }}
    ];
    const ctxCategory = document.getElementById('categoryBreakdownChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryValues,
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(54, 185, 204, 0.7)',
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(23, 162, 184, 0.7)'
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
@endsection

@section('styles')
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .card-body .progress {
        overflow: hidden;
        display: flex;
        height: 25px;
        font-size: .75rem;
        background-color: #e9ecef;
        border-radius: 0.25rem;
    }

    .card-body .progress-bar {
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        background-color: #007bff;
        transition: width 0.6s ease;
    }

    .progress-bar.bg-success {
        background-color: #28a745 !important;
    }

    .progress-bar.bg-primary {
        background-color: #962C50 !important;
    }

    .progress-bar.bg-warning {
        background-color: #ffc107 !important;
    }

    .progress-bar.bg-info {
        background-color: #17a2b8 !important;
    }

    .card-body .d-flex {
        flex-wrap: wrap;
    }

    .card-body strong {
        word-break: break-word;
    }

    @media print {
        .btn, .breadcrumb-container {
            display: none !important;
        }
    }
</style>
@endsection
