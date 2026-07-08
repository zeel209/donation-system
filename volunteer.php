<?php
session_start();
include"header.php";
include("db.php");

$result = $conn->query("SELECT * FROM volunteer");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteers Section</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .hero {
    background: url('image/vol-bg1.jpg') center center / cover no-repeat;
    background-attachment: fixed;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    color: black;
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

  /* Top Section */
  .volunteer-top {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    max-width: 2200px;
    margin: 80px auto;
    padding: 30px 250px;
    column-gap: 100px;
    row-gap: 5px;
  }

  .volunteer-images {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    flex: 1;
  }

  .volunteer-images img {
    width: 180px;
    height: 180px;
    border-radius: 6px;
    object-fit: cover;
    display: block;
    margin: auto;
  }

  .volunteer-text {
    flex: 1;
  }

  .volunteer-text h4 {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
  }

  .volunteer-text h2 {
    font-size: 28px;
    color: #43cabf;
    margin-bottom: 15px;
    line-height: 1.3;
  }

  .volunteer-text p {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
  }

  /* Dark Section */
  .dark-section {
    background: #2a2430;
    color: #fff;
    padding: 80px 20px;
    text-align: left;
  }

  .dark-container {
    max-width: 1200px;
    margin: auto;
  }

  .dark-section h3 {
    font-size: 14px;
    color: #bbb;
    margin-bottom: 10px;
  }

  .dark-section h2 {
    font-size: 28px;
    color: #43cabf;
    margin-bottom: 40px;
    line-height: 1.4;
  }

  .dark-images {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }

  .dark-images img {
    width: 200px;
    height: 200px;
    border-radius: 6px;
    object-fit: cover;
  }

  /* Donate Section */
  .donate-section {
    text-align: center;
    padding: 80px 20px;
  }

  .button {
    background-color: #43cabf;
    color: #fff;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  }

  .button:hover {
    background-color: #36b0a0;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }

  .button:active {
    transform: translateY(0);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .donate-section h4 {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
  }

  .donate-section h2 {
    font-size: 28px;
    color: #43cabf;
    margin-bottom: 20px;
  }

  .donate-section p {
    color: #555;
    max-width: 600px;
    margin: 0 auto 20px;
    font-size: 15px;
    line-height: 1.6;
  }

  .donate-section .contact {
    margin-top: 20px;
    font-size: 14px;
    color: #333;
  }

  .donate-section .contact i {
    color: #43cabf;
    margin-right: 8px;
  }

  /* Only for Mobile (<768px) layout change */
  @media (max-width: 768px) {
    .volunteer-top {
      flex-direction: column;
      padding: 20px;
    }
    .dark-images {
      justify-content: center;
    }
    .dark-images img {
      width: 100%;
      max-width: 300px;
    }
  }
</style>

</head>
<body>
   <div class="hero">
    <h1>Volunteer</h1>
  </div>
<!-- Top Section -->
  <section class="volunteer-top">
    <div class="volunteer-images" id="volunteerImages">
      <img src="image/vol1.jpg" alt="Volunteer 1">
      <img src="image/vol2.jpg" alt="Volunteer 2">
      <img src="image/vol3.jpg" alt="Volunteer 3">
      <img src="image/vol4.jpg" alt="Volunteer 4">
    </div>
    <div class="volunteer-text">
      
      <h2>Meet Those Who Help Others In Need.</h2>
      <p>service to others is the rent you pay for your room here on earth. volunteering is a fundamental part of being a contributing member of society. </p>
    </div>
  </section>

  <!-- Dark Section -->
  <section class="dark-section">
    <div class="dark-container">
      <h3>Volunteers</h3>
      <h2>Our Volunteers Always Going Through The Service</h2>
      <div class="dark-images">
        <img src="image/vol5.jpg" alt="Volunteer 1">
        <img src="image/vol6.jpg" alt="Volunteer 2">
        <img src="image/vol7.jpg" alt="Volunteer 3">
        <img src="image/vol8.jpg" alt="Volunteer 4">
      </div>
    </div>
  </section>

  <!-- Donate Section -->
  <section class="donate-section">
    <h4><button class="button" onclick="window.location.href='<?php 
echo isset($_SESSION['user_id']) ? "volunteer_join_now.php" : "login.php?redirect=volunteer_join_now.php"; 
?>'">
    Join Now
</button></h4>
    <h2>Give A Helping Hand For A Needy People</h2>
    <p>Volunteering is at the very core of being a human.  No one has made it through life without someone else’s help.</p>
    <div class="contact">
      <i class="fas fa-phone"></i> Have any question about donation? Call us now: +123-4567-8910
    </div>
  </section>
  

</body>
</html>
