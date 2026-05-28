@extends('layouts.app', ['activePage' => 'dashboard', 'activeSection' => 'admin'])
@push('custom_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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
@endpush
@section('content')

<div class="dashboard-header mb-4">
    <h1 class="h3 fw-bold mb-1">Dashboard Overview</h1>
    <p class="text-muted">Welcome back! Here's what's happening today.</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.1s">
            <div class="stat-icon bg-primary-soft">
                <i class="fas fa-file-invoice text-primary"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Transactions</span>
                <h2 class="stat-value">{{ $totalCount }}</h2>
                <span class="stat-trend text-success">
                     All transactions count
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
                <h2 class="stat-value">{{ $totalWalletCount }}</h2>
                <span class="stat-trend text-success">
                     All wallets count
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.3s">
            <div class="stat-icon bg-danger-soft">
                <i class="fas fa-clock text-danger"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Expenses</span>
                <h2 class="stat-value">{{ number_format($totalExpenseAmountAll, 2) }}</h2>
                <span class="stat-trend text-danger"> All time spending
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card animate-up" style="animation-delay: 0.4s">
            <div class="stat-icon bg-success-soft">
                <i class="fas fa-hand-holding-usd text-success"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Income</span>
                <h2 class="stat-value">{{ number_format($totalIncomeAmountAll, 2) }}</h2>
                <span class="stat-trend text-success">All time income
                </span>
            </div>
        </div>
    </div>
</div>


<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 mb-2 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Recent Transactions</h5>
                <a href="{{ route('user.transactions.index') }}" class="btn btn-sm btn-indigo fw-semibold px-2 py-1">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3">Transaction Title</th>
                                <th class="py-3">Wallet</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Amount</th>
                                <th class="py-3">Currency</th>
                                <th class="py-3" style="width: 180px">Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr id="row-{{ $transaction->id }}" class="table-row-modern">
                                    <td class="ps-4">
                                        <span class="text-muted">{{ $transaction->title }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $transaction->wallet->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $transaction->category_group }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $transaction->amount}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $transaction->currency}}
                                        </span>
                                    </td>
                                    <td class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $transaction->transaction_date
                                            ? \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y')
                                            : 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="empty-state-icon mb-3">
                                                <i class="fas fa-folder-open text-muted fa-3x"></i>
                                            </div>
                                            <h5 class="fw-bold text-dark">No Transactions Found</h5>
                                            <p class="text-muted">Try refining your search or add a new transaction to get started.</p>
                                            <button type="button" class="btn btn-indigo mt-2" data-bs-toggle="modal" data-bs-target="#createTransactionModal">
                                                <i class="fas fa-plus me-1"></i> Add Transaction
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
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
                <div class="bg-indigo p-4 text-white">
                    <h6 class="text-white-50 small text-uppercase fw-bold mb-3">Quick Summary</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalExpenseAmount }}</h3>
                    <p class="small mb-0 opacity-75">Total Expense this month</p>
                </div>
                <div class="bg-white p-4 text-white">
                    <h3 class="mb-0 fw-bold text-indigo">{{ $totalIncomeAmount }}</h3>
                    <p class="small mb-0 opacity-75 text-indigo">Total Income this month</p>
                </div>
            </div>
        </div>

        @if(!empty($coins) && is_array($coins))
            <div class="row">
                @foreach ($coins as $name => $value)

                    @php
                        // safely get USD value
                        $price = $value['usd'] ?? 0;
                    @endphp

                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">

                                <h6 class="text-uppercase text-muted">
                                    {{ ucfirst($name) }}
                                </h6>

                                <h4 class="fw-bold text-primary">
                                    ${{ number_format($price, 2) }}
                                </h4>

                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center">
                Crypto data temporarily unavailable. Please try again later.
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <button class="btn btn-indigo rounded-3 py-2 text-start" data-bs-toggle="modal" data-bs-target="#createTransactionModal">
                        <i class="fas fa-plus me-2"></i> Create New Transaction
                    </button>
                    <a href="{{ route('user.wallets.index') }}" class="btn btn-outline-light text-dark border rounded-3 py-2 text-start">
                        <i class="fas fa-wallet me-2"></i> View All Wallet
                    </a>
                    <a href="{{ route('user.wallets.show', $recentWalletId) }}" class="btn btn-outline-light text-dark border rounded-3 py-2 text-start">
                        <i class="fas fa-wallet me-2"></i> Check Recent Wallet
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Transaction Modal -->
<div class="modal fade" id="createTransactionModal" tabindex="-1" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="createTransactionModalLabel">
                    <i class="fas fa-folder-plus text-primary me-2"></i>New Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="is_dashboard" value="1">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="create_title" class="form-label fw-semibold text-muted">Transaction Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="create_title" name="title" placeholder="e.g., Bills, Bus .." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Wallet <span class="text-danger">*</span>
                        </label>

                        <select name="wallet_id" class="form-control form-control-modern" required>
                            <option value="">Select Wallet</option>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Type <span class="text-danger">*</span>
                        </label>

                        <select name="type" id="type" class="form-control form-control-modern" required>
                            <option value="">Select Type</option>
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Category <span class="text-danger">*</span>
                        </label>

                        <select name="category_id" id="category_id" class="form-control form-control-modern" required>
                            <option value="">Select Category</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Transaction Date <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                            name="transaction_date"
                            class="form-control form-control-modern"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Currency <span class="text-danger">*</span>
                        </label>

                        <select name="currency" class="form-control form-control-modern" required>
                            <option value="">Select Currency</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Amount <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                            step="0.01"
                            class="form-control form-control-modern"
                            name="amount"
                            placeholder="0.00"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="create_description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="create_description" name="description" rows="4" placeholder="Briefly describe transaction..."></textarea>
                    </div>
                    
                    <label for="image" class="form-label fw-semibold text-muted">Image</label>
                    <input type="file" name="image" class="form-control transaction-image">
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('custom_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $(document).ready(function() {
        
        $('.transaction-image').dropify();

        // CSRF Token setup for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#type').on('change', function () {

        let type = $(this).val();

        $('#category_id').html('<option>Loading...</option>');

        $.ajax({
            url: '/transactions/categories-by-type',
            type: 'GET',
            data: { type: type },
            success: function (data) {

                let options = '<option value="">Select Category</option>';

                $.each(data, function (key, value) {
                    options += `<option value="${value.id}">${value.name}</option>`;
                });

                $('#category_id').html(options);
            }
        });
    });
</script>
@endpush
