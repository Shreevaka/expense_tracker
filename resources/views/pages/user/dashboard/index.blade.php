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


<div class="row g-4">
    <!-- Recent Invoices -->
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Recent Invoices</h5>
                <a href="#" class="btn btn-sm btn-light text-primary fw-semibold">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="px-4 py-3">Invoice ID</th>
                                <th class="py-3">Client</th>
                                <th class="py-3">Amount</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-end px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 font-monospace">#INV-001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">JD</div>
                                        <span>John Doe</span>
                                    </div>
                                </td>
                                <td class="fw-bold">$450.00</td>
                                <td><span class="badge bg-success-soft text-success rounded-pill px-3">Paid</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-icon-sm"><i class="far fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 font-monospace">#INV-002</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">AS</div>
                                        <span>Alice Smith</span>
                                    </div>
                                </td>
                                <td class="fw-bold">$1,200.00</td>
                                <td><span class="badge bg-warning-soft text-warning rounded-pill px-3">Pending</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-icon-sm"><i class="far fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 font-monospace">#INV-003</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">BK</div>
                                        <span>Bob King</span>
                                    </div>
                                </td>
                                <td class="fw-bold">$890.00</td>
                                <td><span class="badge bg-danger-soft text-danger rounded-pill px-3">Overdue</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-icon-sm"><i class="far fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats/Actions -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="bg-primary p-4 text-white">
                    <h6 class="text-white-50 small text-uppercase fw-bold mb-3">Quick Summary</h6>
                    <h3 class="mb-0 fw-bold">$54,230.00</h3>
                    <p class="small mb-0 opacity-75">Total Revenue this month</p>
                </div>
                <div class="p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Progress to Goal</span>
                        <span class="small fw-bold">85%</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary rounded-3 py-2 text-start">
                        <i class="fas fa-plus me-2"></i> Create New Invoice
                    </button>
                    <button class="btn btn-outline-light text-dark border rounded-3 py-2 text-start">
                        <i class="fas fa-user-plus me-2"></i> Add New Client
                    </button>
                    <button class="btn btn-outline-light text-dark border rounded-3 py-2 text-start">
                        <i class="fas fa-download me-2"></i> Export Reports
                    </button>
                </div>
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

    .avatar-sm {
        width: 32px;
        height: 32px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: #64748b;
    }

    .btn-icon-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: var(--text-muted);
        transition: all 0.2s;
    }

    .btn-icon-sm:hover {
        background: var(--primary-color);
        color: #fff;
        border-color: var(--primary-color);
    }
</style>

@endsection


@push('custom_scripts')
@endpush
