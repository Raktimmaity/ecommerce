<?php
session_start();
$sale_id = $_GET['sale_id'];

// Clear the session cart after successful payment
unset($_SESSION['cart']);

echo "<h2>Payment Successful!</h2>";
echo "<p>Thank you for your purchase. Your order has been placed successfully.</p>";

// Optionally, update the database to mark the sale as completed.
?>
