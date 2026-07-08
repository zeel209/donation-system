<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("db.php");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT name FROM volunteer WHERE user_id=? LIMIT 1");
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){
    die("You have not registered as a volunteer.");
}

$data = $result->fetch_assoc();

$username = $data['name'];

$date = date("d F Y");

$certificate_id = "UF-".date("Y")."-".str_pad($user_id,5,"0",STR_PAD_LEFT);

?>


<!DOCTYPE html>
<html>
<head>

<title>Volunteer Certificate</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    background:#eeeeee;
    font-family:Georgia,serif;
}


/* Certificate */

.certificate{

    width:1120px;
    height:790px;

    margin:30px auto;

    background:white;

    position:relative;

    border:15px solid #38c7bd;

    padding:50px;

    text-align:center;

    box-shadow:0 0 30px #aaa;

}


/* Inner Border */

.certificate:before{

    content:"";

    position:absolute;

    top:20px;
    left:20px;
    right:20px;
    bottom:20px;

    border:3px solid #d4af37;

}


/* Corners */

.corner{

position:absolute;

width:70px;
height:70px;

border-color:#d4af37;

}


.tl{
top:30px;
left:30px;
border-left:5px solid;
border-top:5px solid;
}

.tr{
top:30px;
right:30px;
border-right:5px solid;
border-top:5px solid;
}

.bl{
bottom:30px;
left:30px;
border-left:5px solid;
border-bottom:5px solid;
}

.br{
bottom:30px;
right:30px;
border-right:5px solid;
border-bottom:5px solid;
}



/* Logo */

.logo{

width:90px;

margin-top:5px;

}



/* Heading */

h1{

font-size:52px;

color:#38bfb7;

margin:15px 0;

letter-spacing:1px;

}



h2{

font-size:28px;

color:#555;

margin-bottom:35px;

}



.subtitle{

font-size:20px;

color:#333;

}



/* Name */

.name{

display:inline-block;

font-size:45px;

font-weight:bold;

color:#222;

padding:10px 50px;

margin:25px;

border-bottom:3px solid #38c7bd;

}



.content{

font-size:22px;

line-height:35px;

}



/* Footer */


.footer{

position:absolute;

bottom:45px;

left:80px;

right:80px;

display:flex;

justify-content:space-between;

}



.box{

width:230px;

font-size:17px;

}


.line{

margin-top:10px;

border-top:2px solid #222;

margin-bottom:8px;

}



/* Button */

button{

margin-top:20px;

padding:12px 35px;

border:none;

border-radius:30px;

background:#38c7bd;

color:white;

font-size:18px;

cursor:pointer;

}


@media print{

body{

background:white;

}


button{

display:none;

}


.certificate{

margin:0;

box-shadow:none;

}

}



</style>

</head>


<body>


<div class="certificate">


<div class="corner tl"></div>
<div class="corner tr"></div>
<div class="corner bl"></div>
<div class="corner br"></div>



<img src="logo.png" class="logo">


<h1>
Certificate of Appreciation
</h1>


<h2>
Unity Foundation
</h2>



<div class="subtitle">
This Certificate is Proudly Presented To
</div>



<div class="name">

<?php echo htmlspecialchars($username); ?>

</div>



<div class="content">

For outstanding dedication and valuable contribution as

<br>

<b>Volunteer</b>

<br>
Your service and commitment have made a meaningful impact<br>
on our community.

</div>


<br>
<div class="footer">


<div class="box">

Certificate ID

<div class="line"></div>

<b>
<?php echo $certificate_id; ?>
</b>

</div>



<div class="box">
Date

<div class="line"></div>

<b>
<?php echo $date; ?>
</b>

</div>



<div class="box">

Director

<div class="line"></div>

<b>
Unity Foundation
</b>

</div>


</div>


</div>



<center>

<button onclick="window.print()">
🖨 Print / Save PDF
</button>

</center>



</body>
</html>