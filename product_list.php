<?php include('header.php'); ?>
<?php include('db/database.php'); ?>
<?php
session_start();
?>


<div class="container">
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM Products";
            $qrun = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($qrun)) {
                echo "<tr>";
                echo "<td>" . $row['ProductID'] . "</td>";
                echo "<td>" . $row['ProductName'] . "</td>";
                echo "<td>$" . $row['Price'] . "</td>";
                echo '<td>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="' . $row['ProductID'] . '">
                    <input type="hidden" name="product_name" value="' . $row['ProductName'] . '">
                    <input type="hidden" name="price" value="' . $row['Price'] . '">
                    <button type="submit" class="btn">Add to Cart <i class="fa-solid fa-cart-plus"></i></button>
                </form>
            </td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div style="display: grid; place-items: center; margin-top: -30px;">
<a href="cart.php" class="btn" style="text-decoration: none; color: white;">View Cart</a>
</div>
<?php include('footer.php'); ?>
