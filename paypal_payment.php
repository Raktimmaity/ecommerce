<?php
include './header.php';
$sale_id = $_GET['sale_id'];
// Fetch sale information from the database
?>

<h2 style="text-align: center; margin-top: 20px;">Complete Your Payment</h2>

<!-- PayPal Button -->
<div id="paypal-button-container"></div>

<script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=USD"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $total_price; ?>' // Total price from the checkout
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
            window.location.href = "payment_success.php?sale_id=<?php echo $sale_id; ?>";
        });
    }
}).render('#paypal-button-container');
</script>
