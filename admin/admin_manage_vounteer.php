<?php
include "db.php"; // Database connection

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM volunteer WHERE id=?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: admin_manage_volunteer.php?msg=deleted");
        exit();
    } else {
        die("Error deleting volunteer: " . $stmt->error);
    }
}

// Fetch all volunteers
$result = $conn->query("SELECT * FROM volunteer ORDER BY created_at DESC");
if (!$result) {
    die("Error fetching volunteers: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Volunteers</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #43cabf; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
       .btn-edit, .btn-delete {
    display: inline-block;       /* Make them behave the same */
    width: 80px;                 /* Fixed width for both buttons */
    padding: 6px 0;              /* Vertical padding only */
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 14px;
    cursor: pointer;
}

.btn-edit { background-color: #3498db; }
.btn-edit:hover { background-color: #2980b9; }

.btn-delete { background-color: #e74c3c; }
.btn-delete:hover { background-color: #c0392b; }
 .msg { text-align:center; font-weight:bold; margin-bottom:10px; color:green; }
    </style>
</head>
<body>

<?php if (isset($_GET['msg'])): ?>
    <p class="msg">
        <?php 
            if ($_GET['msg'] == "deleted") echo "Volunteer deleted successfully!";
            if ($_GET['msg'] == "updated") echo "Volunteer updated successfully!";
        ?>
    </p>
<?php endif; ?>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Contact</th>
    <th>Subject</th>
    <th>Comment</th>
    <th>Created At</th>
    <th>Action</th>
  </tr>

  <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['contact']); ?></td>
              <td><?php echo htmlspecialchars($row['subject']); ?></td>
              <td><?php echo htmlspecialchars($row['comment']); ?></td>
              <td><?php echo $row['created_at']; ?></td>
              <td>
                  <a class="btn-edit" href="edit_volunteer.php?id=<?php echo $row['id']; ?>">Edit</a>
                  <a class="btn-delete" href="admin_manage_volunteer.php?delete_id=<?php echo $row['id']; ?>" 
                     onclick="return confirm('Are you sure you want to delete this volunteer?');">Delete</a>
              </td>
          </tr>
      <?php endwhile; ?>
  <?php else: ?>
      <tr><td colspan="8">No volunteers found.</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
