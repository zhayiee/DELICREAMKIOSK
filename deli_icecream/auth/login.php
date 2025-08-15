<?php
require_once '../config/session.php';
require_once '../config/db.php';

// Check if database connection is established
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed: " . ($conn ? $conn->connect_error : "Connection not initialized."));
}

if (isLoggedIn()) {
    header("Location: ../dashboard.php");
    exit();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log POST data for debugging
    error_log("POST data: " . print_r($_POST, true), 3, 'C:/xampp/htdocs/deli_icecream/logs/debug.log');

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $errors[] = "Database query preparation failed: " . $conn->error;
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    $errors[] = "Invalid password.";
                }
            } else {
                $errors[] = "Invalid username.";
            }
            $stmt->close();
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Deli Ice Cream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffe6f0 0%, #ff99cc 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .login-card {
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(255, 105, 180, 0.2);
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            z-index: 1;
        }
        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(255, 105, 180, 0.3);
        }
        .login-title {
            color: #ff69b4;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .btn-pink {
            background-color: #ff69b4;
            border-color: #ff69b4;
            color: #fff;
            border-radius: 10px;
            padding: 0.75rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-pink:hover {
            background-color: #ff4d94;
            border-color: #ff4d94;
            transform: scale(1.05);
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ffb6c1;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #ff69b4;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
        }
        .alert {
            border-radius: 10px;
            background-color: #ffe6f0;
            color: #c2185b;
            border: 1px solid #ff99cc;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 10px 20px;
            max-width: 300px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .link-pink {
            color: #ff69b4;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link-pink:hover {
            color: #ff4d94;
            text-decoration: underline;
        }
        .form-label {
            color: #2c3e50;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" id="errorAlert">
                <?php foreach ($errors as $error): ?>
                    <p class="mb-0"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'Registration successful! Please log in.'): ?>
            <div class="alert alert-success alert-dismissible fade show" id="successAlert">
                <p class="mb-0">Registration Successful! Please log in.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="login-card">
            <h2 class="login-title">Deli Ice Cream Login</h2>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-pink w-100">Login</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="loading.php?next=forgot.php&action=Loading" class="link-pink">Forgot Password?</a>
            </div>
            <div class="text-center mt-2">
                <a href="loading.php?next=register.php&action=Processing" class="link-pink">Register for Staff</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hide alerts after 5 seconds
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.remove('show');
                successAlert.style.display = 'none';
            }, 5000);
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.remove('show');
                errorAlert.style.display = 'none';
            }, 5000);
        }
    </script>
</body>
</html>