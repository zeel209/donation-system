<?php
include "db.php"; // database connection

// Handle Add Donor
if (isset($_POST['add_donor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("INSERT INTO donors (name, email, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $email, $amount);
    $stmt->execute();
    header("Location: admin\admin_dashboard.php"); // redirect to dashboard after adding
    exit;
}

// Handle Delete Donor
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php"); // redirect to dashboard after deleting
    exit;
}

// Fetch Donors
$result = $conn->query("SELECT * FROM donors ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donors</title>
  <style>
    .header { margin-bottom: 20px; }
    .header h1 { color: #4dc3c3; font-size: 28px; }
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
    .edit-btn, .delete-btn { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
    .edit-btn { background: #17a2b8; color: #fff; margin-right: 5px; }
    .edit-btn:hover { background: #138496; }
    .delete-btn { background: #dc3545; color: #fff; }
    .delete-btn:hover { background: #c82333; }
    /* Modal */
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; }
    .modal-content { background: #fff; padding: 20px; border-radius: 8px; width: 400px; }
    .close { float: right; font-size: 20px; cursor: pointer; }
    input[type="text"], input[type="email"], input[type="number"] { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; }
    .submit-btn { background: #4dc3c3; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; }
    .submit-btn:hover { background: #3aa6a6; }
  </style>
</head>
<body>

  <div class="header">
    <h1>Manage Donors</h1>
  </div>

  <div class="action-bar">
    <button class="add-btn" onclick="document.getElementById('addModal').style.display='flex'">Add Donor</button>
    <input type="text" placeholder="Search donor..." class="search-input" onkeyup="searchDonor(this.value)">
  </div>

  <div class="table-container">
    <table id="donorTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Amount Donated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['email']); ?></td>
          <td>$<?= number_format($row['amount'],2); ?></td>
          <td>
            <a href="edit_donor.php?id=<?= $row['id']; ?>&redirect=dashboard.php">
              <button class="edit-btn">Edit</button>
            </a>
            <a href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this donor?');">
              <button class="delete-btn">Delete</button>
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Add Donor Modal -->
  <div id="addModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
      <h2>Add Donor</h2>
      <form method="POST">
        <input type="text" name="name" placeholder="Donor Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" step="0.01" name="amount" placeholder="Donation Amount" required>
        <button type="submit" name="add_donor" class="submit-btn">Add Donor</button>
      </form>
    </div>
  </div>

<script>
  // Close modal if clicked outside
  window.onclick = function(event) {
    let modal = document.getElementById('addModal');
    if (event.target == modal) modal.style.display = "none";
  }

  // Search function
  function searchDonor(value) {
    let filter = value.toLowerCase();
    let rows = document.querySelectorAll("#donorTable tbody tr");
    rows.forEach(row => {
      let name = row.cells[1].textContent.toLowerCase();
      let email = row.cells[2].textContent.toLowerCase();
      row.style.display = (name.includes(filter) || email.includes(filter)) ? "" : "none";
    });
  }
</script>

</body>
</html>
