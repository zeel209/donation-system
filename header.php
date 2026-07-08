<?php
session_start();

// prevent session fixation
session_regenerate_id(true);

// store user fingerprint (ip + user agent)
if (!isset($_SESSION['ip'])) {
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
} else {
    if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] ||
        $_SESSION['ua'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unity Foundation</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      text-decoration: none;
      list-style: none;
            font-family: 'Times New Roman', Times, serif;

    }

    body {
      font-family: 'Times New Roman', Times, serif;
      background-color: #fff;
      padding-top: 90px; /* Fixed header niche content overlap na thay */
    }

    /* Header */
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: white;
      padding: 10px 20px;
      display: flex;
      z-index: 1000;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(99, 95, 95, 0.1);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo img {
      width: 58px;
      height: auto;
    }

    .title h5 {
      font-size: 1.8rem;
      font-weight: 600;
      color: rgb(71, 176, 189);
      text-transform: uppercase;
    }

    .title h6 {
      font-size: 1rem;
      font-weight: 600;
      text-transform: uppercase;
      color: rgb(76, 78, 103);
    }

    /* Navbar */
    nav {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    nav ul {
      display: flex;
      gap: 15px;
    }

    nav ul li a {
      color: rgb(76, 78, 103);
      font-size: 1.2rem;
      font-weight: 300;
      transition: color 0.3s;
    }

    nav ul li a:hover {
      color: rgb(71, 176, 189);
    }

    /* Buttons */
    nav button {
      background-color: transparent;
      color: rgb(62, 60, 92);
      font-size: 0.95rem;
      font-weight: 300;
      padding: 3px 12px;
      border: 2px solid #1f2035;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s;
    }

    nav button:hover {
      background-color: rgb(71, 176, 189);
      color: white;
      border-color: rgb(71, 176, 189);
    }

    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
      gap: 5px;
    }

    .hamburger span {
      height: 3px;
      width: 25px;
      background: rgb(76, 78, 103);
      border-radius: 3px;
      transition: 0.3s;
    }

    /* Responsive */
    @media (max-width: 768px) {
      nav ul {
        display: none;
        position: absolute;
        top: 70px;
        right: 20px;
        flex-direction: column;
        background: white;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        border-radius: 10px;
      }

      nav ul.active {
        display: flex;
      }

      .hamburger {
        display: flex;
      }
    }
  </style>

  <script>
    function logoutUser() {
      if(confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
      }
    }

    // Hamburger toggle
    function toggleMenu() {
      document.querySelector("nav ul").classList.toggle("active");
    }
  </script>
</head>
<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Logo">
      <div class="title">
        <h5>Unity Foundation</h5>
        <h6>Non-Profit Organization</h6>
      </div>
    </div>

    <nav>
      <ul>
        <li><a href="index_home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="causes.php">Causes</a></li>
        <li><a href="volunteer.php">Volunteer</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="donate.php">Donate</a></li>
        <?php if (!isset($_SESSION['user_id'])): ?>
          <li><a href="register.php"><button type="button">Register</button></a></li>
        <?php else: ?>
          <li><button type="button" onclick="logoutUser()">Logout</button></li>
        <?php endif; ?>
      </ul>
      <div class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
  </header>
</body>
</html>
