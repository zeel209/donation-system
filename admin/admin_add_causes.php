<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['cause_name'];
    $description = $_POST['description'];
    $target_amount = $_POST['target_amount'];
    $raised_amount = $_POST['raised_amount'];

    $image = '';
    if (isset($_FILES['cause_image']) && $_FILES['cause_image']['error'] == 0) {
        $upload_dir = __DIR__ . '/../uploads/'; // store in root /uploads
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['cause_image']['type'], $allowed_types)) {
            $image_name = uniqid() . '-' . basename($_FILES['cause_image']['name']);
            $image_path = $upload_dir . $image_name;
            move_uploaded_file($_FILES['cause_image']['tmp_name'], $image_path);

            $image = 'uploads/' . $image_name; // path to store in DB
        }
    }

    $stmt = $conn->prepare("INSERT INTO causes (name, description, target_amount, raised_amount, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdds", $name, $description, $target_amount, $raised_amount, $image);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_manage_causes.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Cause</title>
<style>
body { font-family: Arial; background: #f4f7f8; display:flex; justify-content:center; align-items:center; min-height:100vh; }
.form-container { background: #fff; padding: 30px 40px; border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,0.1); width:100%; max-width:600px; }
.form-container h2 { text-align:center; margin-bottom:25px; color:#003366; }
.form-group { margin-bottom:15px; display:flex; flex-direction:column; }
.form-group label { margin-bottom:5px; font-weight:600; color:#555; }
.form-group input, .form-group textarea { padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:16px; transition:0.3s; }
.form-group input:focus, .form-group textarea:focus { border-color:#43cabfff; outline:none; }
textarea { resize: vertical; min-height:100px; }
.btn-submit { width:100%; background-color:#43cabfff; color:#fff; font-weight:600; border:none; padding:12px; border-radius:6px; cursor:pointer; font-size:16px; transition:0.3s; }
.btn-submit:hover { background-color:#36b0b0; }
@media(max-width:480px) { .form-container { padding:20px; } }
</style>
</head>
<body>

<div class="form-container">
  <h2>Add a New Cause</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="cause_name">Cause Name</label>
      <input type="text" id="cause_name" name="cause_name" placeholder="Enter Cause Name" required>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" placeholder="Enter Description" required></textarea>
    </div>

    <div class="form-group">
      <label for="target_amount">Target Amount</label>
      <input type="number" id="target_amount" name="target_amount" placeholder="Enter Target Amount" required>
    </div>

    <div class="form-group">
      <label for="raised_amount">Raised Amount</label>
      <input type="number" id="raised_amount" name="raised_amount" placeholder="Enter Raised Amount" required>
    </div>

    <div class="form-group">
      <label for="cause_image">Upload Image</label>
      <input type="file" id="cause_image" name="cause_image">
    </div>

    <button type="submit" class="btn-submit">Add Cause</button>
  </form>
</div>

</body>
</html>
