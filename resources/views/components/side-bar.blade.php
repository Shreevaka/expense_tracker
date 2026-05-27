<style>
    .sidebar {
        width: 280px;
        background-color: var(--sidebar-bg);
        color: #fff;
        height: 100vh;
        position: sticky;
        top: 0;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar-header {
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sidebar-header img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
    }

    .sidebar-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        background: linear-gradient(to right, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .sidebar-menu {
        flex: 1;
        padding: 1rem 0.75rem;
        list-style: none;
        margin: 0;
        overflow-y: auto;
    }

    .menu-label {
        color: #475569;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 1.5rem 1.25rem 0.75rem;
        letter-spacing: 0.05em;
    }

    .menu-item {
        margin-bottom: 0.25rem;
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.875rem 1.25rem;
        color: var(--sidebar-text);
        text-decoration: none;
        border-radius: 10px;
        transition: var(--transition);
        font-weight: 500;
    }

    .menu-link i {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
    }

    .menu-link:hover {
        background-color: var(--sidebar-hover);
        color: #fff;
    }

    .menu-link.active {
        background-color: var(--sidebar-active);
        color: #fff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .user-card {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.03);
        padding: 0.75rem;
        border-radius: 12px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .user-info {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-role {
        display: block;
        font-size: 0.75rem;
        color: var(--sidebar-text);
    }

    .logout-btn {
        color: #ef4444;
        text-decoration: none;
        font-size: 1.1rem;
        transition: var(--transition);
    }

    .logout-btn:hover {
        transform: scale(1.1);
    }
</style>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
        <h2>ExpenseX</h2>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-label">Main Menu</li>
        
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link {{ $activePage == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-label">Management</li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('admin.expense-categories.index') }}" class="menu-link {{ $activePage == 'expense_category' ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Expense Category</span>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('admin.income-categories.index') }}" class="menu-link {{ $activePage == 'income_category' ? 'active' : '' }}">
                <i class="fas fa-hand-holding-usd"></i>
                <span>Income Category</span>
            </a>
        </li>

        <li class="menu-label">System</li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>

        <!-- <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="fas fa-shield-alt"></i>
                <span>Security</span>
            </a>
        </li> -->
    </ul>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                AD
            </div>
            <div class="user-info">
                <span class="user-name">Admin User</span>
                <span class="user-role">Administrator</span>
            </div>
            <a href="#" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
</aside>
