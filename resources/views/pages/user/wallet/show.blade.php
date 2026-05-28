@extends('layouts.app', ['activePage' => 'wallet', 'activeSection' => 'user'])

@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Wallet - {{$wallet->name}}</h1>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4 animate-up" style="animation-delay: 0.1s">
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-primary">
            <div class="stat-icon bg-primary-soft text-primary">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Transactions</span>
                <h2 class="stat-value text-dark">{{ $totalCount }}</h2>
                <span class="stat-trend text-muted">Wallets all transactions</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-danger">
            <div class="stat-icon bg-danger-soft text-danger">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Expenses</span>
                <h2 class="stat-value text-danger">{{ number_format($totalExpense, 2) }}</h2>
                <span class="stat-trend text-danger-muted">All time spending.</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-success">
            <div class="stat-icon bg-success-soft text-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Balance</span>
                <h2 class="stat-value text-success">{{ $wallet->current_balance }}</h2>
                <span class="stat-trend text-success-muted">Wallet Current balance.</span>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-up" style="animation-delay: 0.3s">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="table-header-modern text-muted uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 80px"></th>
                        <th class="py-3">Transaction Title</th>
                        <th class="py-3">category</th>
                        <th class="py-3">Amount</th>
                        <th class="py-3">Date</th>
                        <th class="py-3" style="width: 180px">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr id="row-{{ $wallet->id }}" class="table-row-modern">
                            <td class="ps-4">
                                {{-- <span class="badge rounded-pill bg-light text-primary border">
                                    
                                </span> --}}
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $transaction->title }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $transaction->category_group }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $transaction->wallet_currency_amount}}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $transaction->transaction_date}}
                                </span>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-folder-open text-muted fa-3x"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">No Transactions Found</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transactions->withQueryString()->links('components.paginations') }}
    </div>
</div>

@endsection


@push('custom_scripts')
@endpush
