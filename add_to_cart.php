<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $item_found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += 1; // Increment quantity if found
            $item_found = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$item_found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    // Redirect back to the product list
    header("Location: product_list.php");
    exit();
}
?>
