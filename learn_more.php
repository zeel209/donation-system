<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learn More - Unity Foundation</title>
  <style>
    /* Reset some default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      line-height: 1.6;
      background-color: #f6f9fb;
      color: #333;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    header {
      background-color: rgb(71, 176, 189);
      color: white;
      padding: 30px 20px;
      text-align: center;
    }

    header h1 {
      font-size: 3rem;
      margin-bottom: 10px;
    }

    header p {
      font-size: 1.2rem;
    }

    section {
      padding: 60px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .section-title {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2rem;
      color: rgb(71, 176, 189);
      position: relative;
    }

    .section-title::after {
      content: '';
      display: block;
      width: 60px;
      height: 4px;
      background-color:rgb(76, 78, 103);
      margin: 10px auto 0;
      border-radius: 2px;
    }

    .services-container, .news-container, .events-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .service-card, .news-card, .event-card {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .service-card:hover, .news-card:hover, .event-card:hover {
      transform: translateY(-5px);
    }

    .service-card h3, .news-card h3, .event-card h3 {
      color: rgb(71, 176, 189);
      margin-bottom: 10px;
    }

    .about-text {
      max-width: 800px;
      margin: auto;
      text-align: center;
      font-size: 1.1rem;
    }

    footer {
      background-color: rgb(76, 78, 103);
      color: white;
      text-align: center;
      padding: 10px 20px;
    }

    footer a {
      color:rgb(71, 176, 189);
    }
 
    @media(max-width: 768px){
      header h1 {
        font-size: 2.2rem;
      }
      .section-title {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

  <!-- Hero / Welcome Section -->
  <header>
    <h1>Welcome to Unity Foundation</h1>
    <p>Empowering communities, inspiring change, and making a difference together.</p>
  </header>

  <!-- Services Section -->
  <section id="services">
    <h2 class="section-title">Our Services</h2>
    <div class="services-container">
      <div class="service-card">
        <h3>Education Support</h3>
        <p>Providing educational resources and scholarships to children in need.</p>
      </div>
      <div class="service-card">
        <h3>Healthcare Programs</h3>
        <p>Organizing medical camps and health awareness programs for communities.</p>
      </div>
      <div class="service-card">
        <h3>Community Development</h3>
        <p>Supporting local communities with infrastructure and skill-building initiatives.</p>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about">
    <h2 class="section-title">About Us</h2>
    <p class="about-text">
      Unity Foundation is a non-profit organization dedicated to uplifting underprivileged communities
      through education, healthcare, and sustainable development programs. Our mission is to empower
      individuals and create lasting positive impact across society.
    </p>
  </section>

  <!-- News Section -->
  <section id="news">
    <h2 class="section-title">Latest News</h2>
    <div class="news-container">
      <div class="news-card">
        <h3>Annual Charity Gala 2025</h3>
        <p>Unity Foundation hosted its annual charity gala, raising funds to support education programs.</p>
      </div>
      <div class="news-card">
        <h3>New Healthcare Initiative</h3>
        <p>Launched a new mobile health camp to reach remote villages and provide medical checkups.</p>
      </div>
    </div>
  </section>

  <!-- Events Section -->
  <section id="events">
    <h2 class="section-title">Upcoming Events</h2>
    <div class="events-container">
      <div class="event-card">
        <h3>Volunteer Workshop</h3>
        <p>Join us for a workshop to train new volunteers on community service activities.</p>
      </div>
      <div class="event-card">
        <h3>Tree Plantation Drive</h3>
        <p>Participate in our environmental initiative to plant trees and promote green spaces.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Unity Foundation | <a href="contact.php">Contact Us</a></p>
  </footer>

</body>
</html>
