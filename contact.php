<?php
include "header.php";
include("db.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = htmlspecialchars($_POST['name']);
  $phone   = htmlspecialchars($_POST['phone']);
  $email   = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  // Insert into database
  $stmt = $conn->prepare("INSERT INTO contactus (name, phone, email, subject, message) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $name, $phone, $email, $subject, $message);

  if ($stmt->execute()) {
    // Optional: send email too
    $to = "your-email@example.com"; 
    $headers = "From: $email";
    $body = "Name: $name\nPhone: $phone\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    @mail($to, $subject, $body, $headers);

    echo "<script>alert('Message sent & saved successfully!');</script>";
  } else {
    echo "<script>alert('Failed to save message.');</script>";
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <style>
  /* Hero */
    .hero {
      background: url('image/earth2.jpg') center center / cover no-repeat;
      background-attachment: fixed;
      height: 250px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      color: #fff;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
    }

    .hero h1 {
      position: relative;
      z-index: 1;
      font-size: 3rem;
      color: #ffffff;
      font-weight: bold;
      text-shadow: 0 0 8px rgba(0,0,0,0.7);
    }

    /* Info Grid */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 40px 10%;
    }
    .card {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .card i {
      font-size: 28px;
      margin-bottom: 10px;
      color: rgb(71, 176, 189);
    }
    .card.dark {
      background: rgb(71, 176, 189);
      color: #fff;
    }
    .card.dark i {
      color: #fff;
    }

    /* Map + Form */
    .map-container {
      position: relative;
      width: 100%;
      height: 500px;
      margin-bottom: 60px; /* 🔹 Reduced gap between form and footer */
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
      position: absolute;
      inset: 0;
      z-index: 0;
    }

    /* Centered Contact Form */
    .contact-form {
      position: relative;
      z-index: 1;
      background: linear-gradient(135deg, rgb(71, 176, 189) 0%, rgb(71, 176, 189) 100%);
      color: white;
      padding: 30px;
      border-radius: 12px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .contact-form h3 {
      margin-bottom: 15px;
      text-align: center;
      color: #fff;
    }
    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border: 1px solid rgba(255,255,255,0.4);
      border-radius: 6px;
      font-size: 14px;
      background: rgba(255,255,255,0.2);
      color: white;
    }
    .contact-form input::placeholder,
    .contact-form textarea::placeholder {
      color: rgba(255,255,255,0.8);
    }
    .contact-form button {
      width: 100%;
      padding: 12px;
      background: white;
      color: #43cabf;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }
    .contact-form button:hover {
      background: #f4f4f4;
    }

    /* Mobile */
    @media (max-width: 768px) {
      .hero {
        height: 200px;
      }
      .hero h1 {
        font-size: 2rem;
      }
      .map-container {
        height: auto;
        flex-direction: column;
        margin-bottom: 30px; /* Reduced on mobile too */
      }
      .contact-form {
        position: static;
        margin: 20px auto;
      }
    }
  </style>
</head>
<body>

  <!-- Hero -->
  <div class="hero">
    <h1>Contact Us</h1>
  </div>

  <!-- Info Grid -->
  <div class="info-grid">
    <div class="card">
      <i class="fas fa-map-marker-alt"></i>
      <h3>Our Address</h3>
      <p>4517 Washington Ave. Manchester, Kentucky 39495</p>
    </div>
    <div class="card dark">
      <i class="fas fa-envelope"></i>
      <h3>info@example.com</h3>
      <p>Email us anytime for any kind of inquiry.</p>
    </div>
    <div class="card">
      <i class="fas fa-phone"></i>
      <h3>Hot: (123) 208 666</h3>
      <p>24/7/365 priority Live Chat and ticketing support.</p>
    </div>
  </div>

  <!-- Map + Centered Form -->
  <div class="map-container">
    <!-- Add your Google Map iframe here if needed -->
    <!-- Example: 
    <iframe src="https://www.google.com/maps/embed?..."></iframe> 
    -->

    <div class="contact-form">
      <h3>Get In Touch</h3>
      <form method="post" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="message" placeholder="Write a message..." rows="4" required></textarea>
        <button type="submit">Send a Message</button>
      </form>
    </div>
  </div>

  <?php include 'footer.php';?>
</body>
</html>
