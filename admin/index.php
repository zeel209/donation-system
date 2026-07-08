<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // If not logged in, go to login page
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>
<a href="admin_logout.php">Logout</a>
</body>
</html>
<?php
include "db.php";

// Admin count
$sql = "SELECT COUNT(*) as count FROM admins";
$result = $conn->query($sql);
$adminCount = $result->fetch_assoc()['count'];

// Causes count
$sql = "SELECT COUNT(*) as count FROM causes";
$result = $conn->query($sql);
$causesCount = $result->fetch_assoc()['count'];

// Volunteers count
$sql = "SELECT COUNT(*) as count FROM volunteer";
$result = $conn->query($sql);
$volunteersCount = $result->fetch_assoc()['count'];

// Donors count
$sql = "SELECT COUNT(*) as count FROM donors";
$result = $conn->query($sql);
$donorsCount = $result->fetch_assoc()['count'];

// Contact Us count
$sql = "SELECT COUNT(*) as count FROM contactus";
$result = $conn->query($sql);
$contactCount = $result->fetch_assoc()['count'];

// Users count
$sql = "SELECT COUNT(*) as count FROM users";
$result = $conn->query($sql);
$usersCount = $result->fetch_assoc()['count'];
?>
<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // redirect if not logged in
    exit();
}
?>

<p class="count"><?php echo $adminCount; ?></p>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', Times, serif;
    }

    body {
      display: flex;
      background:rgba(92, 147, 153, 0.27);
    }

    /* Sidebar */
    .sidebar {
      width: 240px;
      background:  rgba(255, 255, 255, 1);
      color: rgb(62, 60, 92);
      min-height: 100vh;
      transition: 0.3s;
      padding: 20px;
    }

    .sidebar .logo {
      text-align: center;
      font-size: 20px;
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar ul li {
      margin: 5px 0;
    }

    .sidebar ul li a {
      color: rgb(62, 60, 92);
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      border-radius: 6px;
      transition: 0.3s;
      cursor: pointer;
    }

    .sidebar ul li a span {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sidebar ul li a:hover, .sidebar ul li a.active {
      background:  rgb(71, 176, 189);
    }
    .sidebar.active ~ .main {
  margin-left: 240px; /* shift main content */
  transition: margin-left 0.3s ease;
}

    /* Arrow rotation */
    .arrow {
      transition: transform 0.3s ease;
    }
    .arrow.rotate {
      transform: rotate(90deg);
    }

    /* Submenu */
    .submenu {
      display: none;
      margin-left: 30px;
    }
    .submenu.show {
      display: block;
    }

    /* Main */
    .main {
      flex: 1;
      padding: 20px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Cards */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 20px;
      color: rgb(62, 60, 92);
    }

    .card {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      text-align: center;
    }

    .card h3 {
      margin-bottom: 10px;
    }

    .card .count {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .btn {
      padding: 8px 12px;
      background:  rgb(71, 176, 189);
      color: rgb(62, 60, 92);
      text-decoration: none;
      border-radius: 5px;
    }

    .menu-toggle {
      font-size: 24px;
      cursor: pointer;
      display: none;
    }

    /* Sections */
    .section {
      display: none;
      margin-top: 20px;
    }
    .section.active {
      display: block;
      color:rgb(62, 60, 92);
    }
    .section h2{color:rgb(62, 60, 92);}

    /* Form + Table */
    form {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    form input, form textarea, form button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form button {
      background:  rgb(71, 176, 189);
      color: rgb(62, 60, 92);
      border: none;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    table th {
      background:  rgb(71, 176, 189);
      color: white;
    }
.menu-toggle {
  font-size: 24px;
  cursor: pointer;
  position: fixed;
  top: 8px;
  left: 5px;
  z-index: 200; /* above sidebar */
  color: rgb(62, 60, 92);
  padding: 6px 12px;
  border-radius: 5px;
  display: block; /* visible on desktop & mobile */
}
/* Sidebar collapsed on desktop */
/* Default sidebar (desktop) */
.sidebar {
  width: 240px;
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  background: rgba(255,255,255,1);
  transition: 0.3s;
  z-index: 100;
}

/* Collapsed state */
.sidebar.collapsed {
  left: -240px; /* hide sidebar */
}

/* Main content default (desktop) */
.main {
  margin-left: 240px; /* space for sidebar */
  transition: margin-left 0.3s ease;
}

/* Shifted state when sidebar collapsed */
.main.shifted {
  margin-left: 0;
}

/* Mobile */
@media (max-width: 768px) {
  .sidebar {
    left: -240px; /* hidden by default on mobile */
  }
  .sidebar.active {
    left: 0; /* shown when toggled */
  }
  .main {
    margin-left: 0;
  }
}


@media (max-width: 768px) {
  .menu-toggle {
    /* you can keep it same for mobile */
        display: block;
  }
}


    /* Responsive */
    @media (max-width: 768px) {
  .sidebar {
    position: fixed;
    left: -240px;
    top: 0;
    height: 100%;
    z-index: 100;
  }
  .sidebar.active {
    left: 0;
  }

  .main {
    flex: 1;
    transition: margin-left 0.3s ease;
    margin-left: 0;
  }

  .sidebar.active ~ .main {
    margin-left: 240px; /* shift main content when sidebar opens */
  }

  .menu-toggle {
    display: block;
  }
}

  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2 class="logo">ADMIN PANEL</h2>
    <ul class="menu">
      <li><a data-section="dashboard" class="active"><span><i class="fa fa-home"></i> Dashboard</span></a></li>
      <li>
        <a class="toggle-submenu"><span><i class="fa fa-heart"></i> Causes</span> <i class="fa fa-chevron-right arrow"></i></a>
        <ul class="submenu">
          <li><a data-section="add-cause"><span><i class="fa fa-plus"></i> Add Cause</span></a></li>
          <li><a data-section="manage-cause"><span><i class="fa fa-cogs"></i> Manage Causes</span></a></li>
        </ul>
      </li>
      <li>
        <a class="toggle-submenu"><span><i class="fa fa-users"></i> Volunteers</span> <i class="fa fa-chevron-right arrow"></i></a>
        <ul class="submenu">
          <li><a data-section="add-volunteer"><span><i class="fa fa-user-plus"></i> Add Volunteer</span></a></li>
          <li><a data-section="manage-volunteer"><span><i class="fa fa-cogs"></i> Manage Volunteers</span></a></li>
        </ul>
      </li>
      <li>
        <a class="toggle-submenu"><span><i class="fa fa-hand-holding-dollar"></i> Donors</span> <i class="fa fa-chevron-right arrow"></i></a>
        <ul class="submenu">
          <li><a data-section="add-donor"><span><i class="fa fa-user-plus"></i> Add Donor</span></a></li>
          <li><a data-section="manage-donor"><span><i class="fa fa-cogs"></i> Manage Donors</span></a></li>
        </ul>
      </li>
      <li><a data-section="contact"><span><i class="fa fa-phone"></i> Manage Contact Us</span></a></li>
      <li><a data-section="users"><span><i class="fa fa-user"></i> Manage Users</span></a></li>
      <li><a data-section="admins"><span><i class="fa fa-user-shield"></i> Admins</span></a></li>
<li>
  <form method="post" action="admin_logout.php" style="margin:0;">
    <button type="submit" name="logout">
      <span><i class="fa fa-sign-out-alt"></i> Log Out</span>
    </button>
  </form>
</li>
    </ul>
  </div>
<!-- Sidebar toggle button -->
<span class="menu-toggle">☰</span>

<!-- Main -->
<div class="main">
  
<!-- Dashboard -->
<div id="dashboard" class="section active">
  <div class="cards">
    <div class="card">
  <i class="fa fa-user-shield fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
  <h3>Admin</h3>
  <p class="count"><?php echo $adminCount; ?></p>
  <a href="#" class="btn">See Admins</a>
</div>
<div class="card">
  <i class="fa fa-heart fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
  <h3>Causes</h3>
  <p class="count"><?php echo $causesCount; ?></p>
  <a href="#" class="btn">See Causes</a>
</div>
<!-- Repeat for Volunteers, Donors, Contact, Users -->
<div class="card">
      <i class="fa fa-users fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
      <h3>Volunteers</h3>
      <p class="count"><?php echo $volunteersCount; ?></p>
      <a href="#" class="btn"> See Volunteers</a>
    </div>
    <div class="card">
      <i class="fa fa-hand-holding-dollar fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
      <h3>Donors</h3>
<p class="count"><?php echo $donorsCount; ?></p>
      <a href="#" class="btn">See Donors</a>
    </div>
    <div class="card">
      <i class="fa fa-phone fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
      <h3>Contact Us</h3>
<p class="count"><?php echo $contactCount; ?></p>
      <a href="#" class="btn">See Contact</a>
    </div>
    <div class="card">
      <i class="fa fa-user fa-2x" style="color:rgb(71,176,189); margin-bottom:10px;"></i>
      <h3>Users</h3>
<p class="count"><?php echo $usersCount; ?></p>
      <a href="#" class="btn">See Users</a>
    </div>
  </div>
</div>


    <!-- Add Cause -->
    <div id="add-cause" class="section">
      <?php include "admin_add_causes.php";?>
    </div>

    <!-- Manage Causes -->
    <div id="manage-cause" class="section">
      <?php include "admin_manage_causes.php";?>

    </div>

    <!-- Volunteers -->
    <div id="add-volunteer" class="section">
      <?php include "admin_add_volunteer.php";?>
    </div>

    <div id="manage-volunteer" class="section">
      <h2>Manage Volunteers</h2>
    <?php include "admin_manage_vounteer.php";?>
</div>
    <!-- Donors -->
    <div id="add-donor" class="section">
      <?php include "admin_add_donor.php";?>      
    </div>

    <div id="manage-donor" class="section">
          <?php include "admin_manage_donors.php";?>

    </div>

    <!-- Contact Us -->
    <div id="contact" class="section">
      <?php include "admin_manage_contact_us.php";?>
    </div>

    <!-- Users -->
    <div id="users" class="section">
            <?php include "admin_manage_user.php";?>
    </div>

    <!-- Admins -->
    <div id="admins" class="section">
    <?php include "admin_add_admin.php";?>
    </div>
  </div>

  <!-- JS -->
   <script>
  document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".menu-toggle");
  const sidebar = document.querySelector(".sidebar");
  const main = document.querySelector(".main");

  // Submenu toggles
  const submenuToggles = document.querySelectorAll(".toggle-submenu");

  // Section links
  const links = document.querySelectorAll(".menu li a[data-section]");

  // Page title (optional)
  const title = document.querySelector(".topbar h1") || { textContent: "" };

  // Sidebar toggle
  toggle.addEventListener("click", () => {
    if (window.innerWidth > 768) {
      sidebar.classList.toggle("collapsed");
      main.classList.toggle("shifted");
    } else {
      sidebar.classList.toggle("active");
    }
  });

  // Click outside to hide sidebar on mobile
  document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
      sidebar.classList.remove("active");
    }
  });

  // Submenu expand/collapse
  submenuToggles.forEach(menu => {
    menu.addEventListener("click", () => {
      const submenu = menu.nextElementSibling;
      const arrow = menu.querySelector(".arrow");
      submenu.classList.toggle("show");
      arrow.classList.toggle("rotate");
    });
  });

  // Section switching
  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault(); // prevent default link behavior
      links.forEach(l => l.classList.remove("active"));
      link.classList.add("active");

      const secId = link.getAttribute("data-section");
      if (secId) {
        document.querySelectorAll(".section").forEach(sec => sec.classList.remove("active"));
        document.getElementById(secId).classList.add("active");
        title.textContent = link.textContent.trim();
      }
    });
  });
});

  </script>
</body>
</html>
