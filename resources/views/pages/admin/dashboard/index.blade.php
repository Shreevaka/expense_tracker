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
                <span class="stat-label">Total Users</span>
                <h2 class="stat-value">{{ sprintf('%02d', $totalCount) }}</h2>
                <span class="stat-trend text-muted">All registered users
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.2s">
            <div class="stat-icon bg-success-soft">
                <i class="fas fa-wallet text-success"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Wallets</span>
                <h2 class="stat-value">{{ sprintf('%02d', $totaleWallets) }}</h2>
                <span class="stat-trend text-success">All wallets
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.1s">
            <div class="stat-icon bg-primary-soft">
                <i class="fas fa-exchange-alt text-primary"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Transactions</span>
                <h2 class="stat-value">{{ sprintf('%02d', $totaltransactions) }}</h2>
                <span class="stat-trend text-muted">All transactions count
                </span>
            </div>
        </div>
    </div>
</div>



@endsection


@push('custom_scripts')
@endpush
