@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<div class="breadcrumb-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-home"></i>Dashboard
      </li>
    </ol>
  </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
  <div class="btn-toolbar mb-2 mb-md-0 d-none">
    <div class="btn-group me-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-primary dropdown-toggle">
      <i class="fas fa-calendar-alt me-1"></i>
      This week
    </button>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="text-muted mb-1">Total Clients</h6>
            <h3 class="mb-0"><span class="counter" data-target="{{ (int)($kpis['total_clients'] ?? 0) }}">0</span></h3>
          </div>
          <div class="text-primary"><i class="fas fa-users fa-2x"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="text-muted mb-1">Estimations</h6>
            <h3 class="mb-0"><span class="counter" data-target="{{ (int)($kpis['total_estimations'] ?? 0) }}">0</span></h3>
          </div>
          <div class="text-info"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="text-muted mb-1">Revenue (This Month)</h6>
            <h3 class="mb-0">₹<span class="counter" data-target="{{ (int)round($kpis['revenue_this_month'] ?? 0) }}">0</span></h3>
          </div>
          <div class="text-success"><i class="fas fa-rupee-sign fa-2x"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="text-muted mb-1">Avg Estimation</h6>
            <h3 class="mb-0">₹<span class="counter" data-target="{{ (int)round($kpis['avg_estimation'] ?? 0) }}">0</span></h3>
          </div>
          <div class="text-warning"><i class="fas fa-chart-line fa-2x"></i></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <h6 class="text-muted mb-1">Event Teams</h6>
        <h4 class="mb-0"><span class="counter" data-target="{{ (int)($stats['event_teams'] ?? 0) }}">0</span></h4>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <h6 class="text-muted mb-1">Categories</h6>
        <h4 class="mb-0"><span class="counter" data-target="{{ (int)($stats['categories'] ?? 0) }}">0</span></h4>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <h6 class="text-muted mb-1">Decoration Items</h6>
        <h4 class="mb-0"><span class="counter" data-target="{{ (int)($stats['decoration_items'] ?? 0) }}">0</span></h4>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card h-100 fade-in">
      <div class="card-body">
        <h6 class="text-muted mb-1">Service Items</h6>
        <h4 class="mb-0"><span class="counter" data-target="{{ (int)($stats['service_items'] ?? 0) }}">0</span></h4>
      </div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-7">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Estimations (Last 6 Months)</h5>
      </div>
      <div class="card-body" style="height: 260px;">
        <canvas id="estimationsChart" style="height: 100%; width: 100%;"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Revenue (Last 6 Months)</h5>
      </div>
      <div class="card-body" style="height: 260px;">
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

    (function setupFadeIn() {
      const els = document.querySelectorAll('.fade-in');
      const onIntersect = (entries, obs) => entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('show');
          obs.unobserve(e.target);
        }
      });
      const io = new IntersectionObserver(onIntersect, {
        threshold: 0.15
      });
      els.forEach(el => io.observe(el));
    })();

    (function animateCounters() {
      const counters = document.querySelectorAll('.counter');
      counters.forEach(el => {
        const target = parseInt(el.getAttribute('data-target') || '0', 10);
        const durationMs = 1200;
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

    const estCtx = document.getElementById('estimationsChart');
    if (estCtx) {
      new Chart(estCtx, {
        type: 'line',
        data: {
          labels,
          datasets: [{
            label: 'Estimations',
            data: estimations,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.15)',
            tension: 0.3,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: {
            duration: 1000,
            easing: 'easeOutQuart'
          },
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }

    const revCtx = document.getElementById('revenueChart');
    if (revCtx) {
      new Chart(revCtx, {
        type: 'bar',
        data: {
          labels,
          datasets: [{
            label: 'Revenue (₹)',
            data: revenue,
            backgroundColor: 'rgba(25, 135, 84, 0.6)',
            borderColor: '#198754',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: {
            duration: 1000,
            easing: 'easeOutQuart'
          },
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  });
</script>
@endpush

@endsection