<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("INSERT INTO users (username, email, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();

    header("Location: admin_manage_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
<h2>Add User</h2>
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <input type="submit" value="Add User">
</form>
<a href="admin_manage_user.php">Back to Manage Users</a>
</body>
</html>
