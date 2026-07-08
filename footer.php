<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Responsive Footer Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Important for responsiveness -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;    }

    /* Subscribe Box with Image Background */
    .subscribe-box {
      margin: 20px auto;
      font-family: Arial, sans-serif;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                  url("image/child-bg.jpg") center/cover no-repeat;
      color: white;
      padding: 60px 40px;
      border-radius: 0px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 15px;
      max-width: 1500px;
      flex-wrap: wrap;
      text-align: center;
    }

    .subscribe-box strong {
      font-size: 18px;
      font-weight: bold;
      color:  rgb(71, 176, 189); /* reddish bold */
      white-space: nowrap;
    }

    .subscribe-box input {
  flex: 1;
  min-width: 200px;
  max-width: 300px;  /* 👈 limit length */
  padding: 12px 15px;
  border: none;
  outline: none;
  font-size: 14px;
  border-radius: 5px;
  color: rgb(76, 78, 103);
}


    .subscribe-box button {
      background: white;
      color: #708384ff;
      border: none;
      padding: 12px 20px;
      border-radius: 20px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .subscribe-box button:hover {
      background: #f0f0f0;
    }

    /* Top Contact Strip */
    .footer-top {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      background: #434849ff;
      padding: 20px 10px;
      color: #fff;
    }
    .footer-top .box {
      display: flex;
      align-items: center;
      gap: 15px;
      background: rgb(71, 176, 189);
      padding: 15px 25px;
      border-radius: 15px;
      min-width: 250px;
    }
    .footer-top .box i {
      font-size: 22px;
      border: 2px solid #fff;
      padding: 8px;
      border-radius: 50%;
    }

    /* Main Footer */
    .footer {
      background: rgb(71, 176, 189);
      color: #fff;
      padding: 50px 40px;
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 40px;
      flex:1;
    }
.footer-logo-about .logo-text {
  display: flex;
  align-items: center;
  gap: 10px; /* space between logo and text */
}

.footer-logo-about .logo-text img {
  width: 50px; /* adjust size */
  height: auto;
}

.footer-logo-about .logo-text span {
  font-size: 20px;
  font-weight: bold;
  color: #fff;
}

    .footer h3 {
      margin-bottom: 15px;
      font-size: 20px;
    }
    .footer h3 img {
      width: 45px;
    }

    .footer p {
      line-height: 1.6;
      font-size: 14px;
    }

    .footer .social-icons {
      margin-top: 15px;
    }

    .footer .social-icons a {
      display: inline-block;
      margin-right: 10px;
      color: #fff;
      font-size: 18px;
      border: 1px solid #fff;
      padding: 6px 10px;
      border-radius: 5px;
      text-decoration: none;
    }

    .footer ul {
      list-style: none;
      padding: 0;
    }

    .footer ul li {
      margin-bottom: 8px;
    }

    .footer ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 14px;
    }

    .footer .recent-post {
      display: flex;
      gap: 12px;
      margin-bottom: 15px;
    }
    .footer .recent-post img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
    .footer .recent-post span {
      display: block;
      font-size: 12px;
      color: #dbe4e4;
      margin-bottom: 4px;
    }

    /* Bottom Copyright */
    .footer-bottom {
  width: 100%;
  text-align: center;
  background: rgb(62, 60, 92);
  color: #fff;
  padding: 15px 0px;
  font-size: 14px;
  clear: both;
}

    /* Responsive CSS */
    @media (max-width: 992px) {
      .footer {
        grid-template-columns: 1fr 1fr;
        padding: 40px 20px;
      }
    }

    @media (max-width: 768px) {
      .subscribe-box {
        padding: 40px 20px;
        flex-direction: column;
      }
      .footer {
        grid-template-columns: 1fr;
        text-align: center;
      }
      .footer .recent-post {
        justify-content: center;
      }
      .footer .social-icons {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .footer-top .box {
        flex-direction: column;
        text-align: center;
      }
      .subscribe-box strong {
        font-size: 16px;
      }
      .subscribe-box input {
        width: 100%;
      }
      .subscribe-box button {
        width: 100%;
      }
    }
    @media (max-width: 480px) {
  .footer-bottom {
    font-size: 12px;
    padding: 12px 5px;
        }
    }

  </style>
</head>
<body>
  <!-- Subscribe Section -->
  <div class="subscribe-box">
    <strong>Subscribe to our website</strong>
    <input type="email" placeholder="Enter your email">
    <button>Subscribe</button>
  </div>

  <!-- Top Contact Strip -->
  <div class="footer-top">
    <div class="box">
      <i class="fa-solid fa-location-dot"></i>
      <div>
        <strong>Address</strong><br>
        1234 abc road ,xyz
      </div>
    </div>
    <div class="box">
      <i class="fa-solid fa-envelope"></i>
      <div>
        <strong>Send Email</strong><br>
        contact@abc.com
      </div>
    </div>
    <div class="box">
      <i class="fa-solid fa-phone"></i>
      <div>
        <strong>Call Emergency</strong><br>
        +(91) 01234 56789
      </div>
    </div>
  </div>

  <!-- Main Footer -->
  <div class="footer">
    <div class="footer-logo-about">
  <div class="logo-text">
    <img src="logo.png" alt="Logo">
    <span>Unity Foundation</span>
  </div>
  <p>Unity is strength... when there is teamwork and collaboration, wonderful things can be achieved.</p>
  <div class="social-icons">
    <a href="#"><i class="fa-brands fa-facebook"></i></a>
    <a href="#"><i class="fa-brands fa-twitter"></i></a>
    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
    <a href="#"><i class="fa-brands fa-instagram"></i></a>
  </div>
</div>

    <!-- Quick Links -->
    <div>
      <h3>Quick Link</h3>
      <ul>
        <li><a href="service.php">Services</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="donate.php">Donate</a></li>
        <li><a href="causes.php">Causes</a></li>
      </ul>
    </div>

    <!-- Recent Posts -->
    <div>
      <h3>Recent Posts</h3>
      <div class="recent-post">
        <img src="image/earth1.jpg" alt="">
        <div>
          <span><i class="fa-regular fa-calendar"></i> 20 Sept 2025</span>
          <p>This post is about volunteers activity.</p>
        </div>
      </div>
      <div class="recent-post">
        <img src="image/helping.jpg" alt="">
        <div>
          <span><i class="fa-regular fa-calendar"></i> 24 Sept 2025</span>
          <p>This post is about child welfare for food distribution.</p>
        </div>
      </div>
    </div>

    <!-- Contact Us -->
    <div>
      <h3>Contact Us</h3>
      <p><i class="fa-solid fa-envelope"></i> contact@example.com</p>
      <p><i class="fa-solid fa-phone"></i> +208-6666-0112</p>
    </div>
  </div>

  <!-- Bottom -->
  <div class="footer-bottom">
    © 2025 Copyrights by Unity Foundation. All Rights Reserved.
  </div>
</body>
</html>
