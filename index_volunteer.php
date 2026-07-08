<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteers Section</title>
  <style>
    .section-title {
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
      color:rgb(71, 176, 189);
    }

    .section-title span {
      font-weight: bold;
      color:rgb(71, 176, 189);
    }

    .volunteer-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .volunteer-card {
      border: 1px solid #e5e5e5;
      border-radius: 6px;
      overflow: hidden;
      background: #98cbd13b;
      transition: all 0.3s ease;
      text-align: center;
      padding-bottom: 20px;
      color:rgb(76, 78, 103);
    }

    .volunteer-card:hover {
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.35);
      transform: translateY(-5px);
    }

    .volunteer-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .volunteer-card h3 {
      margin: 15px 0 5px;
      font-size: 20px;
      font-weight: bold;
    }

    .volunteer-card p {
      font-size: 14px;
      margin: 5px 0;
      color:rgb(76, 78, 103);
    }

    .volunteer-card p span {
      font-weight: bold;
      color: rgb(76, 78, 103);
    }

    .social-icons {
      margin-top: 10px;
    }

    .social-icons a {
      margin: 0 6px;
      text-decoration: none;
      color: rgb(76, 78, 103);
      font-size: 18px;
      transition: 0.3s;
    }

    .social-icons a:hover {
      color: #000;
    }
  </style>
  <!-- Font Awesome for social icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <h2 class="section-title">Our group of <span>volunteers</span></h2>
  <div class="volunteer-container">

    <!-- Volunteer Card 1 -->
    <div class="volunteer-card">
      <img src="image/volunteer_index.jpg" alt="Jonathan Doe">
      <h3>Jonathan Doe</h3>
      <p><i class="fa fa-phone"></i> <span>Mobile:</span> +49 123 456 789</p>
      <p><i class="fa fa-envelope"></i> <span>E-Mail:</span> johndoe@email.com</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-google-plus"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>

    <!-- Volunteer Card 2 -->
    <div class="volunteer-card">
      <img src="image/volunteer_index2.jpg" alt="George Bell">
      <h3>George Bell</h3>
      <p><i class="fa fa-phone"></i> <span>Mobile:</span> +49 123 456 789</p>
      <p><i class="fa fa-envelope"></i> <span>E-Mail:</span> johndoe@email.com</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-google-plus"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>

    <!-- Volunteer Card 3 -->
    <div class="volunteer-card">
      <img src="image/volunteer_index3.jpg" alt="Laura Fenty">
      <h3>Laura Fenty</h3>
      <p><i class="fa fa-phone"></i> <span>Mobile:</span> +49 123 456 789</p>
      <p><i class="fa fa-envelope"></i> <span>E-Mail:</span> johndoe@email.com</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-google-plus"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>

    <!-- Volunteer Card 4 -->
    <div class="volunteer-card">
      <img src="image/volunteer_index4.jpg" alt="Cameron Poll">
      <h3>Cameron Poll</h3>
      <p><i class="fa fa-phone"></i> <span>Mobile:</span> +49 123 456 789</p>
      <p><i class="fa fa-envelope"></i> <span>E-Mail:</span> johndoe@email.com</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-google-plus"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>
    </div>

  </div>

</body>
</html>
