<?php
include "db.php"; // Database connection

// Check if ID is provided in URL
if (!isset($_GET['id'])) {
    die("No volunteer ID specified.");
}
$volunteer_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

// Fetch current volunteer data
$stmt = $conn->prepare("SELECT * FROM volunteer WHERE id=?");
$stmt->bind_param("i", $volunteer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Volunteer not found."); // This message shows if the ID does not exist in the database
}
$volunteer = $result->fetch_assoc();

// Handle form submission
if (isset($_POST['update_volunteer'])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];
    $subject = $_POST['subject'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("UPDATE volunteer SET name=?, email=?, contact=?, subject=?, comment=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $contact, $subject, $comment, $volunteer_id);

    if ($stmt->execute()) {
        header("Location: admin_manage_volunteer.php?msg=updated");
        exit();
    } else {
        die("Error updating volunteer: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Volunteer</title>
    <style>
        form { max-width: 500px; margin: 30px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 15px; padding: 8px 16px; background: #3498db; color: white; border: none; border-radius: 4px; cursor:pointer; }
        button:hover { background: #2980b9; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Edit Volunteer</h2>

<form method="POST">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($volunteer['name']); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($volunteer['email']); ?>" required>

    <label>Contact</label>
    <input type="text" name="contact" value="<?php echo htmlspecialchars($volunteer['contact']); ?>" required>

    <label>Subject</label>
    <input type="text" name="subject" value="<?php echo htmlspecialchars($volunteer['subject']); ?>">

    <label>Comment</label>
    <textarea name="comment"><?php echo htmlspecialchars($volunteer['comment']); ?></textarea>

    <button type="submit" name="update_volunteer">Update Volunteer</button>
</form>

</body>
</html>
