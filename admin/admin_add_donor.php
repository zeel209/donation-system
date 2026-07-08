<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $amount = $_POST['amount'];

    // 🔹 First check if email already exists
    $check = $conn->prepare("SELECT id FROM donors WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Email already exists → Show alert & stop
        echo "<script>alert('This email is already registered as a donor!'); window.location='admin_manage_donors.php';</script>";
        exit;
    }

    // 🔹 Insert new donor
    $stmt = $conn->prepare("INSERT INTO donors (name, email, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $email, $amount);
    $stmt->execute();

    header("Location: admin_manage_donors.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Donor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    input:focus {
      border-color: #47b0bd;
      outline: none;
      box-shadow: 0 0 4px rgba(71,176,189,0.4);
    }
    button {
      background: #47b0bd;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      font-size: 15px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #39939e;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Donor</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="number" step="0.01" name="amount" placeholder="Amount" required>
      <button type="submit">Add Donor</button>
    </form>
  </div>
</body>
</html>
