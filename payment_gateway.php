<?php
include("db.php");

// Check Donation ID
if (!isset($_GET['donation_id'])) {
    die("Invalid Request");
}

$donation_id = intval($_GET['donation_id']);

// Fetch Donation Details
$stmt = $conn->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->bind_param("i", $donation_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Donation not found.");
}

$donation = $result->fetch_assoc();

$name = trim($donation['name']);
$email = trim($donation['email']);
$original_amount = floatval($donation['amount']);
$amount = $original_amount * 100; // Razorpay uses paise

// Validation
if (empty($name) || empty($email) || $original_amount <= 0) {
    die("Invalid donation details.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unity Foundation Payment</title>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<style>

body{
    font-family:Arial,Helvetica,sans-serif;
    background:#f4f7fa;
    text-align:center;
    padding-top:80px;
}

.container{
    width:400px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,.15);
}

button{
    background:#43cabf;
    color:#fff;
    border:none;
    padding:14px 35px;
    border-radius:30px;
    cursor:pointer;
    font-size:17px;
}

button:hover{
    background:#36b2a8;
}

</style>

</head>

<body>

<div class="container">

<h2>Unity Foundation</h2>

<p>Hello <b><?php echo htmlspecialchars($name); ?></b></p>

<h3>Donation Amount : ₹<?php echo number_format($original_amount,2); ?></h3>

<button id="payBtn">Pay Now</button>

</div>

<script>

var options = {

    key: "rzp_test_xxxxxxxxxxxxxx", // Replace with your Razorpay Key ID

    amount: "<?php echo $amount; ?>",

    currency: "INR",

    name: "Unity Foundation",

    description: "Donation Payment",

    image: "",

    handler:function(response){

        var form=document.createElement("form");
        form.method="POST";
        form.action="payment_success.php";

        function add(name,value){
            var input=document.createElement("input");
            input.type="hidden";
            input.name=name;
            input.value=value;
            form.appendChild(input);
        }

        add("donation_id","<?php echo $donation_id; ?>");
        add("razorpay_payment_id",response.razorpay_payment_id);

        document.body.appendChild(form);
        form.submit();

    },

    prefill:{
        name:"<?php echo htmlspecialchars($name); ?>",
        email:"<?php echo htmlspecialchars($email); ?>"
    },

    notes:{
        donation_id:"<?php echo $donation_id; ?>"
    },

    theme:{
        color:"#43cabf"
    },

    modal:{
        ondismiss:function(){
            alert("Payment Cancelled.");
        }
    }

};

var rzp = new Razorpay(options);

document.getElementById("payBtn").onclick=function(e){

    rzp.open();

    e.preventDefault();

};

</script>

</body>
</html>