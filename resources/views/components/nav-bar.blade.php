<style>
    .navbar-custom {
        height: 80px;
        background-color: #fff;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-wrapper {
        position: relative;
        width: 400px;
    }

    .search-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .search-input {
        width: 100%;
        padding: 0.625rem 1rem 0.625rem 2.75rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        outline: none;
        transition: var(--transition);
        font-size: 0.875rem;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .nav-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: var(--text-muted);
        text-decoration: none;
        transition: var(--transition);
        background-color: #f8fafc;
        position: relative;
    }

    .nav-btn:hover {
        background-color: #f1f5f9;
        color: var(--primary-color);
    }

    .badge-notif {
        position: absolute;
        top: -4px;
        right: -4px;
        background-color: #ef4444;
        color: #fff;
        font-size: 0.625rem;
        font-weight: 700;
        padding: 2px 5px;
        border-radius: 10px;
        border: 2px solid #fff;
    }

    .date-display {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-right: 1rem;
        padding-right: 1.5rem;
        border-right: 1px solid #e2e8f0;
    }

    .nav-actions > div:last-child {
        border-right: none;
    }
</style>

<nav class="navbar-custom">
    <div class="d-flex align-items-center">
    </div>

    <div class="nav-actions">

        <div class="date-display d-none d-lg-block">
            <i class="far fa-calendar-alt me-2"></i>
            {{ date('l, F j, Y') }}
        </div>
    </div>
</nav>
