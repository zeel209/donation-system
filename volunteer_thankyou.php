<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteer Join Form with Thank You Box</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fdf2f2;
      padding: 40px;
      color: #333;
    }
    
    /* Thank You Box (hidden by default) */
    .thank-you-box {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 999;
    }
    .thank-you-content {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      text-align: center;
      max-width: 400px;
      animation: fadeIn 0.6s ease;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .thank-you-content i {
      font-size: 50px;
      color: #00b894;
      margin-bottom: 15px;
    }
    .thank-you-content h3 {
      margin: 10px 0;
      color: #ff6b6b;
    }
    .thank-you-content p {
      color: #555;
      font-size: 15px;
      margin-bottom: 20px;
    }
    .thank-you-content button {
      background:  #43cabf;
      padding: 12px 20px;
      border: none;
      border-radius: 10px;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }
    .thank-you-content button:hover {
      background:  #43cabf;
    }
    @keyframes fadeIn {
      from {opacity:0; transform: scale(0.9);}
      to {opacity:1; transform: scale(1);}
    }
  </style>
</head>
<body>
  
  <!-- Thank You Box -->
  <div class="thank-you-box" id="thankYouBox">
    <div class="thank-you-content">
      <i class="fa-solid fa-circle-check"></i>
      <h3>Thank You for Joining! 🎉</h3>
      <p>We appreciate your willingness to volunteer. Our team will contact you soon with the next steps.</p>
      <button type="button" class="btn primary" onclick="window.location.href='volunteer.php'">close </button>
      <a href="certificate.php">
<button class="print-btn">
🏆 Download Certificate
</button>
</a>
    </div>
  </div>

  <script>
    
    const thankYouBox = document.getElementById("thankYouBox");

    

    function closeThankYou(){
      thankYouBox.style.display = "none";
    }
    
  const thankYouBox = document.getElementById("thankYouBox");

  function closeThankYou(){
    // Hide the Thank You box
    thankYouBox.style.display = "none";
    // Redirect to the main volunteer page
    window.location.href = "volunteer1.php"; // <-- change this to your main volunteer page file
  }


  </script>
  

</body>
</html>
