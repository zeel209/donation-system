<?php
session_start();
include("db.php");

$error = "";

// Save previous page
if(isset($_GET['redirect'])){
    $_SESSION['redirect'] = $_GET['redirect'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();

    $stmt->store_result();


    if($stmt->num_rows > 0){

        $stmt->bind_result($user_id,$hashed_password);
        $stmt->fetch();


        if(password_verify($password,$hashed_password)){


            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;


            // Redirect user to previous page
            if(isset($_SESSION['redirect'])){

                $page = $_SESSION['redirect'];
                unset($_SESSION['redirect']);

                header("Location: ".$page);
                exit();

            }
            else{

                header("Location:index.php");
                exit();

            }


        }
        else{

            $error="❌ Invalid password!";

        }


    }
    else{

        $error="❌ Invalid username!";

    }


    $stmt->close();

}

?>


<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

body{
font-family:'Times New Roman';
background:#f3f3f3;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.login{
background:#d8eef1;
padding:30px;
border-radius:10px;
width:300px;
box-shadow:0 4px 10px rgb(71,176,189);
}


h2{
text-align:center;
color:rgb(71,176,189);
}


input{
width:100%;
padding:8px;
margin:8px 0;
border:1px solid rgb(71,176,189);
border-radius:5px;
}


button{

width:100%;
padding:8px;
background:rgb(71,176,189);
color:white;
border:none;
border-radius:5px;
cursor:pointer;

}


button:hover{
background:black;
}


.error{
color:red;
text-align:center;
}


</style>

</head>


<body>


<div class="login">

<h2>Login</h2>


<?php

if(isset($_GET['registered']) && $_GET['registered']==1){

echo "<p style='color:green;text-align:center'>
Registration successful! Login now
</p>";

}

?>


<form method="POST">


<label>Username</label>

<input type="text" name="username" required>


<label>Password</label>

<input type="password" name="password" required>


<button type="submit">
Login
</button>


<p>
Don't have account?
<a href="register.php">Create Account</a>
</p>


</form>


<?php

if(!empty($error)){

echo "<p class='error'>$error</p>";

}

?>


</div>


</body>
</html>