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
                        <th class="ps-4 py-3" style="width: 80px"></th>
                        <th class="py-3">Transaction Title</th>
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
                                <span class="badge rounded-pill bg-light text-primary border">
                                    #{{ $transactions->firstItem() + $loop->index }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $transaction->title }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $transaction->category }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $transaction->wallet->name }}
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
                                    

                                    <!-- Edit Action -->
                                    <button class="btn btn-action btn-action-warning edit-transaction-btn" 
                                            data-id="{{ $transaction->id }}"
                                            data-title="{{ $transaction->title }}"
                                            data-description="{{ $transaction->description }}"
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
                            <td colspan="9" class="text-center py-5">
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="createTransactionModalLabel">
                    <i class="fas fa-folder-plus text-primary me-2"></i>New Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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


        // 2. EDIT Wallet MODAL POPULATION
        $('.edit-wallet-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const name = btn.data('name');
            const desc = btn.data('description');

            // Populate form fields
            $('#edit_name').val(name);
            $('#edit_description').val(desc);

            // Construct update route URL: /user/wallets/{id}
            const updateUrl = "{{ route('user.wallets.index') }}/" + id;
            $('#editWalletForm').attr('action', updateUrl);

            // Trigger Modal show
            $('#editWalletModal').modal('show');
        });

        // 3. AJAX DELETE Wallet WITH SWEETALERT2
        $('.delete-wallet-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const row = $(`#row-${id}`);

            Swal.fire({
                title: 'Delete Wallet?',
                text: "All associated transactions will lose their direct wallet! This action cannot be undone.",
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
                        url: "{{ route('user.wallets.index') }}/" + id,
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
                                toastr.success('Wallet has been deleted successfully.', 'Deleted!');
                            } else {
                                toastr.error(response.message || 'Something went wrong', 'Failed!');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Could not delete the wallet. Please try again.', 'Error!');
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
</script>
@endpush
