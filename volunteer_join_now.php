<?php
session_set_cookie_params([
    'lifetime' => 0, // Browser close થાય ત્યાં સુધી જ session રહેશે
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

include("db.php");


// Check login and remember page
if(!isset($_SESSION['user_id'])){

    $_SESSION['redirect'] = "volunteer_join_now.php";

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $contact  = $_POST['phone'];
    $subject  = $_POST['interest'];


    $stmt = $conn->prepare(
        "INSERT INTO volunteer(user_id, name, email, contact, subject)
         VALUES (?, ?, ?, ?, ?)"
    );


    $stmt->bind_param(
        "issss",
        $user_id,
        $name,
        $email,
        $contact,
        $subject
    );


    if($stmt->execute()){

        header("Location: volunteer_thankyou.php");
        exit();

    }
    else{

        echo "Error: ".$stmt->error;

    }

}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Join Now — Volunteer for Charity</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    :root{
      --primary:#ff6b6b;
      --secondary:#ff9f43;
      --dark:#2d3436;
      --muted:#636e72;
      --success:#00b894;
      --card:#ffffff;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:Poppins,Arial,sans-serif;background:linear-gradient(135deg, #fff, #fff);color:var(--dark)}
    
    .container{max-width:1200px;margin:auto;padding:40px 20px}
    .grid{display:grid;grid-template-columns:1fr 400px;gap:40px}

    .hero{
      background:linear-gradient(135deg,rgba(255,107,107,0.1),rgba(255,159,67,0.1));
      border-radius:16px;padding:32px;border:1px solid rgba(0,0,0,0.05);
      box-shadow:0 8px 24px rgba(255,107,107,0.2);
    }
    .hero h1{margin:0 0 12px;font-size:32px;color: #43cabf}
    .hero p{margin:0 0 20px;color:var(--muted);line-height:1.6}

    .benefits{display:flex;flex-wrap:wrap;gap:16px}
    .benefit{flex:1;min-width:220px;background:#fff;padding:16px;border-radius:14px;display:flex;align-items:center;gap:14px;box-shadow:0 4px 10px rgba(0,0,0,0.05)}
    .benefit i{font-size:22px;color: #43cabf}
    .benefit strong{color:var(--dark)}

    /* Certificate Box */
    .certificate-box{
      margin-top:28px;
      display:flex;
      align-items:center;
      gap:20px;
      background:#fff;
      border-radius:16px;
      padding:20px;
      box-shadow:0 8px 20px rgba(0,0,0,0.08);
      border-left:6px solid #a8c8cbff;
    }
    .certificate-box img{
      width:160px;
      height:120px;
      object-fit:cover;
      border-radius:10px;
      box-shadow:0 4px 10px rgba(0,0,0,0.1);
    }
    .certificate-box h3{
      margin:0 0 8px;
      color: #43cabf;
      font-size:20px;
    }
    .certificate-box p{
      margin:0;
      color:var(--muted);
      line-height:1.5;
    }
    .certificate-box1 {
  margin-top: 28px;
  background: url("image/certificate.jpg.png") center/cover no-repeat;
  border-radius: 16px;
  padding: 150px 20px; /* controls height */
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  border-left: 6px solid #a8c8cbff;
  position: relative;
  overflow: hidden;
  color: #fff; /* text white for contrast */
}

.certificate-box1::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.45); /* dark overlay for readability */
  border-radius: 16px;
}

.certificate-box1 .content {
  position: relative;
  z-index: 1;
  text-align: center;
}

.certificate-box1 h3 {
  margin: 0 0 10px;
  font-size: 24px;
  color: #fff;
}

.certificate-box1 p {
  margin: 0;
  font-size: 16px;
  line-height: 1.6;
  color: #f1f1f1;
}

    

    .card{background:var(--card);border-radius:16px;padding:28px;box-shadow:0 6px 20px rgba(0,0,0,0.08)}
    .card h2{margin:0 0 10px;color:#43cabf}
    .card p{color:var(--muted)}

    form{display:flex;flex-direction:column;gap:14px;margin-top:10px}
    label{font-size:14px;font-weight:600;color:}
    input,select,textarea{
      width:100%;padding:12px;border-radius:10px;border:1px solid #ddd;font-size:15px
    }
    textarea{min-height:120px}
    .two-col{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .btn{display:inline-flex;align-items:center;gap:10px;padding:14px 18px;border:none;border-radius:12px;cursor:pointer;font-weight:600;font-size:15px;transition:0.3s}
    .btn.primary{background:  #43cabf;color: #fff;}
    .btn.primary:hover{background: #43cabf}
    .btn.secondary{background:transparent;color:var(--primary);border:2px solid  #43cabf}
    .btn.secondary:hover{background: #43cabf;color:#fff}

    .checkbox-row{display:flex;align-items:flex-start;gap:10px}
    .checkbox-row label{font-size:13px;color:var(--muted)}

    .info{margin-top:20px;display:flex;flex-direction:column;gap:14px}
    .info-item{display:flex;gap:12px;align-items:center}
    .info-item i{color: #43cabf;font-size:20px}

    .success{display:none;background:#dfffe7;border:1px solid #a3f2b3;padding:12px;border-radius:10px;color:var(--success);font-weight:600;margin-top:12px}

    @media(max-width:960px){.grid{grid-template-columns:1fr}}
    @media(max-width:600px){.certificate-box{flex-direction:column;align-items:flex-start}}
  </style>
</head>
<body>
  <div class="container">
    <div class="grid">
      <section class="hero">
        <h1>Join Now — Become a Hero of Change ✨</h1>
        <p>Be part of something bigger than yourself. Every helping hand matters, whether you can give your time for a day, a week, or longer. Together, we create brighter futures.</p>

        <div class="benefits">
          <div class="benefit"><i class="fa-solid fa-hands-holding-heart"></i><div><strong>Impactful Work</strong><div>Support real lives</div></div></div>
          <div class="benefit"><i class="fa-solid fa-calendar-check"></i><div><strong>Flexible Hours</strong><div>Volunteer at your pace</div></div></div>
          <div class="benefit"><i class="fa-solid fa-users-line"></i><div><strong>Community</strong><div>Meet like-minded people</div></div></div>
        </div>

        <!-- Certificate Highlight Box -->
        <div class="certificate-box">
          <img src="image/certificate.jpg.png" alt="Volunteer Certificate">
          <div>
            <h3>Volunteer Certification</h3>
            <p>After 20+ hours of service, you will receive an official certificate recognizing your contribution. This can boost your resume, academic profile, and personal pride.</p>
           
          </div>
        </div>
         
            <div class="certificate-box1">
  <div class="content">
    <h3>Earn Your Certificate 🏅</h3>
    <p>Every volunteer will receive a <strong>recognized certificate</strong> 
       for their contribution, perfect for resumes and portfolios.</p>
  </div>
</div>


      </section>

      <aside class="card">
        <h2>Volunteer Sign-up</h2>
        <p>Fill the form below — our team will reach out to you.</p>
        <form id="volunteerForm" method="POST" action="volunteer_join_now.php">
  <div class="two-col">
    <div>
      <label>Full Name *</label>
      <input type="text" name="name" id="name" placeholder="Your full name" required>
    </div>
    <div>
      <label>Phone *</label>
      <input type="tel" name="phone" id="phone" placeholder="+91 98765 43210" required>
    </div>
  </div>

  <label>Email *</label>
  <input type="email" name="email" id="email" placeholder="you@example.com" required>

  <label>Interested In *</label>
  <select name="interest" id="interest" required>
    <option value="">-- Select --</option>
    <option>Event Support</option>
    <option>Teaching/Tutoring</option>
    <option>Driving & Logistics</option>
    <option>Remote/Administrative</option>
    <option>Other</option>
  </select>

  <label>Availability *</label>
  <input type="text" name="availability" id="availability" placeholder="Weekends, evenings..." required>

  <label>Skills / Notes</label>
  <textarea name="skills" id="skills"></textarea>

  <div class="checkbox-row">
   <input type="checkbox" name="agree" id="agree" required>
    <label for="agree">I agree to be contacted about volunteering opportunities *</label>
  </div>
<button type="submit" id="submitBtn" class="btn primary">
    Join Now <i class="fa-solid fa-arrow-right"></i>
</button>
</form>

        <div class="info">
          <div class="info-item"><i class="fa-solid fa-phone"></i><span>+91 98765 43210</span></div>
          <div class="info-item"><i class="fa-solid fa-envelope"></i><span>volunteer@charity.org</span></div>
          <div class="info-item"><i class="fa-solid fa-location-dot"></i><span>Main Street, Community Center</span></div>
        </div>
      </aside>
    </div>

    <section style="margin-top:40px">
      <div class="card">
        <h2>Why Volunteer With Us?</h2>
        <p>Our programs focus on education, healthcare, and community relief. By joining, you’ll gain valuable experience, new friends, and the joy of giving back.</p>
        <ul style="color:var(--muted);margin-top:12px">
          <li>Hands-on experience in impactful projects</li>
          <li>Flexible schedules for students and professionals</li>
          <li>Volunteer certificate for your contribution</li>
        </ul>
      </div>
    </section>
  </div>
  <style>
  .error {color:red;font-size:12px;margin-top:2px;display:block;}
</style>
<script>

const form = document.getElementById("volunteerForm");
const submitBtn = document.getElementById("submitBtn");

function validateForm() {
  let valid = true;

  // Name
  const name = document.getElementById("name").value.trim();
  document.getElementById("nameError").innerText = "";
  if(name === "") { 
    document.getElementById("nameError").innerText = "Name is required"; 
    valid = false; 
  }

  // Phone
  const phone = document.getElementById("phone").value.trim();
  const phonePattern = /^[0-9]{10}$/;
  document.getElementById("phoneError").innerText = "";
  if(!phonePattern.test(phone)) { 
    document.getElementById("phoneError").innerText = "Enter 10-digit phone"; 
    valid = false; 
  }

  // Email
  const email = document.getElementById("email").value.trim();
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  document.getElementById("emailError").innerText = "";
  if(!emailPattern.test(email)) { 
    document.getElementById("emailError").innerText = "Enter valid email"; 
    valid = false; 
  }

  // Interest
  const interest = document.getElementById("interest").value;
  document.getElementById("interestError").innerText = "";
  if(interest === "") { 
    document.getElementById("interestError").innerText = "Select an option"; 
    valid = false; 
  }

  // Availability
  const availability = document.getElementById("availability").value.trim();
  document.getElementById("availabilityError").innerText = "";
  if(availability === "") { 
    document.getElementById("availabilityError").innerText = "Availability is required"; 
    valid = false; 
  }

  // Checkbox
  const agree = document.getElementById("agree").checked;
  document.getElementById("agreeError").innerText = "";
  if(!agree){ 
    document.getElementById("agreeError").innerText = "You must agree"; 
    valid = false; 
  }

  // Enable or disable submit button
  submitBtn.disabled = !valid;

  return valid;
}

// Validate on input change
form.addEventListener("input", validateForm);

// Initial validation check
validateForm();
</script>

</script>
</body>
</html>
