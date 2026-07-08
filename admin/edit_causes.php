<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: admin_manage_causes.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM causes WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Cause not found";
    exit;
}

$cause = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $target_amount = $_POST['target_amount'];
    $raised_amount = $_POST['raised_amount'];

    $image = $cause['image']; // keep old image
    if (!empty($_FILES['image']['name'])) {
        if (!empty($cause['image']) && file_exists(__DIR__ . '/../' . $cause['image'])) {
            unlink(__DIR__ . '/../' . $cause['image']);
        }

        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

        $image = 'uploads/' . $image_name; // store relative path
    }

    $stmt = $conn->prepare("UPDATE causes SET name=?, description=?, target_amount=?, raised_amount=?, image=? WHERE id=?");
    $stmt->bind_param("ssddsi", $name, $description, $target_amount, $raised_amount, $image, $id);
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
<title>Edit Cause</title>
<style>
body { font-family: Arial; margin: 40px; background: #f4f4f4; }
form { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; }
label { display: block; margin-top: 10px; }
input[type="text"], input[type="number"], textarea { width: 100%; padding: 8px; margin-top: 4px; border-radius: 4px; border: 1px solid #ccc; }
button { margin-top: 15px; padding: 10px 20px; background:#43cabfff; color:white; border:none; border-radius:5px; cursor:pointer; }
img { margin-top: 10px; max-width: 100px; border-radius: 4px; }
</style>
</head>
<body>

<h2>Edit Cause</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($cause['name']); ?>" required>

    <label>Description</label>
    <textarea name="description" rows="4" required><?= htmlspecialchars($cause['description']); ?></textarea>

    <label>Target Amount (₹)</label>
    <input type="number" name="target_amount" value="<?= $cause['target_amount']; ?>" required>

    <label>Raised Amount (₹)</label>
    <input type="number" name="raised_amount" value="<?= $cause['raised_amount']; ?>" required>

    <label>Image</label>
    <input type="file" name="image">
    <?php if (!empty($cause['image']) && file_exists($cause['image'])): ?>
        <img src="<?= $cause['image']; ?>" alt="Current Image">
    <?php endif; ?>

    <button type="submit">Update Cause</button>
</form>

</body>
</html>
