<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Volunteer Form with Video</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
   font-family:'Times New Roman', Times, serif;

    }

    .contact-section {
      position: relative;
      background: url("hero1.jpg") no-repeat center center/cover;
      min-height: 500px;
      border-radius: 20px;
      margin: 40px;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    .contact-section::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,40,30,0.8); 
      z-index: 0;
    }

    .contact-content {
      position: relative;
      z-index: 1;
      display: flex;
      width: 100%;
      padding: 40px;
      color: #fff;
    }

    /* Left form */
    .contact-left {
      flex: 1;
      padding-right: 30px;
    }
    .contact-left h5 {
      color: ;
      font-size: 20px;
      margin-bottom: 10px;
    }
    .contact-left h2 {
      font-size: 36px;
      margin-bottom: 30px;
      font-weight: bold;
    }
    .contact-left form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .contact-left form input,
    .contact-left form textarea {
      padding: 14px;
      border: 1px solid #444;
      border-radius: 8px;
      background: transparent;
      color: #fff;
      font-size: 15px;
    }
    .contact-left form input::placeholder,
    .contact-left form textarea::placeholder {
      color: #aaa;
    }
    .contact-left form textarea {
      grid-column: span 2;
      min-height: 120px;
      resize: none;
    }
    .contact-left button {
      grid-column: span 2;
      padding: 14px;
      background:  rgb(71, 176, 189);
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .contact-left button:hover {
      background: rgba(254, 254, 254, 1);
      color:black;
    }

    /* Right play button */
    .contact-right {
      flex: 1;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .play-btn {
  position: relative;
  width: 110px;
  height: 110px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  overflow: hidden;
}

/* Outer rotating gradient ring */
.play-btn::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 50%;
  padding: 4px; /* border thickness */
  background: conic-gradient(
      #ffffffff,
     rgb(71, 176, 189),
     rgb(70, 180, 200),
      #3697bebb
  );
  -webkit-mask: 
    linear-gradient(#fff 0 0) content-box, 
    linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
  mask-composite: exclude;
  animation: rotate 3s linear infinite;
}

/* Inner dark circle */
.play-btn::after {
  content: "";
  position: absolute;
  inset: 8px;
  border-radius: 50%;
  background: rgba(0,0,0,0.7);
  z-index: 1;
}

/* Icon */
.play-btn i {
  font-size: 36px;
  color: #fff;
  z-index: 2;
  position: relative;
}

/* Rotation animation */
@keyframes rotate {
  100% { transform: rotate(360deg); }
}

    
    .play-btn:hover {
      background:  #43cabf;
    }

    /* Popup video modal */
    .video-popup {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.8);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 999;
    }
    .video-popup iframe {
      width: 80%;
      height: 70%;
      border: none;
      border-radius: 10px;
    }
    .video-popup .close-btn {
      position: absolute;
      top: 30px;
      right: 50px;
      font-size: 35px;
      color: #fff;
      cursor: pointer;
    }

    @media (max-width: 900px) {
      .contact-content {
        flex-direction: column;
      }
      .contact-right {
        margin-top: 30px;
      }
    }
  </style>
</head>
<body>

<section class="contact-section">
  <div class="contact-content">
    <!-- Left -->
    <div class="contact-left">
      <h5 style=color:#47b0bdff;> Contact Us</h5>
      <h2>Volunteer Positions Available</h2>
      <form>
        <input type="text" placeholder="Your Name">
        <input type="text" placeholder="Phone Number">
        <input type="email" placeholder="Email Address">
        <input type="text" placeholder="Subject">
        <textarea placeholder="Write a Message"></textarea>
        <button type="submit">Send a Message</button>
      </form>
    </div>

    <!-- Right Play Button -->
    <div class="contact-right">
      <div class="play-btn" id="playVideo">
        <i class="fas fa-play"></i>
      </div>
    </div>
  </div>
</section>

<!-- Video Popup -->
<div class="video-popup" id="videoPopup">
  <span class="close-btn" id="closePopup">&times;</span>
  <iframe id="youtubeFrame" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>

<script>
  const playBtn = document.getElementById("playVideo");
  const videoPopup = document.getElementById("videoPopup");
  const closePopup = document.getElementById("closePopup");
  const youtubeFrame = document.getElementById("youtubeFrame");

  playBtn.addEventListener("click", () => {
    youtubeFrame.src = "https://www.youtube.com/embed/PJ0e6Ij7028?autoplay=1&rel=0"; // 👈 Replace with your YouTube link
    videoPopup.style.display = "flex";
  });

  closePopup.addEventListener("click", () => {
    youtubeFrame.src = "";
    videoPopup.style.display = "none";
  });
</script>

</body>
</html>
