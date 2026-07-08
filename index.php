<?php
  include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', Times, serif;
    }

    body {
      background: #fff;
      color: #333;
    }

    /* Hero Section */
    .hero {
      position: relative;
      min-height: 100vh;  /* fix for different screens */
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: left;
      padding: 0 5%;
      height: 100vh;
      background: url('hero1.jpg') no-repeat center center/cover;
      transition: background 0.1s ease-in-out; /* smooth transition */
}
    .hero .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
    }

    .hero-content {
      position: relative;
      color: #fff;
      max-width: 600px;
    }

    .hero-content h1 {
      font-size:30px;
      font-weight: bold;
      line-height: 1.2;
      margin-bottom: 20px;
    }

    .hero-content p {
      margin-bottom: 30px;
      font-size: clamp(1rem, 1.0vw, 1.2rem);

    }

    .buttons .btn {
      display: inline-block;
      padding: 0.8em 1.5em;
      margin-right: 10px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
      font-size: clamp(0.9rem, 2vw, 1rem);
    }

    .btn.donate {
      background: rgb(71, 176, 189);
      color: #fff;
    }

    .btn.watch {
      background: #fff;
      color: rgb(71, 176, 189);
    }

    .btn:hover {
      opacity: 0.8;
      color: white;
    }

    /* Slider Arrows */
    .arrows {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 20px;
    }

    .arrow {
      font-size: 2rem;
      color: #fff;
      cursor: pointer;
      user-select: none;
    }

   /* Features Section */
.features {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding: 0 10%;
  margin-top: -80px;
  position: relative;
 z-index: 10;
}.features {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding: 50px 10%;
  position: relative;
  z-index: 10;
}
.feature {
  background: #98cbd1ca;
  flex: 1;
  text-align: center;
  border-radius: 10px;
  padding: 40px 20px 20px; /* extra top padding for icon */
  position: relative;
  border: 1px solid rgb(71, 176, 189); /* border */
 box-shadow: 3px 6px 6px rgba(71, 175, 189, 0.71);
  transition: transform 0.3s, box-shadow 0.3s;
}

.feature:hover {
  transform: translateY(-8px);
  border-color: #333; /* border changes on hover */
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25); /* deeper shadow on hover */
}


/* Circle Icon */
.icon-wrap {
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(250, 247, 247, 1);
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
    border: 1px solid rgb(71, 176, 189); /* border */

  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.icon {
  font-size: 1.8rem;
  color: #fff;
}

.feature h3 {
  margin-top: 20px;
  margin-bottom: 10px;
  font-size: 1.0rem;
  font-weight: bold;
  color: rgba(76, 78, 103, 0.79);
}

.feature h3 span {
  margin-top: 20px;
  margin-bottom: 10px;
  font-size: 1.4rem;
  font-weight: bold;
  color: rgb(76, 78, 103);
}
.icon i {
  font-size: 25px;
  color: #47b0bd; /* change color */
}
.feature:nth-child(1) .icon i { color: #e67e22; } /* orange */
.feature:nth-child(2) .icon i { color: #2980b9; } /* blue */
.feature:nth-child(3) .icon i { color: #27ae60; } /* green */
.feature:nth-child(4) .icon i { color: #f1c40f; } /* yellow */


.feature p {
  font-size: 0.9rem;
  color: rgb(76, 78, 103);}
 /* Responsive Design */
    @media (max-width: 768px) {
      .hero {
        padding: 0 20px;
        text-align: center;
      }

      .hero-content {
        max-width: 100%;
      }

      .features {
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero">
    <div class="overlay"></div>
    <div class="hero-content">
      <h1>"Always Give Without Remembering<br>And Always Receive Without Forgetting"</h1>
      <p>Charity Is The Root Of All Good Works.</p>
      <div class="buttons">
        <a href="donate.php" class="btn donate">Donate Now</a>
        <a href="about.php" class="btn watch">▶ Watch About</a>
      </div>
    </div>

    <!-- Slider Arrows -->
    <div class="arrows">
      <span class="arrow left" onclick="prevSlide()">&#10094;</span>
      <span class="arrow right" onclick="nextSlide()">&#10095;</span>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features"> 
  <div class="feature">
    <div class="icon-wrap">
      <div class="icon"><i class="fa-solid fa-heart"></i></div>
    </div>
    <h3>Help the <span>Child</span></h3>
    <p>We connect nonprofits, donors, and companies in need.</p>
  </div>

  <div class="feature">
    <div class="icon-wrap">
      <div class="icon"><i class="fa-solid fa-users"></i></div>
    </div>
    <h3>Join our <span>Mission</span></h3>
    <p>We connect nonprofits, donors, and companies in need.</p>
  </div>

  <div class="feature">
    <div class="icon-wrap">
      <div class="icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
    </div>
    <h3>Make a <span>Donation</span></h3>
    <p>We connect nonprofits, donors, and companies in need.</p>
  </div>

  <div class="feature">
    <div class="icon-wrap">
      <div class="icon"><i class="fa-solid fa-graduation-cap"></i></div>
    </div>
    <h3>Support <span>Education</span></h3>
    <p>We connect nonprofits, donors, and companies in need.</p>
  </div>
</section>


  <script src="script.js"></script>

  <?php
  include "service.php";
  include "index_about.php";
  include "index_volunteer.php";
  include "index_new.php";
  include "index_events.php";
  include "index_contact.php";
  include "index_questions.php";
  include "footer.php";
  ?>
</body>
</html>
