@extends('layouts.app', ['activePage' => 'expense_category', 'activeSection' => 'admin'])

@section('content')

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3 animate-up">
    <div>
        <h1 class="h3 fw-bold mb-1 text-dark-gradient">Edit Expense Category</h1>
        <p class="text-muted mb-0">Modify category details and description.</p>
    </div>
    <a href="{{ route('admin.expense-categories.index') }}" class="btn btn-outline-secondary animate-hover-up">
        <i class="fas fa-arrow-left me-2"></i> Back to Categories
    </a>
</div>

<!-- Form Card -->
<div class="row animate-up" style="animation-delay: 0.1s">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-light-soft py-3 px-4">
                <h5 class="card-title fw-bold text-dark mb-0">
                    <i class="fas fa-edit text-warning me-2"></i>Category Information (ID: #{{ $category->id }})
                </h5>
            </div>
            <form action="{{ route('admin.expense-categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-muted">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-modern" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g. Marketing, Utilities" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label fw-semibold text-muted">Description</label>
                        <textarea class="form-control form-control-modern" id="description" name="description" rows="5" placeholder="Brief description...">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>
                <div class="card-footer border-0 bg-white p-4 pt-0 d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.expense-categories.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                    <button type="submit" class="btn btn-indigo px-4 shadow-indigo">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
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

    .btn-indigo {
        background-color: var(--indigo);
        color: #fff;
        border: 1px solid var(--indigo);
        font-weight: 600;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        transition: all 0.2s ease;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        color: #fff;
        border-color: var(--indigo-hover);
        box-shadow: 0 4px 12px var(--indigo-shadow);
    }

    .shadow-indigo {
        box-shadow: 0 4px 14px var(--indigo-shadow);
    }

    .bg-light-soft {
        background-color: #f8fafc;
    }

    .form-control-modern {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.25s ease;
    }

    .form-control-modern:focus {
        background-color: #fff;
        border-color: var(--indigo);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        color: #1e293b;
    }

    .animate-hover-up:hover {
        transform: translateY(-2px);
    }
</style>

@endsection
