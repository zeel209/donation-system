<?php
include "db.php"; // Database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $contact  = trim($_POST['contact']);
    $subject  = trim($_POST['subject']);
    $comment  = trim($_POST['comment']);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO volunteer (name, email, contact, subject, comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $contact, $subject, $comment);

    if ($stmt->execute()) {
        // Redirect to manage volunteer page after successful insert
        header("Location: admin_manage_vounteer.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Volunteer</title>
  <style>
    body {
      background: #f0f4f7;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-container {
      max-width: 700px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0px 6px 20px rgba(0,0,0,0.1);
    }
    .form-title {
      font-weight: 600;
      color: #004d66;
      margin-bottom: 20px;
      font-size: 1.5rem;
      text-align: center;
    }
    .btn-submit {
      background-color: #43cabfff;
      color: #fff;
      font-weight: 500;
      border: none;
      padding: 10px 25px;
      cursor: pointer;
      border-radius: 5px;
      transition: 0.3s;
    }
    .btn-submit:hover {
      background-color: #36a99b;
    }
    .message {
      text-align:center;
      font-weight: bold;
      margin-bottom: 15px;
      color: green;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h5 class="form-title">Add Volunteer</h5>

    <?php if (!empty($message)): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Volunteer Name" required>
      </div>

      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>

      <div class="row mb-3">
        <div class="col">
          <input type="tel" name="contact" class="form-control" placeholder="Contact No" required>
        </div>
        <div class="col">
          <select name="subject" class="form-control" required>
            <option value="">Select Subject</option>
            <option value="Education">Education</option>
            <option value="Health">Health</option>
            <option value="Environment">Environment</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <textarea name="comment" class="form-control" rows="3" placeholder="Comment"></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-submit">Add Volunteer</button>
      </div>
    </form>
  </div>

</body>
</html>
