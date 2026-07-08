<?php
session_set_cookie_params([
    'lifetime' => 0, // Browser close થાય ત્યાં સુધી જ session રહેશે
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=donate.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $amount     = floatval($_POST['amount']);
    $payment_method = $_POST['payment_method'];

    $full_name = $first_name . " " . $last_name;
    $status = "Pending";


    if(empty($first_name) || empty($last_name) || empty($email) || $amount<=0){
        die("Invalid donation details.");
    }


    $check = $conn->prepare("SELECT id FROM donors WHERE email=? LIMIT 1");
    $check->bind_param("s",$email);
    $check->execute();
    $check->bind_result($donation_id);

    $exists = $check->fetch();
    $check->close();


    if($exists){

        $stmt=$conn->prepare(
        "UPDATE donors 
        SET name=?, amount=?, payment_method=?, status=?, transaction_id=NULL 
        WHERE email=?"
        );

        $stmt->bind_param(
            "sdsss",
            $full_name,
            $amount,
            $payment_method,
            $status,
            $email
        );

        $stmt->execute();

    }
    else{

        $stmt=$conn->prepare(
        "INSERT INTO donors
        (name,email,amount,payment_method,status)
        VALUES(?,?,?,?,?)"
        );


        $stmt->bind_param(
            "ssdss",
            $full_name,
            $email,
            $amount,
            $payment_method,
            $status
        );


        $stmt->execute();

        $donation_id=$stmt->insert_id;

    }


    header("Location: pay_via_upi.php?donation_id=".$donation_id);
    exit;

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Donation</title>

<style>


body{

    font-family:'Times New Roman',serif;
    background:#f7f7f7;
    padding:30px;

}


/* MAIN CONTAINER */

.container{

    display:flex;
    gap:40px;
    width:90%;
    max-width:1200px;
    margin:auto;
    align-items:stretch;

}



/* BOTH BOX SAME SIZE */

.donation-image,
.donation-box{

    flex:1;
    width:50%;
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px #ddd;
    box-sizing:border-box;

}



/* LEFT IMAGE */

.donation-image img{

    width:100%;
    height:300px;
    object-fit:cover;
    border-radius:15px;

}


.donation-image h2{

    font-size:28px;
    color:#252b35;
    margin-top:20px;

}


.donation-image p{

    font-size:15px;
    line-height:1.6;
    color:#555;

}



/* RIGHT FORM */

.donation-box{

    display:flex;
    flex-direction:column;

}



.notice{

    background:#fff5df;
    padding:12px;
    border-radius:12px;
    font-size:14px;
    margin-bottom:20px;

}



.amount-box{

    background:#eaf7f4;
    display:inline-block;
    width:max-content;
    padding:12px 25px;
    border-radius:40px;
    font-size:22px;
    font-weight:bold;
    color:#43cabf;

}



.amount-buttons{

    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin:20px 0;

}



.amount-buttons button{

    padding:8px 18px;
    border-radius:25px;
    border:1px solid #ccc;
    background:white;
    cursor:pointer;

}



.amount-buttons button:hover{

    background:#43cabf;
    color:white;

}



.section-title{

    font-weight:bold;
    margin:20px 0 10px;
    border-bottom:1px solid #eee;
    padding-bottom:8px;

}



.payment-methods label{

    font-size:15px;

}



.input-group{

    display:flex;
    gap:15px;
    margin-bottom:15px;

}



.input-group input{

    width:100%;
    padding:12px 15px;
    border-radius:30px;
    border:1px solid #ccc;

}



.donate-btn{

    width:100%;
    padding:12px;
    background:#43cabf;
    color:white;
    border:none;
    border-radius:30px;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;

}



.donate-btn:hover{

    background:#36b2a8;

}




@media(max-width:900px){

.container{

    flex-direction:column;

}


.donation-image,
.donation-box{

    width:100%;

}

}



</style>


</head>


<body>


<div class="container">


<!-- LEFT BOX -->

<div class="donation-image">


<img src="image/donate.png">


<h2>Make a Difference Today</h2>


<p>

When you donate to United Way, you are helping children succeed in school,
helping adults get good paying jobs, increasing access to health services
and creating a better future.

</p>


</div>




<!-- RIGHT BOX -->


<div class="donation-box">


<form method="POST" action="donate.php">


<div class="notice">

⚠️ Demo Mode: Payment will be verified using UPI Transaction ID.

</div>



<div class="amount-box" id="amountBox">

₹100.00

</div>



<div class="amount-buttons">

<button type="button">₹10</button>
<button type="button">₹25</button>
<button type="button">₹50</button>
<button type="button">₹100</button>
<button type="button">₹250</button>
<button type="button">Custom Amount</button>

</div>



<div class="section-title">

Select Payment Method

</div>



<div class="payment-methods">

<label>

<input type="radio"
name="payment_method"
value="Online Payment"
checked>

💳 Online Payment

</label>

</div>



<div class="section-title">

Personal Information

</div>



<div class="input-group">

<input type="text"
name="first_name"
placeholder="First Name"
required>


<input type="text"
name="last_name"
placeholder="Last Name"
required>


</div>



<div class="input-group">

<input type="email"
name="email"
placeholder="Email Address"
required>

</div>



<input type="hidden"
name="amount"
id="amountField"
value="100">



<button class="donate-btn" type="submit">

Donate Now

</button>



</form>


</div>


</div>



<script>


const buttons=document.querySelectorAll(".amount-buttons button");

const box=document.getElementById("amountBox");

const field=document.getElementById("amountField");



buttons.forEach(btn=>{


btn.onclick=function(){


let value=this.innerText.replace("₹","");


if(this.innerText=="Custom Amount"){

value=prompt("Enter Amount");

}



if(value && !isNaN(value)){


box.innerHTML="₹"+parseFloat(value).toFixed(2);

field.value=value;


}


}



});


</script>


</body>
</html>