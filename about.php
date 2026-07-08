<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Helping Hand Foundation</title>
  <style>
    
    body {
  font-family: 'Times New Roman', Times, serif;
      background-color: #fff;}
    .about{
        font-family: 'Times New Roman', Times, serif;

    }
    .hero {
  background: url('image/earth2.jpg') center center / cover no-repeat;
  background-attachment: fixed; /* image stays fixed */
  height: 250px; /* adjust height as needed */
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  color:white;
}  .hero::after {
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

    h2.section-title {
      text-align: center;
      font-size: 32px;
      margin: 50px 0 30px;
      color: #222;
      font-weight: bold;
      position: relative;
    }
    h2.section-title::after {
      content: "";
      display: block;
      width: 60px;
      height: 4px;
      background: #43cabfff;
      margin: 12px auto 0;
      border-radius: 2px;
    }

    /* ===== About Section ===== */
    .about-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      max-width: 1200px;
      margin: 60px auto;
      align-items: center;
      padding: 0 20px;
    }
    .about-left {
      position: relative;
    }
    .about-left img {
      width: 100%;
      border-radius: 12px;
    }
    .video-box {
  position: absolute;
  bottom: -40px;
  right: 30px;
  width: 55%;
  height: 220px;
  background: #000;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
  overflow: hidden;
}

.video-box img {
  position: absolute;   /* ❌ aa line delete karo */
  top: 0; left: 0;    
  
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 12px;
}
  .about-right h5 {
      color: #43cabfff;
      font-size: 16px;
      margin-bottom: 10px;
    }
    .about-right h2 {
      font-size: 36px;
      margin-bottom: 20px;
      line-height: 1.3;
      color: #222;
    }
    .features {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin: 20px 0 30px;
    }
    .feature {
      display: flex;
      gap: 12px;
      align-items: flex-start;
    }
    .feature-icon {
      font-size: 22px;
      color:  #43cabfff;
      background: #e6f7ee;
      padding: 14px;
      border-radius: 50%;
    }
    .feature-title {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 6px;
    }
    .about-buttons {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    .btn-explore {
      background: #43cabfff;
      color: #fff;
      padding: 12px 28px;
      border-radius: 30px;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      display: inline-flex;
      gap: 8px;
      transition: 0.3s;
    }
    .btn-explore:hover { background: #43cabfff; }

    /* ===== Timeline / Our History ===== */
    .timeline-section {
      max-width: 1200px;
      margin: 60px auto;
      position: relative;
      padding: 40px 20px;
    }
    .timeline {
      position: relative;
      margin: 0 auto;
      padding: 0;
      width: 90%;
    }
    .timeline::before {
      content: "";
      position: absolute;
      top: 0; bottom: 0;
      left: 50%;
      width: 4px;
      background: #43cabfff;
      transform: translateX(-50%);
    }
    .timeline-item {
      position: relative;
      width: 50%;
      padding: 20px 30px;
      box-sizing: border-box;
    }
    .timeline-item .content {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s;
    }
    .timeline-item .content:hover { transform: translateY(-5px); }
    .timeline-item img { width: 100%; border-radius: 10px 10px 0 0; }
    .timeline-item .text { padding: 20px; }
    .timeline-item h4 { font-size: 14px; font-weight: bold; color:  #43cabfff; }
    .timeline-item h3 { font-size: 20px; margin: 10px 0; }
    .timeline-item ul { list-style: none; padding: 0; }
    .timeline-item ul li {
      font-size: 14px;
      color: #555;
      margin: 8px 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .timeline-item ul li i { color:  #43cabfff; }

    .timeline-item.left { left: 0; text-align: right; }
    .timeline-item.right { left: 50%; }
    .timeline-item.left::before,
    .timeline-item.right::before {
      content: "";
      position: absolute;
      top: 40px;
      width: 16px; height: 16px;
      background: #fff;
      border: 3px solid  #43cabfff;
      border-radius: 50%;
      z-index: 1;
    }
    .timeline-item.left::before { right: -8px; }
    .timeline-item.right::before { left: -8px; }

    @media (max-width: 768px) {
      .timeline::before { left: 8px; }
      .timeline-item { width: 100%; padding-left: 40px; }
      .timeline-item.left, .timeline-item.right { left: 0; text-align: left; }
      .timeline-item.left::before, .timeline-item.right::before { left: 0; margin-left: -2px; }
    }

    /* ===== Awards Section ===== */
    /* ===== Awards Section ===== */
.awards {
  position: relative;
  padding: 80px 20px;
  text-align: center;
  color: #fff;
  background: url("image/award-bg.jpg") no-repeat center/cover;
  background-attachment: fixed;  /* 👈 image scroll ma lock thase */
  z-index: 0;
  overflow: hidden;
}

/* Dark overlay on top of background */
.awards::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.6); /* semi-transparent black layer */
  z-index: -1;
}

.awards-content {
  position: relative;
  max-width: 1200px;
  margin: auto;
}

.awards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
  gap: 40px;
  margin-top: 40px;
}

.award-circle {
  width: 130px;
  height: 130px;
  margin: auto;
  background: #43cabf;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 32px;
  font-weight: bold;
  border: 5px solid #fff;
}


    /* ===== Mission Goals ===== */
    .mission {
      padding: 70px 20px;
      background: #fff;
    }
    .mission-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
      gap: 30px;
      max-width: 1100px;
      margin: 40px auto 0;
    }
    .mission-box {
      text-align: center;
      padding: 25px;
      border: 1px solid #eee;
      border-radius: 10px;
      transition: 0.3s;
      background: #fff;
    }
    .mission-box:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.1); transform: translateY(-5px); }
    .mission-box i { font-size: 36px; color: #43cabfff;; margin-bottom: 15px; }
    .mission-box h4 { margin: 10px 0; color: #004080; }

    /* ===== Team ===== */
    .team {
      padding: 70px 20px;
      background: #f7f7f7;
    }
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
      gap: 25px;
      max-width: 1100px;
      margin: 40px auto 0;
    }
    .team-card {
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s;
    }
    .team-card:hover { transform: translateY(-8px); }
    .team-card img { width: 100%; height: 260px; object-fit: cover; }
    .team-card h4 { margin: 15px 0 5px; font-size: 18px; }
    .social a { color: #43cabfff;; margin: 0 6px; font-size: 16px; transition: 0.3s; }
    .social a:hover { color: #004080; }
  </style>
</head>
<body>
  <div class="about">
  <div class="hero">
    <h1>About Us</h1>
  </div>
 <!-- ===== About Us ===== -->
  <section class="about-section">
  <div class="about-left">
    <img src="image/kids1.jpg" alt="Helping Children">  </div>

      

  <div class="about-right">
    <h5><i class="fas fa-heart"></i> About Us</h5>
    <h2>Give A Helping Hand For Needy People</h2>
    <p>We are committed to helping the underprivileged by providing food, shelter, education, and hope for a brighter future.</p>
    <div class="features">
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-hands-helping"></i></div>
        <div>
          <div class="feature-title">Start Helping Team</div>
          <p><i class="fas fa-check-circle"></i> Many variations of support</p>
        </div>
      </div>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
        <div>
          <div class="feature-title">Make Donations</div>
          <p><i class="fas fa-check-circle"></i> Support noble causes</p>
        </div>
      </div>
    </div>
    <div class="about-buttons">
      <a href="#" class="btn-explore"><i class="fas fa-arrow-right"></i> Explore More</a>
      <div class="call-info">
        <i class="fas fa-phone-alt"></i>
        <div>
          <div>Call Any Time</div>
          <span>(+91) 265 668 75</span>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- ===== Our History ===== -->
  <section class="timeline-section">
    <h2 class="section-title">Our History</h2>
    <div class="timeline">
      <div class="timeline-item left">
        <div class="content">
          <img src="image/earth-bg.jpg" alt="2014">
          <div class="text">
            <h4>2014 AUG 06</h4>
            <h3>Helping Hands Begin</h3>
            <ul>
              <li><i class="fas fa-check-circle"></i> First community support</li>
              <li><i class="fas fa-check-circle"></i> Started awareness drives</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="timeline-item right">
        <div class="content">
          <img src="image/earth1.jpg" alt="2015">
          <div class="text">
            <h4>2015 AUG 06</h4>
            <h3>Expanding Support</h3>
            <ul>
              <li><i class="fas fa-check-circle"></i> Food donation campaigns</li>
              <li><i class="fas fa-check-circle"></i> Shelter programs</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="timeline-item left">
        <div class="content">
          <img src="image/earth2.jpg" alt="2017">
          <div class="text">
            <h4>2017 AUG 06</h4>
            <h3>Reaching More Children</h3>
            <ul>
              <li><i class="fas fa-check-circle"></i> Education drives</li>
              <li><i class="fas fa-check-circle"></i> Health check-up camps</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="timeline-item right">
        <div class="content">
          <img src="image/earth3.jpg" alt="2023">
          <div class="text">
            <h4>2023 AUG 06</h4>
            <h3>Global Community</h3>
            <ul>
              <li><i class="fas fa-check-circle"></i> International outreach</li>
              <li><i class="fas fa-check-circle"></i> Strong volunteer network</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <!-- ===== Awards ===== -->
<section class="awards">
  <div class="awards-content">
    <h2 class="section-title" style=color:white>Our Awards</h2>
    <div class="awards-grid">
      <div>
        <div class="award-circle">67</div>
        <p>Team Members</p>
      </div>
      <div>
        <div class="award-circle">972</div>
        <p>Awards</p>
      </div>
      <div>
        <div class="award-circle">1820</div>
        <p>Projects</p>
      </div>
      <div>
        <div class="award-circle">162</div>
        <p>Happy Clients</p>
      </div>
    </div>
  </div>
</section>

  <!-- ===== Mission & Goals ===== -->
  <section class="mission">
    <h2 class="section-title">Mission & Goals</h2>
    <div class="mission-grid">
      <div class="mission-box"><i class="fas fa-donate"></i><h4>Make a Donation</h4><p>Help us serve more communities by supporting financially.</p></div>
      <div class="mission-box"><i class="fas fa-users"></i><h4>Become A Volunteer</h4><p>Join our family of volunteers and change lives together.</p></div>
      <div class="mission-box"><i class="fas fa-home"></i><h4>Shelter for Homeless</h4><p>Providing safe places for those who need it the most.</p></div>
      <div class="mission-box"><i class="fas fa-globe"></i><h4>Make World Happier</h4><p>Our vision is a happy, safe, and equal world for everyone.</p></div>
    </div>
  </section>

  <!-- ===== Team ===== -->
  <section class="team">
    <h2 class="section-title">Our Team</h2>
    <div class="team-grid">
      <div class="team-card"><img src="image/person3.jpg" alt="Abigail"><h4>Abigail</h4><div class="social"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-instagram"></i></a></div></div>
      <div class="team-card"><img src="image/person2.jpg" alt="Adrian"><h4>Adrian</h4><div class="social"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-instagram"></i></a></div></div>
        </div>
  </section>
 
  <?php include 'footer.php';?>
  </div>
</body>
</html>

