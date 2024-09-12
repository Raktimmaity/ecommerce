<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    // Loop through the cart to find and remove the item
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Re-index the array to prevent gaps
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Redirect to the cart page
    header('Location: cart.php');
    exit();
}
?>
