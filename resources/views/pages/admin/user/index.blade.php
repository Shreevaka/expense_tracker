@extends('layouts.app', ['activePage' => 'user', 'activeSection' => 'admin'])

@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Users</h1>
        <p class="text-muted mb-0">Manage system users.</p>
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
                <span class="stat-label">Total Users</span>
                <h2 class="stat-value text-dark">{{ $totalCount }}</h2>
                <span class="stat-trend text-muted">All registered users</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-success">
            <div class="stat-icon bg-success-soft text-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Active Users</span>
                <h2 class="stat-value text-success">{{ $activeCount }}</h2>
                <span class="stat-trend text-success-muted">Enabled and active users</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card border-left-danger">
            <div class="stat-icon bg-danger-soft text-danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Inactive Users</span>
                <h2 class="stat-value text-danger">{{ $inactiveCount }}</h2>
                <span class="stat-trend text-danger-muted">Deactivated users</span>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4 animate-up" style="animation-delay: 0.2s">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon text-muted"></i>
                    <input type="text" name="sr" class="form-control form-control-modern" placeholder="Search users by name & email..." value="{{ request('sr') }}">
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-indigo flex-grow-1">
                    Search
                </button>
                @if(request('sr'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-custom" title="Clear Search">
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
                        <th class="ps-4 py-3">User Name</th>
                        <th class="py-3">E-mail</th>
                        <th class="py-3">Contact Number</th>
                        <th class="py-3">Preferred Currency</th>
                        <th class="py-3" style="width: 150px">Status</th>
                        <th class="py-3" style="width: 180px">Joined date</th>
                        <th class="pe-4 py-3 text-center" style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr id="row-{{ $user->id }}" class="table-row-modern">
                            <td class="ps-4">
                                <span class="text-muted">{{ $user->name }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $user->email}}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $user->contact_no}}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $user->preferred_currency ?? '---'}}
                                </span>
                            </td>
                            <td>
                                <div class="status-toggle-wrapper">
                                    <label class="switch-ios">
                                        <input type="checkbox" class="status-toggle-checkbox" 
                                               data-id="{{ $user->id }}" 
                                               {{ $user->is_active ? 'checked' : '' }}>
                                        <span class="slider-ios"></span>
                                    </label>
                                    <span class="status-badge-text {{ $user->is_active ? 'text-success' : 'text-danger' }} fw-semibold ms-2">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i> {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Action -->
                                    <button class="btn btn-action btn-action-info view-user-btn" 
                                            data-id="{{ $user->id }}"
                                            data-avatar="{{ $user->image_url }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-contact_no="{{ $user->contact_no }}"
                                            data-preferred_currency="{{ $user->preferred_currency }}"
                                            data-active="{{ $user->is_active }}"
                                            data-created="{{ $user->created_at ? $user->created_at->format('M d, Y h:i A') : 'N/A' }}"
                                            data-updated="{{ $user->updated_at ? $user->updated_at->format('M d, Y h:i A') : 'N/A' }}"
                                            title="View Details">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-folder-open text-muted fa-3x"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">No Users Found</h5>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->withQueryString()->links('components.paginations') }}
    </div>
</div>


<!-- View Details Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-indigo py-3 px-4 text-white">
                <h5 class="modal-title fw-bold" id="viewUserModalLabel">
                    <i class="fas fa-info-circle me-2"></i>User Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm mb-3 overflow-hidden"
                        style="width: 72px; height: 72px;">

                        <img id="view_profile_image"
                            src=""
                            alt="Profile"
                            class="w-100 h-100 object-fit-cover">

                    </div>
                    <h4 class="fw-bold text-dark mb-1" id="view_name">User</h4>
                </div>
                
                <div class="divider mb-4"></div>

                <div class="row g-3">
                    <div class="col-6">
                        <label class="small text-muted fw-semibold d-block mb-1">Email</label>
                        <div class="text-muted small" id="view_email">user@gmail.com</div>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted fw-semibold d-block mb-1">Contact Number</label>
                        <div class="text-muted small" id="view_contact_no">0765123456</div>
                    </div>
                    <div class="col-6 d-flex align-items-center gap-2">
                        <label class="small text-muted fw-semibold mb-0">Status:</label>
                        <span class="badge py-2 px-3 rounded-pill" id="view_status_badge">Active</span>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted fw-semibold d-block mb-1">Preferred Currency</label>
                        <div class="text-muted small" id="view_preferred_currency">LKR</div>
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
            const UserId = checkbox.data('id');
            const newStatus = checkbox.prop('checked') ? 1 : 0;
            const textElement = checkbox.closest('.status-toggle-wrapper').find('.status-badge-text');

            // Disable check temporarily to avoid double requests
            checkbox.prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.update.user.status') }}",
                type: 'POST',
                data: {
                    id: UserId,
                    status: newStatus
                },
                success: function(response) {
                    checkbox.prop('disabled', false);
                    
                    // Update layout elements
                    if (newStatus === 1) {
                        textElement.text('Active').removeClass('text-danger').addClass('text-success');
                        toastr.success('User activated successfully!', 'Status Updated');
                    } else {
                        textElement.text('Inactive').removeClass('text-success').addClass('text-danger');
                        toastr.info('User deactivated successfully.', 'Status Updated');
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

        // 2. VIEW User DETAILS MODALPOPULATION
        $('.view-user-btn').on('click', function() {
            const btn = $(this);
            const id = btn.data('id');
            const image = btn.data('avatar');
            const name = btn.data('name');
            const email = btn.data('email');
            const contact_no = btn.data('contact_no');
            const preferred_currency = btn.data('preferred_currency') || '---';
            const isActive = parseInt(btn.data('active'));
            const created = btn.data('created');
            const updated = btn.data('updated');

            // Populating visual elements
            $('#view_id').text(id);
            $('#view_name').text(name);
            $('#view_email').text(email);
            $('#view_contact_no').text(contact_no);
            $('#view_preferred_currency').text(preferred_currency);
            $('#view_created_at').text(created);
            $('#view_updated_at').text(updated);
            $('#view_profile_image').attr('src', image);

            const statusBadge = $('#view_status_badge');
            if (isActive === 1) {
                statusBadge.text('Active').removeClass('bg-danger-soft text-danger').addClass('bg-success-soft text-success');
            } else {
                statusBadge.text('Inactive').removeClass('bg-success-soft text-success').addClass('bg-danger-soft text-danger');
            }

            // Trigger Modal show
            $('#viewUserModal').modal('show');
        });
    });
</script>
@endpush
