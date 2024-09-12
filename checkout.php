<?php
session_start();
include('db/database.php');
include './header.php';

// If the cart is empty, redirect to product list
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: product_list.php');
    exit();
}

// Process the checkout (save to database)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_amount = 0;
    $items = $_SESSION['cart'];

    // Calculate total amount
    foreach ($items as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    // Insert into Sales table
    $sale_date = date('Y-m-d H:i:s');
    $insert_sale = "INSERT INTO Sales (TotalAmount, SaleDate) VALUES ('$total_amount', '$sale_date')";
    mysqli_query($conn, $insert_sale);
    $sale_id = mysqli_insert_id($conn);  // Get the sale ID of the newly inserted sale

    // Insert sale items into SalesItems table
    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $insert_sale_item = "INSERT INTO SalesItems (SaleID, ProductID, Quantity) VALUES ('$sale_id', '$product_id', '$quantity')";
        mysqli_query($conn, $insert_sale_item);
    }

    // Redirect to PayPal payment page (PayPal button will handle this)
    header('Location: paypal_payment.php?sale_id=' . $sale_id);
    exit();
}
?>

<h2 style="text-align: center; margin-top: 10px;">Checkout</h2>

<?php if (!empty($_SESSION['cart'])): ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_price = 0;
            foreach ($_SESSION['cart'] as $item) {
                $item_total = $item['price'] * $item['quantity'];
                $total_price += $item_total;
                echo "<tr>";
                echo "<td>" . $item['product_name'] . "</td>";
                echo "<td>$" . $item['price'] . "</td>";
                echo "<td>" . $item['quantity'] . "</td>";
                echo "<td>$" . $item_total . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <div style="margin-top: 20px; display: grid; place-items: center;">
        <h3>Total Price: $<?php echo $total_price; ?></h3>
    <form method="POST" action="checkout.php">
        <button type="submit" class="btn" style="text-decoration: none; color: white; ">Confirm and Proceed to Payment</button>
    </form>
    </div>
<?php endif; ?>
