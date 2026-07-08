<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=checkout");
    exit();
}

$cartItems = [];
$total = 0;

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $cartItems[] = $row;
        $total += $row['subtotal'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout | Smart Grocery</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
<h2 class="text-center mb-4">🛒 Checkout</h2>

<form action="place_order.php" method="POST" class="bg-white p-4 rounded shadow-sm">
<h4>🧾 Customer Details</h4>
<input type="text" name="full_name" class="form-control mb-3" placeholder="Full Name" required>
<input type="text" name="phone" class="form-control mb-3" placeholder="Phone Number" required>
<textarea name="address" class="form-control mb-3" placeholder="Delivery Address" required></textarea>

<h4>🛍 Order Summary</h4>
<ul class="list-group mb-3">
<?php if(count($cartItems)>0): ?>
<?php foreach($cartItems as $item): ?>
<li class="list-group-item d-flex justify-content-between">
<?= htmlspecialchars($item['name']) ?> x <?= (int)$item['quantity'] ?>
<span>₹<?= number_format($item['subtotal'],2) ?></span>
</li>
<?php endforeach; ?>
<?php else: ?>
<li class="list-group-item text-danger">Your cart is empty!</li>
<?php endif; ?>
<li class="list-group-item d-flex justify-content-between">
<strong>Total</strong> <strong>₹<?= number_format($total,2) ?></strong>
</li>
</ul>

<input type="hidden" name="total" value="<?= $total ?>">

<!-- Added hidden inputs for all cart products -->
<?php foreach($cartItems as $index => $item): ?>
    <input type="hidden" name="products[<?= $index ?>][product_id]" value="<?= (int)$item['product_id'] ?>">
    <input type="hidden" name="products[<?= $index ?>][name]" value="<?= htmlspecialchars($item['name']) ?>">
    <input type="hidden" name="products[<?= $index ?>][price]" value="<?= $item['price'] ?>">
    <input type="hidden" name="products[<?= $index ?>][quantity]" value="<?= (int)$item['quantity'] ?>">
    <input type="hidden" name="products[<?= $index ?>][subtotal]" value="<?= $item['subtotal'] ?>">
<?php endforeach; ?>

<h4>Payment Method</h4>
<label><input type="radio" name="payment_method" value="COD" checked> Cash On Delivery</label>
<label class="ms-3"><input type="radio" name="payment_method" value="UPI"> UPI (GPay / PhonePe)</label>
<div id="upi-box" style="display:none; margin-top:10px;">
<label>UPI VPA: <input type="text" name="upi_vpa" placeholder="example@upi"></label>
<label>Provider: 
<select name="upi_provider">
<option value="GPay">GPay</option>
<option value="PhonePe">PhonePe</option>
<option value="Other">Other</option>
</select>
</label>
</div>
<br><br>
<button type="submit" class="btn btn-success w-100">Place Order / Pay</button>
</form>
</div>

<script>
document.querySelectorAll('input[name="payment_method"]').forEach(r=>{
    r.addEventListener('change', function(){
        document.getElementById('upi-box').style.display = (this.value==='UPI')?'block':'none';
    });
});
</script>
</body>
</html>