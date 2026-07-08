<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News & Stories</title>
  <style>
    .news-section {
      padding: 40px;
      max-width: 1200px;
    }

    .news-section h2 {
      font-size: 28px;
      color:rgb(71, 176, 189);
      margin-bottom: 30px;
      font-weight: bold;
    }
.news-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}


    .news-card {
      display: flex;
      background: #98cbd13b;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .news-card img {
      width: 50%;
      height: 200px;
      object-fit: cover;
    }

    .news-content {
      padding: 20px;
      width: 50%;
    }

    .news-date {
      font-size: 12px;
      color: rgb(71, 176, 189);
      letter-spacing: 1px;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .news-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
      color:rgb(76, 78, 103);
    }

    .news-desc {
      font-size: 14px;
      color: rgb(76, 78, 103);
      margin-bottom: 15px;
      line-height: 1.5;
    }

    .read-more {
      font-size: 14px;
      font-weight: bold;
      color: rgb(76, 78, 103);
      text-decoration: none;
    }

    .read-more:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .news-card {
        flex-direction: column;
      }
      .news-card img, .news-content {
        width: 50%;
      }
    }
  </style>
</head>
<body>

  <section class="news-section">
    <h2 style=text-align:center;>News & Stories</h2>
    <div class="news-grid">

      <!-- Card 1 -->
      <div class="news-card">
        <img src="image\news1.jpg" alt="Kids in wheelchair">
        <div class="news-content">
          <div class="news-date">JULY | 20 | 2025</div>
          <div class="news-title">How Has Your Money Helped?</div>
          <div class="news-desc">Read an inspiring story about Robert and James Johnes whom we've helped last year.</div>
          <a href="learn_more.php" class="read-more">Read More →</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="news-card">
        <img src="image\news2.jpg" alt="Kids moving home">
        <div class="news-content">
          <div class="news-date">AUG | 12 | 2025</div>
          <div class="news-title">Kids Are Moving To A New Home</div>
          <div class="news-desc">They became homeless after the flood in California. Now they've got a new home.</div>
          <a href="learn_more.php" class="read-more">Read More →</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="news-card">
        <img src="image/news3.jpeg" alt="Foster parent">
        <div class="news-content">
          <div class="news-date">SEP | 03 | 2025</div>
          <div class="news-title">How To Be A Good Foster Parent</div>
          <div class="news-desc">The decision to adopt a child is hard to make as it is associated with many fears.</div>
          <a href="learn_more.php" class="read-more">Read More →</a>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="news-card">
        <img src="image\news4.jpg" alt="Child with cast">
        <div class="news-content">
          <div class="news-date">OCT | 04 | 2025</div>
          <div class="news-title">Problems of Pediatric Medicine</div>
          <div class="news-desc">Let's look at the most serious problems associated with children's health care.</div>
          <a href="learn_more.php" class="read-more">Read More →</a>
        </div>
      </div>

    </div>
  </section>

</body>
</html>
