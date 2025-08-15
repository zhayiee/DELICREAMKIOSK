<?php
session_start();

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to check user role
function checkRole($required_role) {
    if (!isLoggedIn()) {
        header("Location: ../auth/login.php");
        exit();
    }
    
    if (isset($_SESSION['role']) && $_SESSION['role'] !== $required_role) {
        // Redirect to appropriate dashboard based on role
        if ($_SESSION['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../staff/dashboard.php");
        }
        exit();
    }
}

// Function to get current user ID
function getUserId() {
    return isLoggedIn() ? $_SESSION['user_id'] : null;
}

// Function to get current user role
function getUserRole() {
    return isLoggedIn() ? $_SESSION['role'] : null;
}

// Function to redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../auth/login.php");
        exit();
    }
}

// Function to check if user is admin
function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

// Function to check if user is staff
function isStaff() {
    return isLoggedIn() && $_SESSION['role'] === 'staff';
}

// Function to destroy session and logout
function logout() {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
?>