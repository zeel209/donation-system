<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Section</title>
  <style>
    .faq-wrapper {
      max-width: 1200px;  /* Restrict width */
      margin: 50px auto; /* Center align */
      padding: 20px;
    }

    .faq-section {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 40px;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.08);
    }

    /* Left section */
    .faq-left h4 {
      color: rgb(71, 176, 189);
      font-weight: bold;
      margin-bottom: 10px;
    }

    .faq-left h2 {
      font-size: 34px;
      font-weight: 700;
      margin-bottom: 15px;
      line-height: 1.2;
      color:rgb(76, 78, 103);
    }

    .faq-left p {
      font-size: 15px;
      color: rgb(76, 78, 103);
      margin-bottom: 20px;
    }

    .question-form {
      background: rgb(216, 238, 241);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.05);
    }

    .question-form h3 {
      font-size: 18px;
      margin-bottom: 15px;
      color:rgba(76, 78, 103);
    }

    .question-form input,
    .question-form textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 20px;
      outline: none;
      font-size: 14px;
    }

    .question-form textarea {
      resize: none;
      height: 100px;
      border-radius: 12px;
    }

    .question-form button {
      width: 100%;
      padding: 12px;
      background: rgb(71, 176, 189);
      color: rgba(49, 50, 67, 1);
      border: none;
      border-radius: 30px;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .question-form button:hover {
      background:rgba(0, 0, 0, 1) ;
      color:rgba(255, 253, 253, 1);
    }

    /* Right Section - Accordion */
    .accordion {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .accordion-item {
      border: 1px solid #e2e2e2;
      border-radius: 12px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0px 3px 8px rgba(0,0,0,0.05);
    }

    .accordion-header {
      padding: 15px 20px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .accordion-header:hover {
      background: #f9f9f9;
    }

    .accordion-header::after {
      content: '\25BC';
      font-size: 14px;
      transition: transform 0.3s ease;
    }

    .accordion-header.active::after {
      transform: rotate(180deg);
    }

    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s ease;
      padding: 0 20px;
      font-size: 14px;
      color: rgb(76, 78, 103);
    }

    .accordion-content.show {
      max-height: 200px;
      padding: 15px 20px;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .faq-section {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="faq-wrapper">
    <div class="faq-section">
      <!-- Left Side -->
      <div class="faq-left">
        <h4>♡ Frequently Asked Questions</h4>
        <h2>Have Any Question For Us?</h2>
        <p>Partner with us to make a greater impact. Our corporate sponsorship program offers businesses the opportunity to support our mission while gaining visibility and fulfilling corporate social responsibility goals.</p>
        
        <div class="question-form">
          <h3>Have any Question</h3>
          <input type="text" placeholder="Your Name">
          <textarea placeholder="Write Message..."></textarea>
          <button>Ask Question Now</button>
        </div>
      </div>

      <!-- Right Side -->
      <div class="accordion">
        <!-- Original Questions -->
        <div class="accordion-item">
          <div class="accordion-header">What motivates you to donate to our charity?</div>
          <div class="accordion-content">Explore the variety of volunteer opportunities available. From event planning and fundraising to fieldwork and administrative support, there are many ways to lend your talents. Find the perfect fit for your skills and interests.</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">How did you hear about our organization?</div>
          <div class="accordion-content">We would love to know how you found out about us—whether through a friend, social media, or an event.</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">How frequently do you prefer to volunteer?</div>
          <div class="accordion-content">Some volunteers join us weekly, others monthly, or for special events. We welcome all!</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">How easy was it to navigate our online donation platform?</div>
          <div class="accordion-content">Your feedback helps us improve and make the donation process smoother.</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">How likely are you to recommend our charity to others?</div>
          <div class="accordion-content">Your support inspires others to join. Sharing your experience makes a huge difference.</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">What skills or expertise do you bring to our volunteer team?</div>
          <div class="accordion-content">Every talent counts, whether it's organizing, teaching, fundraising, or spreading awareness.</div>
        </div>

        <!-- ✅ Added Three More Questions -->
        <div class="accordion-item">
          <div class="accordion-header">Can I make recurring monthly donations?</div>
          <div class="accordion-content">Yes! We offer flexible recurring donation options to make continuous support easy for you.</div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Will I receive a receipt for my donation?</div>
          <div class="accordion-content">Absolutely. A receipt will be sent to your email after every donation for your records and tax purposes.</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const headers = document.querySelectorAll(".accordion-header");

    headers.forEach(header => {
      header.addEventListener("click", () => {
        const openItem = document.querySelector(".accordion-header.active");
        
        if (openItem && openItem !== header) {
          openItem.classList.remove("active");
          openItem.nextElementSibling.classList.remove("show");
        }

        header.classList.toggle("active");
        header.nextElementSibling.classList.toggle("show");
      });
    });
  </script>

</body>
</html>
