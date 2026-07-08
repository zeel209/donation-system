<?php
include "db.php";

// Fetch data from the database
$sql = "SELECT * FROM contactus";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us Management</title>
  <style>
    /* Keep your existing CSS here */
    .header { margin-bottom: 20px; }
    .header h1 { color: #4dc3c3; font-size: 28px; }
    .breadcrumb { font-size: 14px; color: #777; margin-top: 5px; }
    .table-container { background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 20px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    table th, table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    table th { background: #4dc3c3; color: #fff; }
    table tr:nth-child(even) { background: #f9f9f9; }
    table tr:hover { background: #f0fdfd; }
    .view-btn { background: #17a2b8; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-right: 5px; }
    .view-btn:hover { background: #138496; }
    .delete-btn { background: #dc3545; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
    .delete-btn:hover { background: #c82333; }
  </style>
</head>
<body>

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td>
                <a href="view_contact.php?id=<?php echo $row['id']; ?>">

              <button class="view-btn">View</button>

              <a href="delete_contact.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">
                <button class="delete-btn">Delete</button>
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">No records found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
