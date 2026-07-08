<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: admin_manage_contact_us.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM contactus WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Contact not found.";
    exit;
}

$contact = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Contact Message</title>
<style>
  body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px; }
  .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
  h2 { color: #4dc3c3; }
  p { margin: 10px 0; }
  .back-btn { background: #17a2b8; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; text-decoration: none; }
  .back-btn:hover { background: #138496; }
</style>
</head>
<body>

<div class="container">
  <h2>Contact Details</h2>
  <p><strong>ID:</strong> <?php echo $contact['id']; ?></p>
  <p><strong>Name:</strong> <?php echo htmlspecialchars($contact['name']); ?></p>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?></p>
  <p><strong>Message:</strong><br><?php echo nl2br(htmlspecialchars($contact['message'])); ?></p>
  <a href="admin_manage_contact_us.php" class="back-btn">Back</a>
</div>

</body>
</html>
