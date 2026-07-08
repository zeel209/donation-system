<?php
include"header.php";
?><?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Password match check
    if ($password !== $confirm_password) {
        die("<h3 style='color:red;'>Passwords do not match</h3>");
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        die("<h3 style='color:red;'>This email is already registered. <a href='login.php'>Login here</a></h3>");
    }
    $checkEmail->close();

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (username, email, phonenumber, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $phonenumber, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to login with success message
        header("Location: login.php?registered=1");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family:'Times New Roman', Times, serif;
            background-color:rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: small;
        }
        #username, #email, #phonenumber, #password, #confirmpassword {
            border: 1px solid rgb(71, 176, 189);
        }
        .register {
            background-color: rgb(216, 238, 241);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 9px 10px rgb(71,176,189);
            width: 300px;
        }
        .register h2 {
            text-align: center;
            margin-bottom: 25px;
            color: rgb(71, 176, 189);
        }
        .register label {
            font-weight: bold;
        }
        .register input {
            width: 100%;
            padding: 4px 8px;
            margin: 1px 0 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: small;
        }
        .register button {
            width: 100%;
            padding: 8px;
            background-color: rgb(71, 176, 189);
            box-shadow: 5px 5px 15px rgb(71,176,189), -5px -5px 15px white;
            color:white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .register button:hover {
            background-color: rgb(0, 0, 0);
        }
        .error {
            color: red;
            font-size: 0.85em;
            margin-top: -5px;
            margin-bottom: 10px;
        }
        .password-container {
            position: relative;
        }
        .toggle-icon {
            position: absolute;
            right: 0px;
            top: 30%;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="register">
    <h2>Sign Up</h2>
    <form id="registerForm" action="register.php" method="POST" novalidate>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <div class="error" id="usernameError"></div>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <div class="error" id="emailError"></div>

        <label for="phonenumber">Phone Number</label>
        <input type="text" id="phonenumber" name="phonenumber" required>
        <div class="error" id="phoneError"></div>

        <label for="password">Password</label>
        <div class="password-container">
            <input type="password" id="password" name="password" required>
            <span id="togglePassword" class="toggle-icon">👁</span>
        </div>
        <div class="error" id="passwordError"></div>

        <label for="confirm-password">Confirm Password</label>
        <div class="password-container">
            <input type="password" id="confirm-password" name="confirm_password" required>
            <span id="toggleConfirmPassword" class="toggle-icon">👁</span>
        </div>
        <div class="error" id="confirmPasswordError"></div>

        <button type="submit">Register</button>

        <p style="text-align: center; margin-top: 15px; font-size: small;">
            Already have an account? 
            <a href="login.php" style="color: rgb(71, 176, 189); font-weight: bold;">Login here</a>
        </p>
    </form>
</div>
<script src="C:\xampp\htdocs\unity foundation\script.js"></script>
</body>
</html>
