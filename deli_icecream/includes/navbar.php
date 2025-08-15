<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<nav class="navbar-modern">
    <div class="navbar-container">
        <!-- Brand Section -->
        <div class="navbar-brand">
            <a href="/deli_icecream/dashboard.php" class="brand-link">
                <div class="brand-logo">
                    <i class="fas fa-ice-cream"></i>
                </div>
                <span class="brand-name">Deli Ice Cream</span>
            </a>
        </div>
        
        <!-- Mobile Toggle -->
        <button class="mobile-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
        </button>
        
        <!-- User Section -->
        <div class="navbar-collapse collapse" id="navbarContent">
            <div class="navbar-user">
                <div class="user-dropdown">
                    <button class="user-btn" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name"><?php echo htmlspecialchars($username); ?></span>
                            <span class="user-status">Online</span>
                        </div>
                        <div class="dropdown-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-header">
                            <div class="user-avatar-large">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <strong><?php echo htmlspecialchars($username); ?></strong>
                                <small class="text-muted">Welcome back!</small>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="auth/profile.php">
                            <i class="fas fa-user me-2"></i>
                            <span>My Profile</span>
                        </a>
                        <a class="dropdown-item" href="auth/settings.php">
                            <i class="fas fa-cog me-2"></i>
                            <span>Settings</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item logout-item" href="auth/logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

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
    --gray-dark: #343a40;
    --shadow-light: 0 2px 10px rgba(255, 105, 180, 0.1);
    --shadow-medium: 0 4px 20px rgba(255, 105, 180, 0.15);
    --shadow-heavy: 0 8px 30px rgba(255, 105, 180, 0.2);
}

.navbar-modern {
    background: var(--white);
    border-bottom: 2px solid var(--pink-light);
    box-shadow: var(--shadow-medium);
    position: sticky;
    top: 0;
    z-index: 1030;
    padding: 0;
}

.navbar-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1.5rem;
    max-width: 100%;
    margin: 0 auto;
}

.navbar-brand {
    flex-shrink: 0;
}

.brand-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--gray-dark);
    transition: all 0.3s ease;
}

.brand-link:hover {
    color: var(--pink-primary);
    text-decoration: none;
}

.brand-logo {
    width: 40px;
    height: 40px;
    background: var(--pink-gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    font-size: 1.25rem;
    color: var(--white);
    transition: transform 0.3s ease;
    box-shadow: var(--shadow-light);
}

.brand-link:hover .brand-logo {
    transform: scale(1.05) rotate(5deg);
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.mobile-toggle {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 24px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

.toggle-line {
    width: 100%;
    height: 3px;
    background: var(--pink-primary);
    border-radius: 2px;
    transition: all 0.3s ease;
    transform-origin: center;
}

.mobile-toggle:hover .toggle-line {
    background: var(--pink-dark);
}

.navbar-collapse {
    flex-grow: 0;
}

.navbar-user {
    display: flex;
    align-items: center;
}

.user-dropdown {
    position: relative;
}

.user-btn {
    display: flex;
    align-items: center;
    background: var(--gray-light);
    border: 2px solid transparent;
    border-radius: 50px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    color: var(--gray-dark);
}

.user-btn:hover {
    background: var(--pink-light);
    border-color: var(--pink-primary);
    transform: translateY(-1px);
    box-shadow: var(--shadow-light);
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: var(--pink-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    color: var(--white);
    font-size: 0.9rem;
}

.user-info {
    display: flex;
    flex-direction: column;
    margin-right: 0.75rem;
}

.user-name {
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.2;
    color: var(--gray-dark);
}

.user-status {
    font-size: 0.75rem;
    color: var(--pink-primary);
    font-weight: 500;
}

.dropdown-arrow {
    color: var(--gray-medium);
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.user-btn[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

.dropdown-menu {
    border: none;
    border-radius: 16px;
    box-shadow: var(--shadow-heavy);
    padding: 0;
    margin-top: 0.5rem;
    min-width: 280px;
    overflow: hidden;
}

.dropdown-header {
    background: var(--pink-gradient);
    color: var(--white);
    padding: 1.25rem;
    display: flex;
    align-items: center;
    border: none;
}

.user-avatar-large {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.1rem;
    color: var(--white);
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-details strong {
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.user-details small {
    opacity: 0.8;
    font-size: 0.8rem;
}

.dropdown-divider {
    margin: 0;
    border-color: var(--pink-light);
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.875rem 1.25rem;
    color: var(--gray-dark);
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
}

.dropdown-item:hover {
    background: var(--pink-light);
    color: var(--pink-dark);
    transform: translateX(5px);
}

.dropdown-item i {
    color: var(--pink-primary);
    width: 20px;
    text-align: center;
}

.logout-item:hover {
    background: #ffe6e6;
    color: #dc3545;
}

.logout-item:hover i {
    color: #dc3545;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .mobile-toggle {
        display: flex;
    }
    
    .navbar-container {
        padding: 0.5rem 1rem;
    }
    
    .brand-name {
        font-size: 1.3rem;
    }
    
    .brand-logo {
        width: 36px;
        height: 36px;
        margin-right: 0.5rem;
        font-size: 1.1rem;
    }
    
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: var(--white);
        border-top: 1px solid var(--pink-light);
        box-shadow: var(--shadow-medium);
        padding: 1rem;
    }
    
    .user-btn {
        width: 100%;
        justify-content: flex-start;
        margin-bottom: 0.5rem;
    }
    
    .dropdown-menu {
        position: static !important;
        transform: none !important;
        box-shadow: none;
        border: 1px solid var(--pink-light);
        margin-top: 0;
        width: 100%;
    }
}

@media (max-width: 480px) {
    .navbar-container {
        padding: 0.5rem 0.75rem;
    }
    
    .brand-name {
        font-size: 1.2rem;
    }
    
    .user-info {
        display: none;
    }
    
    .user-btn {
        padding: 0.5rem;
    }
    
    .dropdown-menu {
        min-width: 250px;
    }
}

/* Animation for mobile toggle */
@media (max-width: 768px) {
    .mobile-toggle.collapsed .toggle-line:nth-child(1) {
        transform: rotate(45deg) translate(6px, 6px);
    }
    
    .mobile-toggle.collapsed .toggle-line:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-toggle.collapsed .toggle-line:nth-child(3) {
        transform: rotate(-45deg) translate(6px, -6px);
    }
}
</style>