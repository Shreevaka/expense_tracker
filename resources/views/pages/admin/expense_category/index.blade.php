@extends('layouts.app', ['activePage' => 'expense_category', 'activeSection' => 'admin'])

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



<style>
    .stat-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 500;
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: var(--text-main);
    }

    .stat-trend {
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Soft Backgrounds */
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.1); }
    .bg-success-soft { background-color: rgba(34, 197, 94, 0.1); }
    .bg-warning-soft { background-color: rgba(245, 158, 11, 0.1); }
    .bg-info-soft { background-color: rgba(6, 182, 212, 0.1); }
    .bg-danger-soft { background-color: rgba(239, 68, 68, 0.1); }


</style>

@endsection


@push('custom_scripts')
@endpush
