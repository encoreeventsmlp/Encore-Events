@extends('admin.layout')

@section('title', 'Estimation Details - Admin Panel')

@section('content')
<div class="container-fluid">
    <style>
        @media print {

            .print-hide,
            .breadcrumb-container,
            .btn,
            .btn-group,
            .card .card-header .mb-0 i {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }

            .card-header.print-border {
                border-bottom: 1px solid #ccc !important;
                background: #f8f9fa !important;
                color: #000 !important;
            }

            .table {
                border-color: #ccc !important;
            }

            .table thead th {
                background: #f1f1f1 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            body {
                background: #fff !important;
            }
        }
    </style>

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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.clients.show', $estimation->user->id) }}">
                        <i class="fas fa-user"></i>Client Details
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-calculator"></i>Estimation Details
                </li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4 print-hide">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Estimation Details</h1>
            <p class="text-muted">Complete breakdown of estimation #{{ $estimation->id }}</p>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Print
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white print-border">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Client Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Client Name:</strong><br>
                            {{ $estimation->user->name }}
                        </div>
                        <div class="col-md-3">
                            <strong>Email:</strong><br>
                            {{ $estimation->user->email }}
                        </div>
                        <div class="col-md-3">
                            <strong>Phone:</strong><br>
                            {{ $estimation->user->phone ?? 'N/A' }}
                        </div>
                        <div class="col-md-3">
                            <strong>Event Date:</strong><br>
                            {{ $estimation->event->event_date ? $estimation->event->event_date->format('M j, Y') : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white print-border">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6"><strong>Estimation ID:</strong></div>
                        <div class="col-6">#{{ $estimation->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Guest Count:</strong></div>
                        <div class="col-6">{{ $estimation->guest_count }} guests</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Catering Boys:</strong></div>
                        <div class="col-6">
                            <span class="badge {{ $estimation->catering_boys ? 'bg-success' : 'bg-secondary' }}">
                                {{ $estimation->catering_boys ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>
                    @if($estimation->catering_boys && $estimation->seating)
                    <div class="row mb-3">
                        <div class="col-6"><strong>Selected Seating:</strong></div>
                        <div class="col-6">
                            {{ $estimation->seating->title }}
                            <br>
                            <small class="text-muted">@money($estimation->seating->catering_boy_per_head) / head</small>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-6"><strong>District:</strong></div>
                        <div class="col-6">{{ $estimation->event->district->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Created:</strong></div>
                        <div class="col-6">{{ $estimation->created_at->format('M j, Y g:i A') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Last Updated:</strong></div>
                        <div class="col-6">{{ $estimation->updated_at->format('M j, Y g:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white print-border">
                    <h6 class="mb-0"><i class="fas fa-rupee-sign me-2"></i>Cost Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6"><strong>Food Cost:</strong></div>
                        <div class="col-6">@money($estimation->food_cost)</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Decoration Cost:</strong></div>
                        <div class="col-6">@money($estimation->decoration_cost)</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Service Cost:</strong></div>
                        <div class="col-6">@money($estimation->service_cost)</div>
                    </div>
                    @if($estimation->catering_boys)
                    <div class="row mb-3">
                        <div class="col-6"><strong>Catering Boys Cost:</strong></div>
                        <div class="col-6">@money($estimation->catering_boys_cost)</div>
                    </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-6"><strong>Total Cost:</strong></div>
                        <div class="col-6"><strong class="text-success h5">@money($estimation->total_cost)</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-dark print-border">
                    <h6 class="mb-0"><i class="fas fa-list me-2"></i>Selected Items Details</h6>
                </div>
                <div class="card-body">
                    @if($estimation->decoration_items && count($estimation->decoration_items) > 0)

                    <div class="mb-4">
                        <h6 class="text-primary"><i class="fas fa-palette me-2"></i>Decoration Items ({{ $estimation->decoration_items_count }} items)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Qty × Unit</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estimation->decoration_items as $item)
                                    <tr>
                                        <td>{{ $item['title'] ?? $item['name'] ?? 'N/A' }}</td>
                                        <td>{{ $item['category'] ?? 'N/A' }}</td>
                                        <td>{{ $item['quantity'] ?? 1 }}</td>
                                        <td>
                                            @php
                                            $qty = (int)($item['quantity'] ?? 1);
                                            $unit = $item['unit_price'] ?? null;
                                            if ($unit === null) {
                                            $raw = $item['fixed_price'] ?? ($item['price'] ?? 0);
                                            $unit = (float) str_replace(['₹', ',', '/person'], '', (string) $raw);
                                            }
                                            @endphp
                                            {{ $qty }} × @money($unit)
                                        </td>
                                        <td>@money($item['calculated_price'] ?? (($item['quantity'] ?? 1) * ($item['price'] ?? 0)))</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th colspan="4">Decoration Total:</th>
                                        <th>@money($estimation->decoration_items_cost)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($estimation->food_items && count($estimation->food_items) > 0)

                    <div class="mb-4">
                        <h6 class="text-success"><i class="fas fa-utensils me-2"></i>Food Items ({{ $estimation->food_items_count }} items)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Qty × Unit</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estimation->food_items as $item)
                                    <tr>
                                        <td>{{ $item['title'] ?? $item['name'] ?? 'N/A' }}</td>
                                        <td>{{ $item['category'] ?? 'food' }}</td>
                                        <td>{{ $item['guest_count'] ?? $estimation->guest_count }}</td>
                                        <td>
                                            @php
                                            $qty = (int)($item['guest_count'] ?? $estimation->guest_count);
                                            $unit = $item['price_per_person'] ?? null;
                                            if ($unit === null) {
                                            $raw = $item['price'] ?? 0;
                                            $unit = (float) str_replace(['₹', ',', '/person'], '', (string) $raw);
                                            }
                                            @endphp
                                            {{ $qty }} × @money($unit)
                                        </td>
                                        <td>@money($item['calculated_price'] ?? (($item['guest_count'] ?? $estimation->guest_count) * ($item['price'] ?? 0)))</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th colspan="4">Food Total:</th>
                                        <th>@money($estimation->food_items_cost)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($estimation->service_items && count($estimation->service_items) > 0)

                    <div class="mb-4">
                        <h6 class="text-warning"><i class="fas fa-concierge-bell me-2"></i>Service Items ({{ $estimation->service_items_count }} items)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Qty × Unit</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estimation->service_items as $item)
                                    <tr>
                                        <td>{{ $item['title'] ?? $item['name'] ?? 'N/A' }}</td>
                                        <td>{{ $item['category'] ?? 'N/A' }}</td>
                                        <td>{{ $item['quantity'] ?? 1 }}</td>
                                        <td>
                                            @php
                                            $qty = (int)($item['quantity'] ?? 1);
                                            $unit = $item['unit_price'] ?? null;
                                            if ($unit === null) {
                                            $raw = $item['fixed_price'] ?? ($item['price'] ?? 0);
                                            $unit = (float) str_replace(['₹', ',', '/person'], '', (string) $raw);
                                            }
                                            @endphp
                                            {{ $qty }} × @money($unit)
                                        </td>
                                        <td>@money($item['calculated_price'] ?? (($item['quantity'] ?? 1) * ($item['price'] ?? 0)))</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th colspan="4">Service Total:</th>
                                        <th>@money($estimation->service_items_cost)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if((!$estimation->decoration_items || count($estimation->decoration_items) == 0) &&
                    (!$estimation->food_items || count($estimation->food_items) == 0) &&
                    (!$estimation->service_items || count($estimation->service_items) == 0))
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>No detailed items information available for this estimation.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection