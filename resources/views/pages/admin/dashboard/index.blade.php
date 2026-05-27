@extends('layouts.app', ['activePage' => 'dashboard', 'activeSection' => 'admin'])

@section('content')

<div class="dashboard-header mb-4">
    <h1 class="h3 fw-bold mb-1">Dashboard Overview</h1>
    <p class="text-muted">Welcome back, Admin! Here's what's happening today.</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.1s">
            <div class="stat-icon bg-primary-soft">
                <i class="fas fa-file-invoice text-primary"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Invoices</span>
                <h2 class="stat-value">1,284</h2>
                <span class="stat-trend text-success">
                    <i class="fas fa-arrow-up me-1"></i> 12% increase
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.2s">
            <div class="stat-icon bg-success-soft">
                <i class="fas fa-check-circle text-success"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Paid Amount</span>
                <h2 class="stat-value">$42.5k</h2>
                <span class="stat-trend text-success">
                    <i class="fas fa-arrow-up me-1"></i> 8% increase
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.3s">
            <div class="stat-icon bg-warning-soft">
                <i class="fas fa-clock text-warning"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Pending</span>
                <h2 class="stat-value">$12.8k</h2>
                <span class="stat-trend text-danger">
                    <i class="fas fa-arrow-up me-1"></i> 2% increase
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.4s">
            <div class="stat-icon bg-info-soft">
                <i class="fas fa-users text-info"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">New Clients</span>
                <h2 class="stat-value">48</h2>
                <span class="stat-trend text-success">
                    <i class="fas fa-arrow-up me-1"></i> 24% increase
                </span>
            </div>
        </div>
    </div>
</div>



@endsection


@push('custom_scripts')
@endpush
