<?php
include("db.php");

if (!isset($_GET['donation_id'])) {
    die("Invalid Request");
}

$donation_id = intval($_GET['donation_id']);

$stmt = $conn->prepare("SELECT * FROM donors WHERE id=?");
$stmt->bind_param("i", $donation_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Donation not found.");
}

$donation = $result->fetch_assoc();

$upi_id = "unityfundation@upi";
$upi_link = "upi://pay?pa=".$upi_id."&pn=Unity Foundation&am=".$donation['amount']."&cu=INR";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>UPI Payment</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}

.box{

    width:450px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,.2);

}

input{

width:100%;
padding:12px;
margin-top:15px;

}

button{

padding:12px 25px;
background:#43cabf;
color:white;
border:none;
margin-top:20px;
cursor:pointer;

}

button:hover{

background:#2ba69d;

}

</style>

</head>

<body>

<div class="box">

<h2>Unity Foundation Donation</h2>

<h3>Amount : ₹<?php echo $donation['amount']; ?></h3>

<p><b>UPI ID</b></p>

<h3><?php echo $upi_id; ?></h3>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=<?php echo urlencode($upi_link); ?>">

<p>Scan QR using Google Pay / PhonePe / Paytm</p>

<form action="verify_payment.php" method="POST">

<input type="hidden" name="donation_id" value="<?php echo $donation_id; ?>">

<input
type="text"
name="transaction_id"
placeholder="Enter UPI Transaction ID"
required>

<button type="submit">

Verify Payment

</button>

</form>

</div>

</body>

</html>