<?php

header('Content-Type: application/json');

// Step 1: Read the JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['order']) || !is_array($input['order']) || empty($input['order'])) {
    echo json_encode(['error' => 'Invalid or empty order data.']);
    exit;
}

$orderItems = $input['order'];
$orderJson = json_encode($orderItems);

// Step 2: Connect to database
$host = 'localhost';
$db = 'delicream_db'; // Change to your DB name
$user = 'root'; // Change if needed
$pass = ''; // Change if needed
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Step 3: Insert the order into the database
try {
    $stmt = $pdo->prepare("INSERT INTO orders (items, created_at) VALUES (?, NOW())");
    $stmt->execute([$orderJson]);
    echo json_encode(['message' => 'Order saved successfully!']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to save order: ' . $e->getMessage()]);
    exit;
}
