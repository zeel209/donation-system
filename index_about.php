<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us Section</title>
  <style>

    .about-section {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 10%;
      gap: 40px;
    }

    .about-left {
      flex: 1;
      position: relative;
    }

    .about-left img {
      width: 100%;
      border-radius: 10px;
      display: block;
    }

    .about-right {
      flex: 1;
    }

    .about-right small {
      color: rgb(71, 176, 189);
      letter-spacing: 2px;
      font-weight: bold;
    }

    .about-right h2 {
      font-size: 42px;
      margin: 15px 0;
      color: #3c3c3c;
    }

    .about-right p {
      margin-bottom: 20px;
      color: #666;
    }

    .avatars {
      display: flex;
    }

    .avatars img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid #fff;
      margin-left: -10px;
    }

    .stats span {
      margin-left: 15px;
      font-size: 15px;
      color: #444;
    }

    .btn {
      display: inline-block;
      padding: 12px 25px;
      background: rgb(71, 176, 189);
      color: #fafafaff;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      transition: 0.3s;
    }

    .btn:hover {
      background: rgb(76, 78, 103);
    }

    @media (max-width: 900px) {
      .about-section {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <section class="about-section">
    <!-- Left Image with tags -->
    <div class="about-left">
      <img src="index_about.jpg" alt="Teamwork">
    </div>

    <!-- Right Content -->
    <div class="about-right">
      <small>ABOUT US</small>
      <h2>Building Bridges,<br>Changing Lives</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus velit lectus, in tempus risus vehicula quis. Phasellus mollis congue feugiat. Sed facilisis mauris eget dolor consequat faucibus.</p>
      <a href="learn_more.php" class="btn">Learn More</a>
    </div>
  </section>

</body>
</html>
