@extends('admin.layout')

@section('title', 'Executive Dashboard')

@section('content')

<div class="breadcrumb-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-tachometer-alt me-1"></i> Dashboard Overview
      </li>
    </ol>
  </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-3 mb-3 border-bottom">
  <div>
    <h1 class="h3 font-display mb-1 text-forest">Performance Overview</h1>
    <p class="text-muted small mb-0">Real-time statistics on client inquiries, event estimations, and catalog management.</p>
  </div>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{ route('public.home') }}" target="_blank" class="btn btn-sm btn-outline-primary">
      <i class="fas fa-external-link-alt me-1"></i> View Public Website
    </a>
  </div>
</div>

<!-- Key Performance Indicators (KPIs) -->
<div class="row g-3 mb-4">
  <div class="col-xl-3 col-sm-6">
    <div class="card kpi-stat-card h-100 fade-in">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="kpi-stat-label">Total Clients</span>
        <div class="stat-icon-wrap">
          <i class="fas fa-users"></i>
        </div>
      </div>
      <div class="kpi-stat-value"><span class="counter" data-target="{{ (int)($kpis['total_clients'] ?? 0) }}">0</span></div>
      <small class="text-muted"><i class="fas fa-check-circle text-success me-1"></i>Registered Hosts</small>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6">
    <div class="card kpi-stat-card gold-theme h-100 fade-in">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="kpi-stat-label">Total Estimations</span>
        <div class="stat-icon-wrap">
          <i class="fas fa-calculator"></i>
        </div>
      </div>
      <div class="kpi-stat-value"><span class="counter" data-target="{{ (int)($kpis['total_estimations'] ?? 0) }}">0</span></div>
      <small class="text-muted"><i class="fas fa-chart-line text-gold me-1"></i>Generated Quotes</small>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6">
    <div class="card kpi-stat-card h-100 fade-in">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="kpi-stat-label">Revenue (This Month)</span>
        <div class="stat-icon-wrap text-success" style="background: rgba(38, 115, 77, 0.1);">
          <i class="fas fa-rupee-sign"></i>
        </div>
      </div>
      <div class="kpi-stat-value">₹<span class="counter" data-target="{{ (int)round($kpis['revenue_this_month'] ?? 0) }}">0</span></div>
      <small class="text-muted"><i class="fas fa-calendar-alt text-muted me-1"></i>{{ now()->format('F Y') }}</small>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6">
    <div class="card kpi-stat-card gold-theme h-100 fade-in">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="kpi-stat-label">Average Estimate</span>
        <div class="stat-icon-wrap text-gold">
          <i class="fas fa-wallet"></i>
        </div>
      </div>
      <div class="kpi-stat-value">₹<span class="counter" data-target="{{ (int)round($kpis['avg_estimation'] ?? 0) }}">0</span></div>
      <small class="text-muted"><i class="fas fa-balance-scale text-gold me-1"></i>Per Event Average</small>
    </div>
  </div>
</div>

<!-- Catalog Overview Stats -->
<div class="row g-3 mb-4">
  <div class="col-md-3 col-6">
    <div class="card h-100 p-3 fade-in">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle p-2 bg-forest-subtle text-forest">
          <i class="fas fa-users-cog fs-5"></i>
        </div>
        <div>
          <h4 class="mb-0 fw-bold"><span class="counter" data-target="{{ (int)($stats['event_teams'] ?? 0) }}">0</span></h4>
          <span class="small text-muted">Event Teams</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-6">
    <div class="card h-100 p-3 fade-in">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle p-2 bg-gold-subtle text-gold">
          <i class="fas fa-tags fs-5"></i>
        </div>
        <div>
          <h4 class="mb-0 fw-bold"><span class="counter" data-target="{{ (int)($stats['categories'] ?? 0) }}">0</span></h4>
          <span class="small text-muted">Categories</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-6">
    <div class="card h-100 p-3 fade-in">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle p-2 bg-forest-subtle text-forest">
          <i class="fas fa-palette fs-5"></i>
        </div>
        <div>
          <h4 class="mb-0 fw-bold"><span class="counter" data-target="{{ (int)($stats['decoration_items'] ?? 0) }}">0</span></h4>
          <span class="small text-muted">Decor Items</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-6">
    <div class="card h-100 p-3 fade-in">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle p-2 bg-gold-subtle text-gold">
          <i class="fas fa-cogs fs-5"></i>
        </div>
        <div>
          <h4 class="mb-0 fw-bold"><span class="counter" data-target="{{ (int)($stats['service_items'] ?? 0) }}">0</span></h4>
          <span class="small text-muted">Service Items</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Analytical Charts -->
<div class="row g-3">
  <div class="col-lg-7">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0"><i class="fas fa-chart-line text-forest me-2"></i>Estimations Trend (Last 6 Months)</h5>
      </div>
      <div class="card-body" style="height: 280px;">
        <canvas id="estimationsChart" style="height: 100%; width: 100%;"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0"><i class="fas fa-chart-bar text-gold me-2"></i>Projected Revenue (₹)</h5>
      </div>
      <div class="card-body" style="height: 280px;">
        <canvas id="revenueChart" style="height: 100%; width: 100%;"></canvas>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($chartLabels ?? []);
    const estimations = @json($monthlyEstimations ?? []);
    const revenue = @json($monthlyRevenue ?? []);

    // Animate KPI Counters
    (function animateCounters() {
      const counters = document.querySelectorAll('.counter');
      counters.forEach(el => {
        const target = parseInt(el.getAttribute('data-target') || '0', 10);
        const durationMs = 1000;
        const frameMs = 16;
        const steps = Math.max(1, Math.floor(durationMs / frameMs));
        let current = 0;
        const increment = target / steps;
        const timer = setInterval(() => {
          current += increment;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          el.textContent = Math.floor(current).toLocaleString();
        }, frameMs);
      });
    })();

    // Estimations Line Chart
    const estCtx = document.getElementById('estimationsChart');
    if (estCtx) {
      new Chart(estCtx, {
        type: 'line',
        data: {
          labels,
          datasets: [{
            label: 'Estimations',
            data: estimations,
            borderColor: '#263D32',
            backgroundColor: 'rgba(38, 61, 50, 0.10)',
            borderWidth: 2.5,
            pointBackgroundColor: '#B9975B',
            pointBorderColor: '#FFFFFF',
            pointBorderWidth: 2,
            pointRadius: 4,
            tension: 0.35,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#20211F',
              titleFont: { family: 'Inter' },
              bodyFont: { family: 'Inter' }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: 'rgba(0,0,0,0.05)' }
            },
            x: {
              grid: { display: false }
            }
          }
        }
      });
    }

    // Revenue Bar Chart
    const revCtx = document.getElementById('revenueChart');
    if (revCtx) {
      new Chart(revCtx, {
        type: 'bar',
        data: {
          labels,
          datasets: [{
            label: 'Revenue (₹)',
            data: revenue,
            backgroundColor: '#B9975B',
            hoverBackgroundColor: '#A07F43',
            borderRadius: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#20211F',
              titleFont: { family: 'Inter' },
              bodyFont: { family: 'Inter' }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: 'rgba(0,0,0,0.05)' }
            },
            x: {
              grid: { display: false }
            }
          }
        }
      });
    }
  });
</script>
@endpush

@endsection
