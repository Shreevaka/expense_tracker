@extends('layouts.app', ['activePage' => 'transaction', 'activeSection' => 'user'])
@push('custom_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Transactions</h1>
        <p class="text-muted mb-0">Manage and organize your transactions.</p>
    </div>
    <button type="button" class="btn btn-indigo shadow-indigo animate-hover-up" data-bs-toggle="modal" data-bs-target="#createTransactionModal">
        <i class="fas fa-plus me-2"></i> Add Transaction
    </button>
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
                <span class="stat-trend text-muted">All transaction count.</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-danger">
            <div class="stat-icon bg-danger-soft text-danger">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Expenses</span>
                <h2 class="stat-value text-danger">{{ number_format($totalExpenseAmount, 2) }}</h2>
                <span class="stat-trend text-danger-muted">All time spending.</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-success">
            <div class="stat-icon bg-success-soft text-success">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Income</span>
                <h2 class="stat-value text-success">{{ number_format($totalIncomeAmount, 2) }}</h2>
                <span class="stat-trend text-success-muted">All time income.</span>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 animate-up" style="animation-delay: 0.2s">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('user.transactions.index') }}" class="row g-2 align-items-center">

            <div class="col-12 col-md-5 col-lg-6">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon text-muted"></i>
                    <input type="text"
                        name="sr"
                        class="form-control form-control-modern"
                        placeholder="Search transaction by name..."
                        value="{{ request('sr') }}">
                </div>
            </div>

            <div class="col-12 col-md-3 col-lg-3">
                <input type="date"
                    name="date"
                    class="form-control form-control-modern"
                    value="{{ request('date') }}">
            </div>

            <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">

                <button type="submit" class="btn btn-indigo flex-grow-1">
                    Search
                </button>

                @if(request('sr') || request('date'))
                    <a href="{{ route('user.transactions.index') }}"
                    class="btn btn-outline-custom"
                    title="Clear Search">
                        <i class="fas fa-redo"></i>
                    </a>
                @endif

            </div>

        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-up" style="animation-delay: 0.3s">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="table-header-modern text-muted uppercase">
                    <tr>
                        <th class="ps-4 py-3">Transaction Title</th>
                        <th class="py-3">Wallet</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Amount</th>
                        <th class="py-3">Currency</th>
                        <th class="py-3" style="width: 180px">Transaction Date</th>
                        <th class="py-3" style="width: 180px">Created At</th>
                        <th class="pe-4 py-3 text-center" style="width: 150px">Actions</th>
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
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ $transaction->created_at ? $transaction->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Action -->
                                    <button class="btn btn-action btn-action-info view-transaction-btn" 
                                            data-id="{{ $transaction->id }}"
                                            data-title="{{ $transaction->title }}"
                                            data-wallet="{{ $transaction->wallet->name }}"
                                            data-wallet_currency="{{ $transaction->wallet->currency }}"
                                            data-category_type="{{ $transaction->category_group }}"
                                            data-category="{{ $transaction->category->name ?? 'N/A' }}"
                                            data-description="{{ $transaction->description }}"
                                            data-amount="{{ $transaction->amount }}"
                                            data-currency="{{ $transaction->currency }}"
                                            data-exchange_rate="{{ $transaction->exchange_rate }}"
                                            data-wallet_currency_amount="{{ $transaction->wallet_currency_amount }}"
                                            data-image="{{ $transaction->image_url }}"
                                            data-transaction_date="{{ $transaction->transaction_date
                                    ? \Carbon\Carbon::parse($transaction->transaction_date)->format('M d, Y')
                                    : 'N/A' }}"
                                            data-created="{{ $transaction->created_at ? $transaction->created_at->format('M d, Y h:i A') : 'N/A' }}"
                                            data-updated="{{ $transaction->updated_at ? $transaction->updated_at->format('M d, Y h:i A') : 'N/A' }}"
                                            title="View Details">
                                        <i class="far fa-eye"></i>
                                    </button>

                                    <!-- Edit Action -->
                                    <button class="btn btn-action btn-action-warning edit-transaction-btn" 
                                            data-id="{{ $transaction->id }}"
                                            data-title="{{ $transaction->title }}"
                                            data-description="{{ $transaction->description }}"
                                            data-wallet_id="{{ $transaction->wallet_id }}"
                                            data-type="{{ $transaction->category_group }}"
                                            data-category_id="{{ $transaction->category_id}}"
                                            data-amount="{{ $transaction->amount }}"
                                            data-currency="{{ $transaction->currency }}"
                                            data-image="{{ $transaction->image_url }}"
                                            data-transaction_date="{{ $transaction->transaction_date }}"
                                            title="Edit Transaction">
                                        <i class="far fa-edit"></i>
                                    </button>

                                    <!-- Delete Action -->
                                    <button class="btn btn-action btn-action-danger delete-transaction-btn" 
                                            data-id="{{ $transaction->id }}" 
                                            title="Delete Transaction">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
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

        {{ $transactions->withQueryString()->links('components.paginations') }}
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

                <input type="hidden" name="is_dashboard" value="0">

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

<!-- View Details Modal -->
<div class="modal fade" id="viewTransactionModal" tabindex="-1" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-indigo text-white py-3 px-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-info-circle me-2"></i>Transaction Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">

                <!-- Title -->
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-dark mb-1" id="view_title">-</h4>
                </div>

                <div class="divider mb-4"></div>

                <div class="row g-3">

                    <div class="col-12">
                        <label class="small text-muted fw-semibold">Description</label>
                        <div class="p-3 bg-light rounded-3" id="view_description" style="white-space: pre-wrap;">
                            -
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Wallet</label>
                        <div class="text-dark fw-semibold" id="view_wallet">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Category</label>
                        <div class="text-dark fw-semibold" id="view_category">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Type</label>
                        <div id="view_category_type" class="fw-semibold">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Amount</label>
                        <div class="fw-bold text-primary">
                            <span id="view_currency"></span>
                            <span id="view_amount"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Exchange Rate</label>
                        <div id="view_exchange_rate">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Wallet Amount</label>
                        <div class="fw-bold text-primary">
                            <span id="view_wallet_currency"></span>
                            <span id="view_wallet_currency_amount"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Transaction Date</label>
                        <div id="view_transaction_date">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Created At</label>
                        <div id="view_created_at">-</div>
                    </div>

                    <div class="col-md-6">
                        <label class="small text-muted fw-semibold">Updated At</label>
                        <div id="view_updated_at">-</div>
                    </div>
                    
                    <div class=" mt-4">
                        <img id="view_image"
                            src=""
                            class="img-fluid rounded-3 shadow-sm"
                            style="max-height: 180px; display:none;">
                    </div>

                </div>
            </div>

            <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-end">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="editTransactionModalLabel">
                    <i class="fas fa-edit text-warning me-2"></i>Edit Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form id="editTransactionForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Transaction Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="edit_title"
                               name="title"
                               class="form-control form-control-modern"
                               placeholder="e.g. Travel, Food">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Wallet <span class="text-danger">*</span>
                        </label>
                        <select id="edit_wallet_id"
                                name="wallet_id"
                                class="form-control form-control-modern">
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Type <span class="text-danger">*</span>
                        </label>
                        <select id="edit_type"
                                name="type"
                                class="form-control form-control-modern">
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Category <span class="text-danger">*</span>
                        </label>
                        <select id="edit_category_id"
                                name="category_id"
                                class="form-control form-control-modern">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Transaction Date <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               id="edit_transaction_date"
                               name="transaction_date"
                               class="form-control form-control-modern">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Currency <span class="text-danger">*</span>
                        </label>
                        <select id="edit_currency"
                                name="currency"
                                class="form-control form-control-modern">
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
                               id="edit_amount"
                               name="amount"
                               class="form-control form-control-modern"
                               placeholder="0.00">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Description
                        </label>
                        <textarea id="edit_description"
                                  name="description"
                                  rows="4"
                                  class="form-control form-control-modern"
                                  placeholder="Update description..."></textarea>
                    </div>

                    <label for="preview" id="curent-image" class="form-label fw-semibold text-muted">Current Image</label>
                    <div class="mb-2">
                        <img id="edit_image_preview"
                            src=""
                            class="img-fluid rounded shadow-sm"
                            style="max-height:120px; display:none;">
                    </div>

                    <label for="image" class="form-label fw-semibold text-muted">Image</label>
                    <input type="file" name="image" class="form-control edit-transaction-image">

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-indigo px-4">
                        Update Transaction
                    </button>
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
        $('.edit-transaction-image').dropify();

        // CSRF Token setup for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.view-transaction-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const title = btn.data('title');
            const desc = btn.data('description') || 'No description provided for this transaction.';
            const created = btn.data('created');
            const updated = btn.data('updated');
            const wallet = btn.data('wallet');
            const category_type = btn.data('category_type');
            const category = btn.data('category');
            const amount = btn.data('amount');
            const currency = btn.data('currency');
            const exchange_rate = btn.data('exchange_rate');
            const wallet_currency_amount = btn.data('wallet_currency_amount');
            const image_url = btn.data('image');
            const transaction_date = btn.data('transaction_date');
            const wallet_currency = btn.data('wallet_currency');

            // Populating visual elements
            $('#view_id').text(id);
            $('#view_title').text(title);
            $('#view_description').text(desc);
            $('#view_created_at').text(created);
            $('#view_updated_at').text(updated);
            $('#view_wallet').text(wallet);
            $('#view_category_type').text(
                    category_type.charAt(0).toUpperCase() + category_type.slice(1)
                );
            $('#view_category').text(category);
            $('#view_amount').text(amount);
            $('#view_currency').text(currency);
            $('#view_exchange_rate').text(exchange_rate);
            $('#view_wallet_currency_amount').text(wallet_currency_amount);
            $('#view_transaction_date').text(transaction_date);
            $('#view_wallet_currency').text(wallet_currency);

            $('#view_image').hide();

            if (image_url) {
                $('#view_image')
                    .attr('src', image_url)
                    .show();
            } else {
                $('#view_image').hide();
            }

            // Trigger Modal show
            $('#viewTransactionModal').modal('show');
        });

        $('.edit-transaction-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const title = btn.data('title');
            const description = btn.data('description');
            const wallet_id = btn.data('wallet_id');
            const type = btn.data('type');
            const category_id = btn.data('category_id');
            const amount = btn.data('amount');
            const currency = btn.data('currency');
            const transaction_date = btn.data('transaction_date');
            const edit_image = btn.data('image');

            $('#edit_title').val(title);
            $('#edit_description').val(description);
            $('#edit_wallet_id').val(wallet_id);
            $('#edit_type').val(type);
            $('#edit_amount').val(amount);
            $('#edit_currency').val(currency);
            $('#edit_transaction_date').val(transaction_date);
            $('#edit_category_id').val(category_id);

            if (edit_image) {
                $('#edit_image_preview')
                    .attr('src', edit_image)
                    .show();
                $('#curent-image').show();
            } else {
                $('#edit_image_preview').hide();
                $('#curent-image').hide();
            }
        
            // dynamic form action
            const updateUrl = "{{ route('user.transactions.index') }}/" + id;
            $('#editTransactionForm').attr('action', updateUrl);

            // load categories based on type
            loadCategories(type, category_id);

            $('#editTransactionModal').modal('show');
        });


        $('.delete-transaction-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const row = $(`#row-${id}`);

            Swal.fire({
                title: 'Delete Transaction?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5', // Theme indigo
                cancelButtonColor: '#f43f5e', // Theme rose
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                background: '#fff',
                customClass: {
                    popup: 'rounded-4 border-0',
                    confirmButton: 'px-4 py-2 fw-semibold rounded-3',
                    cancelButton: 'px-4 py-2 fw-semibold rounded-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send delete AJAX request
                    $.ajax({
                        url: "{{ route('user.transactions.index') }}/" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            if (response.response === 'success') {
                                // Dynamic row deletion animation
                                row.fadeOut(500, function() {
                                    $(this).remove();
                                    
                                    // Decrement total stats count
                                    const totalStats = $('.border-left-primary .stat-value');
                                    const currentTotal = parseInt(totalStats.text());
                                    totalStats.text(Math.max(0, currentTotal - 1));
                                    
                                    // Recalculate status counts
                                    updateStatsSection();
                                    
                                    // Check if table is empty, reload page to show empty state if necessary
                                    if ($('tbody tr').length === 0) {
                                        location.reload();
                                    }
                                });
                                toastr.success('Transaction has been deleted successfully.', 'Deleted!');
                            } else {
                                toastr.error(response.message || 'Something went wrong', 'Failed!');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Could not delete the transaction. Please try again.', 'Error!');
                        }
                    });
                }
            });
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

    $('#edit_type').on('change', function () {

        let type = $(this).val();

        loadCategories(type);
    });

    function loadCategories(type, selectedId = null) {

        $('#edit_category_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: '/transactions/categories-by-type',
            type: 'GET',
            data: { type: type },

            success: function (data) {

                let options = '<option value="">Select Category</option>';

                $.each(data, function (key, value) {

                    options += `<option value="${value.id}" ${value.id == selectedId ? 'selected' : ''}>
                                    ${value.name}
                                </option>`;
                });

                $('#edit_category_id').html(options);
            },

        });
    }
</script>
@endpush
