<?php
require_once '../config/session.php';
require_once '../config/db.php';

if (isLoggedIn()) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: staff/dashboard.php");
    }
    exit();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log POST data for debugging
    error_log("POST data: " . print_r($_POST, true), 3, 'C:/xampp/htdocs/deli_icecream/logs/debug.log');

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validate individual fields
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm Password is required.";
    }
    if (empty($role)) {
        $errors[] = "Role is required.";
    }

    if (empty($errors)) {
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long.";
        } elseif (!in_array($role, ['admin', 'staff'])) {
            $errors[] = "Invalid role selected.";
        } else {
            // Check if username already exists
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $errors[] = "Username already exists.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $hashed_password, $role);

                if ($stmt->execute()) {
                    header("Location: login.php?success=Registration successful! Please log in.");
                    exit();
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
                $stmt->close();
            }
        }
    }

    if (!empty($errors)) {
        $error_msg = urlencode(implode('|', $errors));
        header("Location: register.php?error=" . $error_msg);
        exit();
    }
} else {
    // Log if non-POST request is received
    error_log("Non-POST request received: " . $_SERVER['REQUEST_METHOD'], 3, 'C:/xampp/htdocs/deli_icecream/logs/debug.log');
    header("Location: register.php?error=Invalid request method.");
    exit();
}
?>