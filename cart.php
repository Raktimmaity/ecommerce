<?php
include './header.php';
session_start();
?>

<h2 style="text-align: center; margin-top: 25px;">Your Cart</h2>

<?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
    <p style="text-align: center; margin-top: 25px;">Your cart is empty.
        <a href="./product_list.php" class="btn" style="text-decoration: none; color: white;">Continue Shop</a>
    </p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
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
                echo '<td>
                        <form method="POST" action="remove_from_cart.php">
                            <input type="hidden" name="product_id" value="' . $item['product_id'] . '">
                            <button type="submit" class="btn">Remove</button>
                        </form>
                    </td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <h3>Total Price: $<?php echo $total_price; ?></h3>
        <div style="margin-top: 20px;">
            <a href="checkout.php" class="btn" style="text-decoration: none; color: white; ">Proceed to Checkout</a>
        </div>
    </div>
<?php endif; ?>