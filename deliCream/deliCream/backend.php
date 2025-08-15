<?php
// Sample POST data expected: flavor, toppings[], quantity, price
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flavor = $_POST['flavor'] ?? 'Unknown';
    $toppings = $_POST['toppings'] ?? [];
    $quantity = intval($_POST['quantity'] ?? 1);
    $price = floatval($_POST['price'] ?? 0.00);

    // Calculate total
    $total = $price * $quantity;

    // Generate receipt
    echo "<div style='font-family:monospace; background:#fff8f0; padding:20px; border:2px dashed #d88; width:300px;'>";
    echo "<h2 style='text-align:center; color:#d44;'>🍨 Ice Cream Receipt</h2>";
    echo "<p><strong>Flavor:</strong> {$flavor}</p>";
    echo "<p><strong>Toppings:</strong> " . implode(", ", $toppings) . "</p>";
    echo "<p><strong>Quantity:</strong> {$quantity}</p>";
    echo "<p><strong>Unit Price:</strong> ₱" . number_format($price, 2) . "</p>";
    echo "<hr>";
    echo "<p><strong>Total:</strong> ₱" . number_format($total, 2) . "</p>";
    echo "<p style='text-align:center;'>Thank you for your sweet purchase! 🍦</p>";
    echo "</div>";
} else {
    echo "<p>No order data received.</p>";
}
?>