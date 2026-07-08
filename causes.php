<?php
include "header.php";
include "db.php";
$result = $conn->query("SELECT * FROM causes ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donation Causes</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  .hero {
    background: url('image/vol-bg1.jpg') center center / cover no-repeat;
    background-attachment: fixed;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    color: black;
  }
  .hero::after {
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

  .causes-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
  }
  .cause-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s ease-in-out;
  }
  .cause-card:hover {
    transform: translateY(-5px);
  }
  .cause-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }
  .cause-content {
    padding: 15px;
    text-align: center;
  }
  .cause-content h3 {
    font-size: 18px;
    margin: 10px 0;
    color: rgb(71, 176, 189);
  }

  .donate-btn {
    display: inline-block;
    background: rgb(71, 176, 189);
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease-in-out;
  }
  .donate-btn:hover {
    background: rgb(62, 60, 92);
  }

  /* Stats Section */
  .stats-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    text-align: center;
    margin: 40px 20px;
    gap: 20px;
  }
  .stat-box {
    position: relative;
    color: #fff;
    padding: 40px 20px;
    border-radius: 10px;
    background-size: cover;
    background-position: center;
    overflow: hidden;
  }
  .stat-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(32, 209, 209, 0.488);
    z-index: 1;
  }
  .stat-overlay.dark {
    background: rgba(100, 96, 96, 0.6);
  }
  .stat-content {
    position: relative;
    z-index: 2;
  }
  .stat-number {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .stat-icon {
    font-size: 40px;
    margin-bottom: 10px;
  }
  .stat-title {
    font-size: 20px;
    font-weight: bold;
  }
</style>
</head>
<body>

<div class="hero">
  <h1>Causes</h1>
</div>

<!-- Causes Section -->
<h2 style="color:#47b0bdff; text-align:center;">Our Causes</h2>
<div style="display:flex;flex-wrap:wrap;gap:20px;justify-content:center;">
<?php while($row = $result->fetch_assoc()): ?>
  <div style="border:1px solid #ccc;padding:10px;width:300px;border-radius:10px;box-shadow:0px 2px 8px rgba(0,0,0,0.1);">
    <?php if(!empty($row['image'])): ?>
      <img src="<?php echo $row['image']; ?>" width="100%" height="180px" style="object-fit:cover;">
    <?php endif; ?>
    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
    <p><?php echo htmlspecialchars($row['description']); ?></p>
    <p>Raised: ₹<?php echo $row['raised_amount']; ?> / Target: ₹<?php echo $row['target_amount']; ?></p>
    <a href="#" class="donate-btn">Donate</a>
  </div>
<?php endwhile; ?>
</div>

<!-- Stats Section -->
<div class="stats-section">
  <div class="stat-box" style="background-image: url('https://images.unsplash.com/photo-1509099836639-18ba1795216d');">
    <div class="stat-overlay"></div>
    <div class="stat-content">
      <div class="stat-number" id="count1">0</div>
      <div class="stat-icon"><i class="fa-regular fa-hand"></i></div>
      <div class="stat-title">Volunteers</div>
    </div>
  </div>

  <div class="stat-box" style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c');">
    <div class="stat-overlay dark"></div>
    <div class="stat-content">
      <div class="stat-number" id="count2">0</div>
      <div class="stat-icon"><i class="fa-solid fa-ribbon"></i></div>
      <div class="stat-title">Donations Raised</div>
    </div>
  </div>

  <!-- ✅ Updated Houses Provided -->
  <div class="stat-box" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c');">
    <div class="stat-overlay"></div>
    <div class="stat-content">
      <div class="stat-number" id="count3">0</div>
      <div class="stat-icon"><i class="fa-regular fa-house"></i></div>
      <div class="stat-title">Houses Provided</div>
    </div>
  </div>
<script>
// Counter animation
function counter(id, start, end, duration) {
  let obj = document.getElementById(id),
      current = start,
      range = end - start,
      increment = end > start ? 1 : -1,
      step = Math.abs(Math.floor(duration / range)),
      timer = setInterval(() => {
        current += increment;
        obj.textContent = current;
        if (current == end) clearInterval(timer);
      }, step);
}

window.onload = () => {
  counter("count1", 0, 125, 2000);
  counter("count2", 0, 3605, 2000);
  counter("count3", 0, 2025, 2000);
  counter("count4", 0, 180, 2000);
};
</script>

</body>
</html>

<?php $conn->close(); ?>
