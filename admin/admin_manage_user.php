<!-- manage_users.php -->
<?php
include "db.php";

// Fetch users from database
$sql = "SELECT id, username, email, created_at FROM users ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
  <style>
    /* your previous CSS here */
    .header { margin-bottom: 20px; }
    .header h1 { color: #4dc3c3; font-size: 28px; }
    .breadcrumb { font-size: 14px; color: #777; margin-top: 5px; }
    .action-bar { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .add-btn { background: #4dc3c3; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; transition: 0.3s; }
    .add-btn:hover { background: #3aa6a6; }
    .search-input { padding: 7px 12px; border-radius: 5px; border: 1px solid #ccc; width: 200px; }
    .table-container { background: #fff; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 20px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    table th, table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    table th { background: #4dc3c3; color: #fff; }
    table tr:nth-child(even) { background: #f9f9f9; }
    table tr:hover { background: #f0fdfd; }
    .edit-btn { background: #17a2b8; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-right: 5px; }
    .edit-btn:hover { background: #e0a800; }
    .delete-btn { background: #dc3545; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
    .delete-btn:hover { background: #c82333; }
  </style>
</head>
<body>

  <div class="action-bar">
    <button class="add-btn" onclick="window.location.href='add_user.php'">Add User</button>

    <input type="text" placeholder="Search user..." class="search-input" id="searchInput" onkeyup="searchTable()">
  </div>

  <div class="table-container">
    <table id="userTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Joined Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0) : ?>
          <?php while($row = $result->fetch_assoc()) : ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['created_at']; ?></td>

              <td>
             <button class="edit-btn" onclick="window.location.href='edit_user.php?id=<?php echo $row['id']; ?>'">Edit</button>
<button class="delete-btn" onclick="if(confirm('Are you sure?')) window.location.href='delete_user.php?id=<?php echo $row['id']; ?>'">Delete</button>
 </td>
            </tr>
          <?php endwhile; ?>
        <?php else : ?>
          <tr><td colspan="5">No users found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

<script>
function searchTable() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.getElementById("userTable").getElementsByTagName("tr");
  for (let i = 1; i < rows.length; i++) {
    let cells = rows[i].getElementsByTagName("td");
    let match = false;
    for (let j = 0; j < cells.length - 1; j++) {
      if (cells[j].innerText.toLowerCase().includes(input)) {
        match = true;
        break;
      }
    }
    rows[i].style.display = match ? "" : "none";
  }
}
</script>

</body>
</html>
