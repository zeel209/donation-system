 <?php
include"header.php";
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Hero Section */
    .hero {
  background: url('image/earth2.jpg') center center / cover no-repeat;
  background-attachment: fixed; /* image stays fixed */
  height: 300px; /* adjust height as needed */
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  color: #060606ff;
}
.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.5); /* overlay effect */
}
.hero h1 {
  position: relative;
  color: #ffffffff;
  font-size: 3rem;
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
      font-size: 30px;
      margin-bottom: 10px;
      color:  #43cabf;
    }
    .card.dark {
      background:  #43cabf;
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
  margin-bottom: 200px;  /* 👈 Extra space niche */
}

    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
    .contact-form {
      position: absolute;
      bottom: -100px;
      right: 200px;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      width: 350px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    .contact-form h3 {
      margin-bottom: 15px;
    }
    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    .contact-form button {
      width: 100%;
      padding: 12px;
      background:  #43cabf;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .contact-form button:hover {
      background:  #43cabf;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
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

  <!-- Map + Form -->
  <div class="map-container">
   <iframe
  width="100%"
  height="100%"
  style="border:0;"
  loading="lazy"
  allowfullscreen
  referrerpolicy="no-referrer-when-downgrade"
  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3723.123456789012!2d70.7783333!3d22.2902778!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c123456789ab%3A0xabcdefabcdef1234!2sKotecha%20Chowk%2C%20Kalavad%20Road%2C%20Rajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1695159999999!5m2!1sen!2sin">
</iframe>

    <div class="contact-form">
      <h3>Get In Touch</h3>
      <form method="post" action="contact.php">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="message" placeholder="Write a message..." rows="4" required></textarea>
        <button type="submit">Send a Message</button>
      </form>
    </div>
  </div>

<?php
// Simple backend handler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $phone = htmlspecialchars($_POST['phone']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  // Send mail (configure properly on server)
  $to = "your-email@example.com"; 
  $headers = "From: $email";
  $body = "Name: $name\nPhone: $phone\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

  if (mail($to, $subject, $body, $headers)) {
    echo "<script>alert('Message sent successfully!');</script>";
  } else {
    echo "<script>alert('Message failed. Please try again.');</script>";
  }
}
?>

</body>
</html>
