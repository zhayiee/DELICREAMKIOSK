<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'unknown';
?>

<aside class="sidebar-modern">
    <div class="sidebar-content">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-icon">
                <i class="fas fa-ice-cream"></i>
            </div>
            <h4 class="brand-title">Navigation</h4>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="nav-menu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a class="nav-link" href="/deli_icecream/dashboard.php">
                        <div class="nav-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <?php if ($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/manage_users.php">
                            <div class="nav-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="nav-text">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/reports.php">
                            <div class="nav-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <span class="nav-text">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/settings.php">
                            <div class="nav-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                <?php elseif ($role === 'staff'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/tasks.php">
                            <div class="nav-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <span class="nav-text">Tasks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/profile.php">
                            <div class="nav-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <!-- Footer Section -->
        <div class="sidebar-footer">
            <div class="user-role-badge">
                <i class="fas fa-shield-alt"></i>
                <span><?php echo ucfirst($role); ?></span>
            </div>
        </div>
    </div>
</aside>

<style>
:root {
    --pink-primary: #ff69b4;
    --pink-secondary: #ff85c1;
    --pink-light: #ffe6f0;
    --pink-dark: #e55ca0;
    --pink-gradient: linear-gradient(135deg, #ff69b4, #ff85c1);
    --white: #ffffff;
    --gray-light: #f8f9fa;
    --gray-medium: #6c757d;
    --shadow-light: 0 2px 10px rgba(255, 105, 180, 0.1);
    --shadow-medium: 0 4px 20px rgba(255, 105, 180, 0.15);
    --shadow-heavy: 0 8px 30px rgba(255, 105, 180, 0.2);
}

.sidebar-modern {
    width: 280px;
    min-height: 100vh;
    background: var(--white);
    border-right: 2px solid var(--pink-light);
    box-shadow: var(--shadow-medium);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
}

.sidebar-content {
    padding: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.brand-section {
    padding: 2rem 1.5rem;
    background: var(--pink-gradient);
    color: var(--white);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.brand-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: rotate(0deg); }
    50% { transform: rotate(180deg); }
}

.brand-icon {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 2;
}

.brand-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 2;
}

.nav-menu {
    flex: 1;
    padding: 1.5rem 0;
}

.nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    margin: 0.25rem 1rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    color: var(--gray-medium);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    background: transparent;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--pink-gradient);
    transition: left 0.3s ease;
    z-index: -1;
}

.nav-link:hover::before {
    left: 0;
}

.nav-link:hover {
    color: var(--white);
    transform: translateX(5px);
    box-shadow: var(--shadow-light);
}

.nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.nav-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.nav-text {
    font-weight: 500;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
}

.sidebar-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--pink-light);
    background: var(--gray-light);
}

.user-role-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem;
    background: var(--pink-light);
    color: var(--pink-dark);
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
}

.user-role-badge i {
    margin-right: 0.5rem;
    font-size: 1rem;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .sidebar-modern {
        width: 100%;
        position: relative;
        min-height: auto;
        border-right: none;
        border-bottom: 2px solid var(--pink-light);
    }
    
    .brand-section {
        padding: 1.5rem 1rem;
    }
    
    .brand-icon {
        font-size: 2rem;
    }
    
    .brand-title {
        font-size: 1.1rem;
    }
    
    .nav-menu {
        padding: 1rem 0;
    }
    
    .nav-item {
        margin: 0.25rem 0.5rem;
    }
    
    .nav-link {
        padding: 0.75rem 1rem;
    }
    
    .sidebar-footer {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .nav-link {
        padding: 0.6rem 0.8rem;
    }
    
    .nav-text {
        font-size: 0.9rem;
    }
    
    .nav-icon {
        margin-right: 0.8rem;
        font-size: 1rem;
    }
}
</style>