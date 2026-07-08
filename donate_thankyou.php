<?php

$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Donor';
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : '0';

$date = date("d F Y");
$time = date("h:i A");

$receipt_id = "UF-" . date("Ymd") . "-" . rand(1000,9999);

?>

<!DOCTYPE html>
<html>
<head>

<title>Donation Receipt</title>

<style>

*{
    box-sizing:border-box;
}


body{

    margin:0;
    background:#eef8f7;
    font-family:'Times New Roman',serif;

    display:flex;
    justify-content:center;
    align-items:center;

    min-height:100vh;

}



.receipt{

    width:420px;

    background:white;

    padding:35px;

    border-radius:18px;

    box-shadow:0 8px 30px rgba(0,0,0,0.15);

    position:relative;

    overflow:hidden;

}



.receipt:before{

    content:"";

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:8px;

    background:#43cabf;

}



/* WATERMARK */

.receipt:after{

    content:"UNITY FOUNDATION";

    position:absolute;

    top:50%;
    left:50%;

    transform:translate(-50%,-50%) rotate(-35deg);

    font-size:55px;

    font-weight:bold;

    color:rgba(67,202,191,0.08);

    white-space:nowrap;

    pointer-events:none;

}



.header{

    text-align:center;

}


.logo{

    font-size:32px;

    font-weight:bold;

    color:#43cabf;

    letter-spacing:2px;

}



.tagline{

    color:#777;

    margin-top:5px;

    font-size:16px;

}



hr{

    border:none;

    height:1px;

    background:#ddd;

    margin:25px 0;

}



.title{

    text-align:center;

    font-size:30px;

    color:#333;

}



.success{

    text-align:center;

    color:#009879;

    font-size:18px;

    margin-top:10px;

}



.receipt-id{

    background:#f4fafa;

    padding:12px;

    border-radius:10px;

    margin-top:25px;

    text-align:center;

    font-size:17px;

}



.info{

    margin-top:25px;

}



.row{

    display:flex;

    justify-content:space-between;

    margin:18px 0;

    font-size:18px;

}



.amount-box{

    margin:25px 0;

    background:#43cabf;

    color:white;

    padding:20px;

    border-radius:15px;

    text-align:center;

}



.amount-box span{

    display:block;

    font-size:30px;

    font-weight:bold;

    margin-top:5px;

}



.status-box{

    text-align:center;

    margin-top:25px;

}



.status{

    display:inline-block;

    margin-top:12px;

    padding:12px 30px;

    background:#d9fff5;

    color:#008f72;

    border-radius:30px;

    font-weight:bold;

    font-size:17px;

}



.footer{

    text-align:center;

    margin-top:35px;

    color:#666;

    font-size:16px;

}



.print{

    width:100%;

    margin-top:25px;

    padding:13px;

    border:none;

    border-radius:30px;

    background:#43cabf;

    color:white;

    font-size:17px;

    cursor:pointer;

}



.print:hover{

    background:#32b2a8;

}



@media print{


body{

    background:white;

}


.receipt{

    box-shadow:none;

    border:1px solid #ddd;

}



.print{

    display:none;

}


}



</style>

</head>


<body>


<div class="receipt">


<div class="header">


<div class="logo">
UNITY FOUNDATION
</div>


<div class="tagline">
Together We Make A Difference
</div>


</div>



<hr>



<div class="title">

Donation Receipt

</div>


<div class="success">

✔ Payment Received Successfully

</div>



<div class="receipt-id">

<b>Receipt No:</b>

<br>

<?php echo $receipt_id; ?>


</div>




<div class="info">


<div class="row">

<b>Donor Name</b>

<span>
<?php echo $name; ?>
</span>

</div>



<div class="row">

<b>Date</b>

<span>
<?php echo $date; ?>
</span>

</div>



<div class="row">

<b>Time</b>

<span>
<?php echo $time; ?>
</span>

</div>



</div>




<div class="amount-box">


Donation Amount


<span>

₹ <?php echo $amount; ?>

</span>


</div>




<div class="status-box">


<b>Payment Status</b>


<br>


<div class="status">

✔ Successful

</div>


</div>




<hr>



<div class="footer">


Thank you for your generous support ❤️


<br><br>


<b>UNITY FOUNDATION</b>


<br>


Serving Humanity With Care


</div>




<button class="print" onclick="window.print()">

🖨 Print Receipt

</button>



</div>



</body>

</html>