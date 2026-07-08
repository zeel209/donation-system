<?php
include "db.php";

// Delete cause
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    $result = $conn->query("SELECT image FROM causes WHERE id = $delete_id");
    if ($row = $result->fetch_assoc()) {
        if (!empty($row['image']) && file_exists(__DIR__ . '/../' . $row['image'])) {
            unlink(__DIR__ . '/../' . $row['image']);
        }
    }

    $conn->query("DELETE FROM causes WHERE id = $delete_id");
    header("Location: admin_manage_causes.php");
    exit;
}

// Fetch all causes
$result = $conn->query("SELECT * FROM causes ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Causes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background: #f4f4f4;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #43cabfff;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }

    a.btn {
      padding: 10px 18px;
      text-decoration: none;
      color: white;
      border-radius: 8px;
      margin-right: 8px;
      font-weight: bold;
      display: inline-block;
      transition: all 0.3s ease;
      font-size: 15px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      text-align: center;
      min-width: 90px; /* Ensures equal width for all buttons */
    }

    a.btn:hover {
      transform: scale(1.05);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }

    a.edit { background: #17a2b8; }
    a.edit:hover { background: #42b86b; }

    a.delete { background: #e74c3c; }
    a.delete:hover { background: #c0392b; }

    img.thumb {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 4px;
    }
  </style>
</head>
<body>

  <h2>Manage Causes</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Target Amount (₹)</th>
        <th>Raised Amount (₹)</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo number_format($row['target_amount']); ?></td>
            <td><?php echo number_format($row['raised_amount']); ?></td>
            <td>
              <?php if (!empty($row['image']) && file_exists($row['image'])): ?>
                <img src="<?= htmlspecialchars($row['image']); ?>" class="thumb">
              <?php else: ?>
                No Image
              <?php endif; ?>
            </td>
            <td>
              <a href="edit_causes.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
              <a href="admin_manage_causes.php?delete_id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this cause?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">No causes found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>
</html>
