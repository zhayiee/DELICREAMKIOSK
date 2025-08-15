<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include configuration files
$sessionIncluded = @include_once 'config/session.php';
$dbIncluded = @include_once 'config/db.php';

// Define log file path
$logDir = __DIR__ . '/logs';
$logFile = $logDir . '/debug.log';

// Create logs directory if it doesn't exist
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

if (!$sessionIncluded || !$dbIncluded) {
    if (is_writable($logDir)) {
        error_log("Failed to include config/session.php or config/db.php", 3, $logFile);
    }
    header("Location: auth/login.php?error=Server configuration error.");
    exit();
}

// Ensure required functions exist
if (!function_exists('requireLogin') || !function_exists('getUserId') || !function_exists('getUserRole') || !function_exists('logout')) {
    if (is_writable($logDir)) {
        error_log("Required session functions missing", 3, $logFile);
    }
    header("Location: auth/login.php?error=Session functions not found.");
    exit();
}

// Prevent redirect loop with a counter
if (!isset($_SESSION['redirect_count'])) {
    $_SESSION['redirect_count'] = 0;
}
$_SESSION['redirect_count']++;
if ($_SESSION['redirect_count'] > 3) {
    if (is_writable($logDir)) {
        error_log("Redirect loop detected on dashboard.php, count: {$_SESSION['redirect_count']}", 3, $logFile);
    }
    session_unset();
    session_destroy();
    header("Location: auth/login.php?error=Redirect loop detected. Please clear cookies.");
    exit();
}

// Check if user is logged in with session variables
if (!isLoggedIn()) {
    if (is_writable($logDir)) {
        error_log("Session variables missing or user not logged in: " . print_r($_SESSION, true), 3, $logFile);
    }
    $_SESSION['redirect_count'] = 0; // Reset counter
    header("Location: auth/login.php?error=Please log in.");
    exit();
}

// Check database connection
if (!isset($conn) || $conn->connect_error) {
    if (is_writable($logDir)) {
        error_log("Database connection failed: " . ($conn ? $conn->connect_error : "Connection not initialized"), 3, $logFile);
    }
    $_SESSION['redirect_count'] = 0;
    header("Location: auth/login.php?error=Database connection error.");
    exit();
}

// Fetch user details
$userId = getUserId() ?? 0;
$username = $_SESSION['username'] ?? 'User';
$role = getUserRole() ?? 'unknown';

// Log user access
if (is_writable($logDir)) {
    error_log("User ID: $userId, Username: $username, Role: $role accessed dashboard", 3, $logFile);
}

// Fetch user data from database
$sql = "SELECT username, role, created_at FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    if (is_writable($logDir)) {
        error_log("Query preparation failed: " . $conn->error, 3, $logFile);
    }
    $_SESSION['redirect_count'] = 0;
    header("Location: auth/login.php?error=Database query error.");
    exit();
}
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->num_rows === 1 ? $result->fetch_assoc() : null;
$stmt->close();

// Validate user data
if (!$userData || !in_array($userData['role'], ['admin', 'staff'])) {
    if (is_writable($logDir)) {
        error_log("Invalid user data or role for ID: $userId, Role: " . ($userData['role'] ?? 'none'), 3, $logFile);
    }
    $_SESSION['redirect_count'] = 0;
    header("Location: auth/login.php?error=Invalid user data or role.");
    exit();
}

// Fetch example metrics (avoiding non-existent tables)
$totalUsers = 0;
$totalTasks = 0;
if ($userData['role'] === 'admin') {
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    if ($result) {
        $totalUsers = $result->fetch_assoc()['count'];
    } else {
        if (is_writable($logDir)) {
            error_log("Failed to fetch total users: " . $conn->error, 3, $logFile);
        }
    }
}
// For staff, use placeholder for tasks since tasks table doesn't exist
if ($userData['role'] === 'staff') {
    $totalTasks = 0; // Placeholder for example dashboard
}

// Reset redirect counter on successful load
$_SESSION['redirect_count'] = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Deli Ice Cream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --pink-primary: #ff69b4;
            --pink-secondary: #ff85c1;
            --pink-light: #ffe6f0;
            --pink-dark: #e55ca0;
            --pink-gradient: linear-gradient(135deg, #ff69b4, #ff85c1);
            --pink-gradient-soft: linear-gradient(135deg, #ffe6f0, #ffb3d9);
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-medium: #6c757d;
            --gray-dark: #343a40;
            --shadow-light: 0 2px 15px rgba(255, 105, 180, 0.08);
            --shadow-medium: 0 4px 25px rgba(255, 105, 180, 0.12);
            --shadow-heavy: 0 8px 40px rgba(255, 105, 180, 0.15);
            --shadow-glow: 0 0 30px rgba(255, 105, 180, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #fdf7ff 0%, #f8f0ff 25%, #ffe6f0 75%, #ffb3d9 100%);
            background-attachment: fixed;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            color: var(--gray-dark);
            line-height: 1.6;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 105, 180, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 133, 193, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        .main-content {
            flex: 1;
            padding: 0;
            background: transparent;
            overflow-x: hidden;
        }

        .content-header {
            background: var(--white);
            border-bottom: 1px solid var(--pink-light);
            box-shadow: var(--shadow-light);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .content-body {
            padding: 2rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Welcome Section */
        .welcome-section {
            background: var(--white);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-medium);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--pink-light);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: var(--pink-gradient-soft);
            border-radius: 50%;
            opacity: 0.5;
            z-index: 0;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-title {
            font-size: 2.25rem;
            font-weight: 800;
            background: var(--pink-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            color: var(--gray-medium);
            margin-bottom: 1.5rem;
        }

        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .user-info-card {
            background: var(--pink-light);
            border-radius: 16px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .user-info-card:hover {
            transform: translateY(-2px);
        }

        .user-info-icon {
            width: 48px;
            height: 48px;
            background: var(--pink-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--white);
            font-size: 1.25rem;
        }

        .user-info-text h6 {
            margin: 0;
            font-size: 0.9rem;
            color: var(--gray-medium);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .user-info-text p {
            margin: 0.25rem 0 0 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--pink-dark);
        }

        /* Metrics Section */
        .metrics-section {
            margin-bottom: 3rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-dark);
            margin: 0;
        }

        .section-subtitle {
            font-size: 0.9rem;
            color: var(--gray-medium);
            margin: 0;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .metric-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid var(--pink-light);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg at 50% 50%, transparent, var(--pink-light), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .metric-card:hover::before {
            opacity: 0.5;
        }

        .metric-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-heavy);
            border-color: var(--pink-primary);
        }

        .metric-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .metric-icon {
            width: 60px;
            height: 60px;
            background: var(--pink-gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: var(--white);
            box-shadow: var(--shadow-light);
        }

        .metric-trend {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 600;
            color: #10b981;
            background: #ecfdf5;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
        }

        .metric-trend i {
            margin-right: 0.25rem;
        }

        .metric-content {
            position: relative;
            z-index: 1;
        }

        .metric-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--pink-primary);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .metric-label {
            font-size: 1rem;
            color: var(--gray-medium);
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .metric-description {
            font-size: 0.875rem;
            color: var(--gray-medium);
            line-height: 1.4;
        }

        /* Quick Actions */
        .quick-actions {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid var(--pink-light);
            margin-bottom: 2rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background: var(--pink-gradient);
            color: var(--white);
            text-decoration: none;
            border-radius: 16px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-heavy);
            color: var(--white);
            text-decoration: none;
        }

        .action-btn i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Alerts */
        .alert-modern {
            border-radius: 16px;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 500;
            box-shadow: var(--shadow-light);
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1050;
            max-width: 350px;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2, #fecaca);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .dashboard-wrapper {
                margin-left: 0;
            }
            
            .content-body {
                padding: 1.5rem 1rem;
            }
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 1.75rem;
            }
            
            .user-info-grid {
                grid-template-columns: 1fr;
            }
            
            .metrics-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .metric-card {
                padding: 1.5rem;
            }
            
            .metric-value {
                font-size: 2rem;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .alert-modern {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 1rem;
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .content-body {
                padding: 1rem 0.75rem;
            }
            
            .welcome-section {
                padding: 1.5rem;
                border-radius: 16px;
            }
            
            .welcome-title {
                font-size: 1.5rem;
            }
            
            .metric-card {
                padding: 1.25rem;
            }
            
            .quick-actions {
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Include Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <!-- Include Navbar -->
            <div class="content-header">
                <?php include 'includes/navbar.php'; ?>
            </div>

            <div class="content-body">
                <!-- Success/Error Alerts -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert-modern alert-success" id="successAlert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Success!</strong> <?php echo htmlspecialchars($_GET['success']); ?>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert-modern alert-error" id="errorAlert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Welcome Section -->
                <div class="welcome-section">
                    <div class="welcome-content">
                        <h1 class="welcome-title">Welcome back, <?php echo htmlspecialchars($userData['username']); ?>! 🍦</h1>
                        <p class="welcome-subtitle">Here's what's happening with your Deli Ice Cream management system today.</p>
                        
                        <div class="user-info-grid">
                            <div class="user-info-card">
                                <div class="user-info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-info-text">
                                    <h6>Your Role</h6>
                                    <p><?php echo ucfirst(htmlspecialchars($userData['role'])); ?></p>
                                </div>
                            </div>
                            <div class="user-info-card">
                                <div class="user-info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="user-info-text">
                                    <h6>Member Since</h6>
                                    <p><?php echo htmlspecialchars(date('M j, Y', strtotime($userData['created_at']))); ?></p>
                                </div>
                            </div>
                            <div class="user-info-card">
                                <div class="user-info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="user-info-text">
                                    <h6>Last Login</h6>
                                    <p>Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrics Overview -->
                <div class="metrics-section">
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">Dashboard Overview</h2>
                            <p class="section-subtitle">Key metrics and performance indicators</p>
                        </div>
                    </div>

                    <div class="metrics-grid">
                        <?php if ($userData['role'] === 'admin'): ?>
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-arrow-up"></i>
                                        +12%
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value"><?php echo $totalUsers; ?></div>
                                    <div class="metric-label">Total Users</div>
                                    <div class="metric-description">Active users in the system including admin and staff members.</div>
                                </div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-minus"></i>
                                        0%
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value">0</div>
                                    <div class="metric-label">Reports Generated</div>
                                    <div class="metric-description">System reports and analytics generated this month.</div>
                                </div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-check"></i>
                                        Ready
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value">100%</div>
                                    <div class="metric-label">System Health</div>
                                    <div class="metric-description">All systems operational and running smoothly.</div>
                                </div>
                            </div>

                        <?php elseif ($userData['role'] === 'staff'): ?>
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-minus"></i>
                                        0%
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value"><?php echo $totalTasks; ?></div>
                                    <div class="metric-label">Assigned Tasks</div>
                                    <div class="metric-description">Tasks currently assigned to you for completion.</div>
                                </div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-check"></i>
                                        Updated
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value">100%</div>
                                    <div class="metric-label">Profile Complete</div>
                                    <div class="metric-description">Your profile information is complete and up to date.</div>
                                </div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="metric-trend">
                                        <i class="fas fa-minus"></i>
                                        0
                                    </div>
                                </div>
                                <div class="metric-content">
                                    <div class="metric-value">0</div>
                                    <div class="metric-label">Notifications</div>
                                    <div class="metric-description">No new notifications or updates at this time.</div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="section-header">
                        <div>
                            <h3 class="section-title">Quick Actions</h3>
                            <p class="section-subtitle">Frequently used features and shortcuts</p>
                        </div>
                    </div>
                    
                    <div class="actions-grid">
                        <?php if ($userData['role'] === 'admin'): ?>
                            <a href="auth/manage_users.php" class="action-btn">
                                <i class="fas fa-users"></i>
                                Manage Users
                            </a>
                            <a href="auth/reports.php" class="action-btn">
                                <i class="fas fa-file-alt"></i>
                                View Reports
                            </a>
                            <a href="auth/settings.php" class="action-btn">
                                <i class="fas fa-cog"></i>
                                System Settings
                            </a>
                        <?php else: ?>
                            <a href="auth/tasks.php" class="action-btn">
                                <i class="fas fa-tasks"></i>
                                View Tasks
                            </a>
                            <a href="auth/profile.php" class="action-btn">
                                <i class="fas fa-user"></i>
                                Update Profile
                            </a>
                        <?php endif; ?>
                        <a href="auth/profile.php" class="action-btn">
                            <i class="fas fa-user-circle"></i>
                            My Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced alert management
        function hideAlert(alertId, delay = 5000) {
            const alert = document.getElementById(alertId);
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, delay);
            }
        }

        // Auto-hide alerts
        hideAlert('successAlert');
        hideAlert('errorAlert');

        // Add loading animation to metric cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const metricCards = document.querySelectorAll('.metric-card');
            metricCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });

        // Add hover effect to action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.background = 'linear-gradient(135deg, #ff4d94, #ff69b4)';
            });
            btn.addEventListener('mouseleave', function() {
                this.style.background = 'var(--pink-gradient)';
            });
        });
    </script>
</body>
</html>
<?php
// Close database connection
$conn->close();
?>