<?php
include "db.php"; // connection

// Get donor ID
if (!isset($_GET['id'])) {
    header("Location: admin_add_donor.php");
    exit;
}
$id = intval($_GET['id']);

// Fetch donor data
$stmt = $conn->prepare("SELECT * FROM donors WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$donor = $result->fetch_assoc();

if (!$donor) {
    echo "Donor not found!";
    exit;
}

// Handle update
if (isset($_POST['update_donor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("UPDATE donors SET name=?, email=?, amount=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $email, $amount, $id);
    $stmt->execute();

    header("Location: admin_add_donor.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Donor</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 20px; }
    .form-container { background: #fff; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; }
    h2 { color: #4dc3c3; margin-bottom: 15px; }
    input[type="text"], input[type="email"], input[type="number"] {
      width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px;
    }
    .submit-btn { background: #4dc3c3; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; }
    .submit-btn:hover { background: #3aa6a6; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Donor</h2>
    <form method="POST">
      <input type="text" name="name" value="<?= htmlspecialchars($donor['name']); ?>" required>
      <input type="email" name="email" value="<?= htmlspecialchars($donor['email']); ?>" required>
      <input type="number" step="0.01" name="amount" value="<?= $donor['amount']; ?>" required>
      <button type="submit" name="update_donor" class="submit-btn">Update Donor</button>
    </form>
  </div>
</body>
</html>
