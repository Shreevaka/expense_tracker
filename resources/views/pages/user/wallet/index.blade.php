@extends('layouts.app', ['activePage' => 'wallet', 'activeSection' => 'user'])

@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Wallets</h1>
        <p class="text-muted mb-0">Manage and organize your wallets.</p>
    </div>
    <button type="button" class="btn btn-indigo shadow-indigo animate-hover-up" data-bs-toggle="modal" data-bs-target="#createWalletModal">
        <i class="fas fa-plus me-2"></i> Add Wallet
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
                <span class="stat-label">Total Wallets</span>
                <h2 class="stat-value text-dark">{{ $totalCount }}</h2>
                <span class="stat-trend text-muted">All registered wallets</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-primary">
            <div class="stat-icon bg-primary-soft text-primary">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Wallets Balance</span>
                <h2 class="stat-value text-dark">{{ $totalBalance }}</h2>
                <span class="stat-trend text-muted">Total wallets balance.</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-success">
            <div class="stat-icon bg-success-soft text-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Active Wallets</span>
                <h2 class="stat-value text-success">{{ $activeCount }}</h2>
                <span class="stat-trend text-success-muted">Enabled and in use</span>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 animate-up" style="animation-delay: 0.2s">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('user.wallets.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon text-muted"></i>
                    <input type="text" name="sr" class="form-control form-control-modern" placeholder="Search wallets by name..." value="{{ request('sr') }}">
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-indigo flex-grow-1">
                    Search
                </button>
                @if(request('sr'))
                    <a href="{{ route('user.wallets.index') }}" class="btn btn-outline-custom" title="Clear Search">
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
                        <th class="py-3">Wallet Name</th>
                        <th class="py-3">Currency</th>
                        <th class="py-3">Initial Balance</th>
                        <th class="py-3">Current Balance</th>
                        <th class="py-3" style="width: 150px">Status</th>
                        <th class="py-3" style="width: 180px">Created At</th>
                        <th class="pe-4 py-3 text-center" style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wallets as $wallet)
                        <tr id="row-{{ $wallet->id }}" class="table-row-modern">
                            <td class="ps-4">
                                <span class="badge rounded-pill bg-light text-primary border">
                                    #{{ $wallets->firstItem() + $loop->index }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $wallet->name }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $wallet->currency}}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $wallet->initial_balance}}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $wallet->current_balance}}
                                </span>
                            </td>
                            <td>
                                <div class="status-toggle-wrapper">
                                    <label class="switch-ios">
                                        <input type="checkbox" class="status-toggle-checkbox" 
                                               data-id="{{ $wallet->id }}" 
                                               {{ $wallet->is_active ? 'checked' : '' }}>
                                        <span class="slider-ios"></span>
                                    </label>
                                    <span class="status-badge-text {{ $wallet->is_active ? 'text-success' : 'text-danger' }} fw-semibold ms-2">
                                        {{ $wallet->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ $wallet->created_at ? $wallet->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Action -->
                                    <a href="{{ route('user.wallets.show', $wallet->id) }}"
                                    class="btn btn-action btn-action-info"
                                    title="View Details">
                                        <i class="far fa-eye"></i>
                                    </a>

                                    <!-- Edit Action -->
                                    <button class="btn btn-action btn-action-warning edit-wallet-btn" 
                                            data-id="{{ $wallet->id }}"
                                            data-name="{{ $wallet->name }}"
                                            data-description="{{ $wallet->description }}"
                                            title="Edit Wallet">
                                        <i class="far fa-edit"></i>
                                    </button>

                                    <!-- Delete Action -->
                                    <button class="btn btn-action btn-action-danger delete-wallet-btn" 
                                            data-id="{{ $wallet->id }}" 
                                            title="Delete Wallet">
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
                                    <h5 class="fw-bold text-dark">No Wallets Found</h5>
                                    <p class="text-muted">Try refining your search or add a new wallet to get started.</p>
                                    <button type="button" class="btn btn-indigo mt-2" data-bs-toggle="modal" data-bs-target="#createWalletModal">
                                        <i class="fas fa-plus me-1"></i> Add Wallet
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $wallets->withQueryString()->links('components.paginations') }}
    </div>
</div>

<!-- Create Wallet Modal -->
<div class="modal fade" id="createWalletModal" tabindex="-1" aria-labelledby="createWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="createWalletModalLabel">
                    <i class="fas fa-folder-plus text-primary me-2"></i>New Wallet
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.wallets.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="create_name" class="form-label fw-semibold text-muted">Wallet Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="create_name" name="name" placeholder="e.g., Bills, Office .." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Currency <span class="text-danger">*</span>
                        </label>

                        <select name="currency" class="form-control form-control-modern" id="currency" required>
                            <option value="">Select Currency</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">
                            Initial Balance <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                            step="0.01"
                            class="form-control form-control-modern"
                            name="initial_balance"
                            placeholder="0.00"
                            required>
                    </div>
                    <div class="mb-0">
                        <label for="create_description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="create_description" name="description" rows="4" placeholder="Briefly describe wallet..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4">Save Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Wallet Modal -->
<div class="modal fade" id="editWalletModal" tabindex="-1" aria-labelledby="editWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="editWalletModalLabel">
                    <i class="fas fa-edit text-warning me-2"></i>Edit Wallet
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editWalletForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold text-muted">Wallet Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="edit_name" name="name" required placeholder="e.g. Travel, Utilities">
                    </div>
                    <div class="mb-0">
                        <label for="edit_description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="edit_description" name="description" rows="4" placeholder="Update description..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4">Update Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('custom_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        
        // CSRF Token setup for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 1. DYNAMIC STATUS TOGGLE (AJAX Switch change)
        $('.status-toggle-checkbox').on('change', function() {
            const checkbox = $(this);
            const walletId = checkbox.data('id');
            const newStatus = checkbox.prop('checked') ? 1 : 0;
            const textElement = checkbox.closest('.status-toggle-wrapper').find('.status-badge-text');

            // Disable check temporarily to avoid double requests
            checkbox.prop('disabled', true);

            $.ajax({
                url: "{{ route('user.update.wallet.status') }}",
                type: 'POST',
                data: {
                    id: walletId,
                    status: newStatus
                },
                success: function(response) {
                    checkbox.prop('disabled', false);
                    
                    // Update layout elements
                    if (newStatus === 1) {
                        textElement.text('Active').removeClass('text-danger').addClass('text-success');
                        toastr.success('Wallet activated successfully!', 'Status Updated');
                    } else {
                        textElement.text('Inactive').removeClass('text-success').addClass('text-danger');
                        toastr.info('Wallet deactivated successfully.', 'Status Updated');
                    }
                    
                    // Reload active/inactive stats counters dynamically
                    updateStatsSection();
                },
                error: function(xhr) {
                    checkbox.prop('disabled', false);
                    checkbox.prop('checked', !newStatus); // revert checkbox state
                    toastr.error('Failed to change status. Please try again.', 'Error');
                }
            });
        });

        // Helper function to dynamically update the stats count in cards
        function updateStatsSection() {
            let active = 0;
            let inactive = 0;
            
            $('.status-toggle-checkbox').each(function() {
                if ($(this).prop('checked')) {
                    active++;
                } else {
                    inactive++;
                }
            });

            // Update stats labels
            $('.border-left-success .stat-value').text(active);
            $('.border-left-danger .stat-value').text(inactive);
        }


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

        // $('#currency').select2({
        //     placeholder: "Select Currency",
        //     width: '100'
        // });
    });
</script>
@endpush
