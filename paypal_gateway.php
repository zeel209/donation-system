<?php
include("db.php");
if (!isset($_GET['donation_id'])) die("Invalid request");
$donation_id = intval($_GET['donation_id']);
$result = $conn->query("SELECT * FROM donors WHERE id=$donation_id");
$donation = $result->fetch_assoc();
$amount = $donation['amount'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>PayPal Checkout</title>
  <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID"></script>
</head>
<body>
  <h2>Complete Your PayPal Payment</h2>
  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: { value: '<?php echo $amount; ?>' }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          // Redirect to success page with transaction ID
          window.location.href = "payment_success.php?donation_id=<?php echo $donation_id; ?>&payment_id=" + details.id;
        });
      }
    }).render('#paypal-button-container');
  </script>
</body>
</html>
