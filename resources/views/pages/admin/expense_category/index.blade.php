@extends('layouts.app', ['activePage' => 'expense_category', 'activeSection' => 'admin'])

@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Expense Categories</h1>
        <p class="text-muted mb-0">Manage and organize your business expense categories and structures.</p>
    </div>
    <button type="button" class="btn btn-indigo shadow-indigo animate-hover-up" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="fas fa-plus me-2"></i> Add Category
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
                <span class="stat-label">Total Categories</span>
                <h2 class="stat-value text-dark">{{ $totalCount }}</h2>
                <span class="stat-trend text-muted">All registered types</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-success">
            <div class="stat-icon bg-success-soft text-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Active Categories</span>
                <h2 class="stat-value text-success">{{ $activeCount }}</h2>
                <span class="stat-trend text-success-muted">Enabled and in use</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-danger">
            <div class="stat-icon bg-danger-soft text-danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Inactive Categories</span>
                <h2 class="stat-value text-danger">{{ $inactiveCount }}</h2>
                <span class="stat-trend text-danger-muted">Disabled categories</span>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 animate-up" style="animation-delay: 0.2s">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.expense-categories.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon text-muted"></i>
                    <input type="text" name="sr" class="form-control form-control-modern" placeholder="Search categories by name..." value="{{ request('sr') }}">
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-indigo flex-grow-1">
                    Search
                </button>
                @if(request('sr'))
                    <a href="{{ route('admin.expense-categories.index') }}" class="btn btn-outline-custom" title="Clear Search">
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
                        <th class="py-3">Category Name</th>
                        <th class="py-3">Description</th>
                        <th class="py-3" style="width: 150px">Status</th>
                        <th class="py-3" style="width: 180px">Created At</th>
                        <th class="pe-4 py-3 text-center" style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr id="row-{{ $category->id }}" class="table-row-modern">
                            <td class="ps-4">
                                <span class="badge rounded-pill bg-light text-primary border">
                                    #{{ $categories->firstItem() + $loop->index }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $category->name }}</span>
                            </td>
                            <td>
                                <span class="text-muted d-inline-block text-truncate" style="max-width: 250px;" title="{{ $category->description }}">
                                    {{ $category->description ?? 'No description provided.' }}
                                </span>
                            </td>
                            <td>
                                <div class="status-toggle-wrapper">
                                    <label class="switch-ios">
                                        <input type="checkbox" class="status-toggle-checkbox" 
                                               data-id="{{ $category->id }}" 
                                               {{ $category->is_active ? 'checked' : '' }}>
                                        <span class="slider-ios"></span>
                                    </label>
                                    <span class="status-badge-text {{ $category->is_active ? 'text-success' : 'text-danger' }} fw-semibold ms-2">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Action -->
                                    <button class="btn btn-action btn-action-info view-category-btn" 
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            data-active="{{ $category->is_active }}"
                                            data-created="{{ $category->created_at ? $category->created_at->format('M d, Y h:i A') : 'N/A' }}"
                                            data-updated="{{ $category->updated_at ? $category->updated_at->format('M d, Y h:i A') : 'N/A' }}"
                                            title="View Details">
                                        <i class="far fa-eye"></i>
                                    </button>

                                    <!-- Edit Action -->
                                    <button class="btn btn-action btn-action-warning edit-category-btn" 
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            title="Edit Category">
                                        <i class="far fa-edit"></i>
                                    </button>

                                    <!-- Delete Action -->
                                    <button class="btn btn-action btn-action-danger delete-category-btn" 
                                            data-id="{{ $category->id }}" 
                                            title="Delete Category">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-folder-open text-muted fa-3x"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">No Categories Found</h5>
                                    <p class="text-muted">Try refining your search or add a new expense category to get started.</p>
                                    <button type="button" class="btn btn-indigo mt-2" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                        <i class="fas fa-plus me-1"></i> Add Category
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->withQueryString()->links('components.paginations') }}
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="createCategoryModalLabel">
                    <i class="fas fa-folder-plus text-primary me-2"></i>New Expense Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.expense-categories.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="create_name" class="form-label fw-semibold text-muted">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="create_name" name="name" placeholder="e.g., Marketing, Office Supplies" required>
                    </div>
                    <div class="mb-0">
                        <label for="create_description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="create_description" name="description" rows="4" placeholder="Briefly describe what expenses fall under this category..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-light-soft py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="editCategoryModalLabel">
                    <i class="fas fa-edit text-warning me-2"></i>Edit Expense Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold text-muted">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="edit_name" name="name" required placeholder="e.g. Travel, Utilities">
                    </div>
                    <div class="mb-0">
                        <label for="edit_description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="edit_description" name="description" rows="4" placeholder="Update description..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-indigo px-4">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-indigo py-3 px-4 text-white">
                <h5 class="modal-title fw-bold" id="viewCategoryModalLabel">
                    <i class="fas fa-info-circle me-2"></i>Category Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-indigo-soft text-indigo shadow-sm mb-3" style="width: 72px; height: 72px; font-size: 1.8rem; font-weight: 700;">
                        <span id="view_avatar_initial">E</span>
                    </div>
                    <h4 class="fw-bold text-dark mb-1" id="view_name">Marketing</h4>
                </div>
                
                <div class="divider mb-4"></div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="small text-muted fw-semibold d-block mb-1">Description</label>
                        <div class="p-3 bg-light rounded-3 text-dark fs-6" id="view_description" style="white-space: pre-wrap; min-height: 50px;">
                            No description given.
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-center gap-2">
                        <label class="small text-muted fw-semibold mb-0">Status:</label>
                        <span class="badge py-2 px-3 rounded-pill" id="view_status_badge">Active</span>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted fw-semibold d-block mb-1">Created At</label>
                        <div class="text-muted small" id="view_created_at">Oct 24, 2026</div>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted fw-semibold d-block mb-1">Last Updated</label>
                        <div class="text-muted small" id="view_updated_at">Oct 25, 2026 09:30 AM</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-end">
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- STYLES -->
<!-- ========================================================================= -->
<style>
    /* Styling variables & themes */
    :root {
        --indigo: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-soft: rgba(79, 70, 229, 0.1);
        --indigo-shadow: rgba(79, 70, 229, 0.3);
    }

    .text-dark-gradient {
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Stats Card Aesthetic */
    .stat-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.03), 0 2px 6px -1px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.03);
    }

    /* Subtle left color ribbons for indicators */
    .stat-card.border-left-primary::after { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--primary-color); }
    .stat-card.border-left-success::after { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #10b981; }
    .stat-card.border-left-danger::after { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #f43f5e; }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 0.2rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.1;
    }

    .stat-trend {
        font-size: 0.78rem;
        font-weight: 500;
        margin-top: 0.2rem;
        display: inline-block;
    }

    /* Color variations */
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08); }
    .bg-success-soft { background-color: rgba(16, 185, 129, 0.08); }
    .bg-danger-soft { background-color: rgba(244, 63, 94, 0.08); }
    .bg-light-soft { background-color: #f8fafc; }
    .bg-indigo { background-color: var(--indigo); }
    .bg-indigo-soft { background-color: var(--indigo-soft); }
    .text-indigo { color: var(--indigo); }
    .text-success-muted { color: #6ee7b7; font-size: 0.78rem; font-weight: 500; }
    .text-danger-muted { color: #fda4af; font-size: 0.78rem; font-weight: 500; }

    /* Button and interaction styling */
    .btn-indigo {
        background-color: var(--indigo);
        color: #fff;
        border: 1px solid var(--indigo);
        font-weight: 600;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        transition: all 0.2s ease;
    }

    .btn-indigo:hover, .btn-indigo:focus {
        background-color: var(--indigo-hover);
        color: #fff;
        border-color: var(--indigo-hover);
        box-shadow: 0 4px 12px var(--indigo-shadow);
    }

    .btn-outline-custom {
        background-color: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-outline-custom:hover {
        background-color: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .shadow-indigo {
        box-shadow: 0 4px 14px var(--indigo-shadow);
    }

    .animate-hover-up:hover {
        transform: translateY(-2px);
    }

    /* Modern search bar styling */
    .search-input-group {
        position: relative;
        width: 100%;
    }

    .search-input-group .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.95rem;
        pointer-events: none;
    }

    .form-control-modern {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.7rem 1rem 0.7rem 42px;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.25s ease;
    }

    .modal-body .form-control-modern {
        padding-left: 16px;
        background-color: #fff;
    }

    .form-control-modern:focus {
        background-color: #fff;
        border-color: var(--indigo);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        color: #1e293b;
    }

    /* Table styles */
    .table-header-modern {
        background-color: #f8fafc;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #edf2f7;
    }

    .table-row-modern {
        transition: background-color 0.2s ease;
    }

    .table-row-modern:hover {
        background-color: rgba(248, 250, 252, 0.6);
    }

    /* Circular Letter Avatar */
    .avatar-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: #fff;
    }

    /* Soft premium gradient avatars */
    .avatar-indigo { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
    .avatar-emerald { background: linear-gradient(135deg, #34d399 0%, #10b981 100%); }
    .avatar-amber { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); }
    .avatar-rose { background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); }
    .avatar-sky { background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); }
    .avatar-teal { background: linear-gradient(135deg, #2dd4bf 0%, #0d9488 100%); }

    /* iOS Toggle Switch Styles */
    .status-toggle-wrapper {
        display: flex;
        align-items: center;
    }

    .switch-ios {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
        margin: 0;
    }

    .switch-ios input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider-ios {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: .3s;
        border-radius: 24px;
    }

    .slider-ios:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: #fff;
        transition: .25s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .switch-ios input:checked + .slider-ios {
        background-color: #10b981;
    }

    .switch-ios input:checked + .slider-ios:before {
        transform: translateX(22px);
    }

    /* Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        border: none;
        background: transparent;
        transition: all 0.2s ease;
    }

    .btn-action-info { color: #0284c7; background-color: rgba(2, 132, 199, 0.08); }
    .btn-action-info:hover { color: #fff; background-color: #0284c7; }

    .btn-action-warning { color: #d97706; background-color: rgba(217, 119, 6, 0.08); }
    .btn-action-warning:hover { color: #fff; background-color: #d97706; }

    .btn-action-danger { color: #dc2626; background-color: rgba(220, 38, 38, 0.08); }
    .btn-action-danger:hover { color: #fff; background-color: #dc2626; }

    /* Modal polish */
    .id-badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }

    .divider {
        height: 1px;
        background-color: #e2e8f0;
        width: 100%;
    }

    /* Custom scrollbar in responsive tables */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }
</style>

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
            const categoryId = checkbox.data('id');
            const newStatus = checkbox.prop('checked') ? 1 : 0;
            const textElement = checkbox.closest('.status-toggle-wrapper').find('.status-badge-text');

            // Disable check temporarily to avoid double requests
            checkbox.prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.update.expense.category.status') }}",
                type: 'POST',
                data: {
                    id: categoryId,
                    status: newStatus
                },
                success: function(response) {
                    checkbox.prop('disabled', false);
                    
                    // Update layout elements
                    if (newStatus === 1) {
                        textElement.text('Active').removeClass('text-danger').addClass('text-success');
                        toastr.success('Category activated successfully!', 'Status Updated');
                    } else {
                        textElement.text('Inactive').removeClass('text-success').addClass('text-danger');
                        toastr.info('Category deactivated successfully.', 'Status Updated');
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

        // 2. VIEW CATEGORY DETAILS MODALPOPULATION
        $('.view-category-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const name = btn.data('name');
            const desc = btn.data('description') || 'No description provided for this category.';
            const isActive = parseInt(btn.data('active'));
            const created = btn.data('created');
            const updated = btn.data('updated');

            // Populating visual elements
            $('#view_id').text(id);
            $('#view_name').text(name);
            $('#view_description').text(desc);
            $('#view_created_at').text(created);
            $('#view_updated_at').text(updated);
            $('#view_avatar_initial').text(name.charAt(0).toUpperCase());

            const statusBadge = $('#view_status_badge');
            if (isActive === 1) {
                statusBadge.text('Active').removeClass('bg-danger-soft text-danger').addClass('bg-success-soft text-success');
            } else {
                statusBadge.text('Inactive').removeClass('bg-success-soft text-success').addClass('bg-danger-soft text-danger');
            }

            // Trigger Modal show
            $('#viewCategoryModal').modal('show');
        });

        // 3. EDIT CATEGORY MODAL POPULATION
        $('.edit-category-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const name = btn.data('name');
            const desc = btn.data('description');

            // Populate form fields
            $('#edit_name').val(name);
            $('#edit_description').val(desc);

            // Construct update route URL: /admin/expense-categories/{id}
            const updateUrl = "{{ route('admin.expense-categories.index') }}/" + id;
            $('#editCategoryForm').attr('action', updateUrl);

            // Trigger Modal show
            $('#editCategoryModal').modal('show');
        });

        // 4. AJAX DELETE CATEGORY WITH SWEETALERT2
        $('.delete-category-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const row = $(`#row-${id}`);

            Swal.fire({
                title: 'Delete Category?',
                text: "All associated transactions will lose their direct category! This action cannot be undone.",
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
                        url: "{{ route('admin.expense-categories.index') }}/" + id,
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
                                toastr.success('Category has been deleted successfully.', 'Deleted!');
                            } else {
                                toastr.error(response.message || 'Something went wrong', 'Failed!');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Could not delete the category. Please try again.', 'Error!');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
