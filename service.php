<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charity Services</title>
  <style>

.section-title {
  text-align: center;
  margin:0px 0px 0px; /* reduced margin-top */
  animation: fadeInDown 0.6s ease-in-out;
}
.section-title h2{
  font-size:30px;
}

.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 35px; /* increased gap between cards */
  max-width: 1200px;
  margin: 40px auto 20px; /* added margin-top to create space between heading and cards */
  padding: 20px;
}

    .card {
      background: #fff;
      border-radius: 15px;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      position: relative;
      transform: translateY(40px);
      opacity: 0;
      transition: transform 0.6s ease, opacity 0.6s ease;
    }

    .card.show {
      transform: translateY(0);
      opacity: 1;
    }

    /* Flip container */
    .icon-wrapper {
      width: 100px;
      height: 100px;
      margin: -70px auto 20px;
      perspective: 1000px;
    }

    .flip-box {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      transition: transform 0.8s;
    }

    .icon-wrapper:hover .flip-box {
      transform: rotateY(180deg);
    }

    .flip-front, .flip-back {
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: rgba(71, 175, 189, 0.33);
      border: 6px solid rgb(71, 176, 189);
      display: flex;
      align-items: center;
      justify-content: center;
      backface-visibility: hidden;
    }

    .flip-front img,
    .flip-back img {
      width: 40px;
    }

    .flip-back {
      transform: rotateY(180deg);
      background:rgba(62, 60, 92, 0.29);
      border: 6px solid #3d5a6dff;
    }

    .card h3 {
      font-size: 20px;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .card p {
      font-size: 15px;
      color: #555;
      margin-bottom: 25px;
    }

    .card button {
      background:rgb(71, 176, 189);
      border: none;
      padding: 12px 25px;
      color: #fff;
      border-radius: 25px;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .card button:hover {
      background: rgb(71, 176, 189);
      transform: scale(1.05);
    }

    @keyframes fadeInDown {
      0% {
        opacity: 0;
        transform: translateY(-30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .section-title h2 {
        font-size: 24px;
      }
      .icon-wrapper {
        width: 80px;
        height: 80px;
      }
      .flip-front img,
      .flip-back img {
        width: 30px;
      }
    }
  </style>
</head>
<body>

  <section>
    <div class="section-title">
      <h2>Charity Services</h2>
    </div>

    <div class="cards">
      <div class="card">
        <div class="icon-wrapper">
          <div class="flip-box">
            <div class="flip-front">
              <img src="image\sevices_women.png" alt="women Enpowerment">
            </div>
            <div class="flip-back">
              <img src="https://img.icons8.com/ios-filled/50/000000/ok.png" alt="Done">
            </div>
          </div>
        </div>
        <h3>Women Empowerment</h3>
        <p>Skill development (sewing, handicrafts, IT courses).Awareness programs for rights, health, and financial independence. </p>
        <button onclick="location.href='learn_more.php'">Learn More →</button>
      </div>

      <div class="card">
        <div class="icon-wrapper">
          <div class="flip-box">
            <div class="flip-front">
              <img src="https://img.icons8.com/ios-filled/50/27ae60/graduation-cap.png" alt="Education">
            </div>
            <div class="flip-back">
              <img src="https://img.icons8.com/ios-filled/50/000000/open-book.png" alt="Book">
            </div>
          </div>
        </div>
        <h3>Educations</h3>
        <p>Providing school supplies, tuition, or scholarships for underprivileged children.Free evening classes or digital literacy programs.</p>
        <button onclick="location.href='learn_more.php'">Learn More →</button>
      </div>

      <div class="card">
        <div class="icon-wrapper">
          <div class="flip-box">
            <div class="flip-front">
              <img src="https://img.icons8.com/ios-filled/50/c0392b/stethoscope.png" alt="Medical Help">
            </div>
            <div class="flip-back">
              <img src="image\service_medical.png" alt="Heart">
            </div>
          </div>
        </div>
        <h3>Medical Help</h3>
        <p>Free health camps, blood donation drives, and medical checkups.Support for critical treatments (cancer, dialysis, heart surgery, etc.)</p>
        <button onclick="location.href='learn_more.php'">Learn More →</button>
      </div>
    </div>
  </section>

  <script>
    // Fade-in animation on scroll
    const cards = document.querySelectorAll(".card");

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          entry.target.classList.add("show");
        }
      });
    },{
      threshold: 0.2
    });

    cards.forEach(card => {
      observer.observe(card);
    });
  </script>

</body>
</html>
