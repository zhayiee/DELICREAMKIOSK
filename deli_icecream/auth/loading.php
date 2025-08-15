<?php
require_once '../config/session.php';

if (isLoggedIn()) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: staff/dashboard.php");
    }
    exit();
}

$next = isset($_GET['next']) ? $_GET['next'] : 'login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading - Deli Ice Cream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffe6f0 0%, #ff99cc 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .spinner {
            border: 8px solid #ffb6c1;
            border-top: 8px solid #ff69b4;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="spinner"></div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "<?php echo htmlspecialchars($next); ?>";
        }, 800); // Redirect after 0.1 seconds
    </script>
</body>
</html>