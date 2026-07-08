<?php
// Database configuration
include "db.php";

// Initialize message
$message = "";

// Handle Add Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_admin'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admins (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } else {
            $message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}

// Handle Edit Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_admin'])) {
    $id = (int)$_POST['id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE admins SET username=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF'] . "?updated=1");
    exit;
}

// Handle Delete Admin
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM admins WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch admins
$admins = $conn->query("SELECT * FROM admins");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admins</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px;}
.action-bar { display: flex; justify-content: space-between; margin-bottom: 15px; }
.add-btn { background: #4dc3c3; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; }
.search-input { padding: 7px 12px; border-radius: 5px; border: 1px solid #ccc; width: 200px; }
.table-container { background: #fff; border-radius: 8px; padding: 20px; overflow-x: auto; margin-top: 15px;}
table { width: 100%; border-collapse: collapse; }
table th, table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
table th { background: #4dc3c3; color: #fff; }
table tr:nth-child(even) { background: #f9f9f9; }
table tr:hover { background: #f0fdfd; }
.edit-btn, .delete-btn {
    display: inline-block;   /* ensure both behave the same */
    padding: 8px 15px;       /* same padding */
    border-radius: 5px;      /* same border radius */
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 14px;         /* same font size */
    text-align: center;      /* center text */
    text-decoration: none;   /* remove underline for <a> */
    transition: 0.3s;
}

.edit-btn {
    background: #4dc3c3;   /* teal color */
}

.edit-btn:hover {
    background: #42a1a1;   /* darker teal on hover */
}

.delete-btn {
    background: #dc3545;   /* red color */
}

.delete-btn:hover {
    background: #c82333;   /* darker red on hover */
}
.form-popup { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2); padding: 20px; z-index: 10; width: 350px;}
.form-popup input, .form-popup select { width: 100%; padding: 10px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; }
/* Add / Edit button */
.form-popup button[type="submit"] {
    background: #4dc3c3; /* teal color */
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}
.form-popup button[type="submit"]:hover {
    background: #42a1a1; /* darker teal on hover */
}

/* Cancel button */
.form-popup .close-btn {
    background: #dc3545; /* red color */
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}
.form-popup .close-btn:hover {
    background: #c82333; /* darker red on hover */
}
.message { text-align: center; margin-bottom: 10px; color: green; }

</style>
</head>
<body>

<div class="action-bar">
  <button class="add-btn" onclick="openAddForm()">Add Admin</button>
  <input type="text" placeholder="Search admin..." class="search-input" onkeyup="searchTable(this.value)">
</div>

<?php if($message != ""): ?>
  <div class="message"><?php echo $message; ?></div>
<?php endif; ?>
<?php if(isset($_GET['success'])): ?>
  <div class="message">Admin added successfully!</div>
<?php endif; ?>
<?php if(isset($_GET['updated'])): ?>
  <div class="message">Admin updated successfully!</div>
<?php endif; ?>

<div class="table-container">
  <table id="adminTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $admins->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['role']); ?></td>
        <td>
          <button class="edit-btn" onclick='openEditForm(<?php echo json_encode($row); ?>)'>Edit</button>
          <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- Add Admin Form -->
<div class="form-popup" id="adminFormPopup">
  <form method="POST" id="adminForm">
    <h3 id="formTitle">Add Admin</h3>
    <input type="hidden" name="id" id="adminId">
    <input type="text" name="username" placeholder="Username" id="username" required>
    <input type="email" name="email" placeholder="Email" id="email" required>
    <input type="password" name="password" placeholder="Password" id="password">
    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password">
    <select name="role" id="role" required>
      <option value="">Select Role</option>
      <option value="Owner">Owner</option>
      <option value="Moderator">Moderator</option>
    </select>
    <button type="submit" name="add_admin" id="submitBtn">Add Admin</button>
    <button type="button" class="close-btn" onclick="closeForm()">Cancel</button>
  </form>
</div>

<script>
function openAddForm() {
  document.getElementById('formTitle').innerText = "Add Admin";
  document.getElementById('submitBtn').name = "add_admin";
  document.getElementById('username').value = "";
  document.getElementById('email').value = "";
  document.getElementById('password').value = "";
  document.getElementById('confirm_password').value = "";
  document.getElementById('role').value = "";
  document.getElementById('adminFormPopup').style.display = 'block';
}

function openEditForm(data) {
  document.getElementById('formTitle').innerText = "Edit Admin";
  document.getElementById('submitBtn').name = "edit_admin";
  document.getElementById('adminId').value = data.id;
  document.getElementById('username').value = data.username;
  document.getElementById('email').value = data.email;
  document.getElementById('role').value = data.role;
  // Hide password fields on edit
  document.getElementById('password').style.display = 'none';
  document.getElementById('confirm_password').style.display = 'none';
  document.getElementById('adminFormPopup').style.display = 'block';
}

function closeForm() {
  document.getElementById('adminFormPopup').style.display = 'none';
}

function searchTable(value){
  const filter = value.toLowerCase();
  const rows = document.querySelectorAll('#adminTable tbody tr');
  rows.forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
  });
}
</script>

</body>
</html>
