<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    
     /* Main heading */
    h1.page-title {
  text-align: left;        /* left align */
  font-size: 28px;
  font-weight: bold;
  margin: 20px auto 20px;  
  color: rgb(71, 176, 189);
  letter-spacing: 2px;
  max-width: 1200px;       /* container ki width jitna */
  padding: 0 15px;         /* container ke left-right gap jitna */
}


    .container {
      display: grid;
      grid-template-columns: 3fr 1fr;
      gap: 20px;
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 15px;
    }
    .events {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      color:rgb(76, 78, 103);
    }
    .event-card {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    .event-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .event-content {
      padding: 15px;
      position: relative;
    }
    .event-date {
      position: absolute;
      top: -35px;
      left: 15px;
      background: #4bc5c9ff;
      color: #fff;
      text-align: center;
      border-radius: 5px;
      padding: 5px 10px;
    }
    .event-date span {
      display: block;
      font-size: 14px;
    }
    .event-date strong {
      font-size: 18px;
    }
    .event-title {
      font-size: 18px;
      font-weight: bold;
      margin: 15px 0 10px;
    }
    .event-meta {
      font-size: 14px;
      color:rgb(76, 78, 103);
    }
    .event-meta i {
      margin-right: 6px;
      color: #4bc5c9ff;
    }

    /* Sidebar */
    .sidebar {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      color:rgb(76, 78, 103);
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    .sidebar h3 {
      font-size: 18px;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 5px;
    }
    .filter-option {
      margin: 10px 0;
    }
    .filter-option input {
      margin-right: 5px;
    }
    .sidebar input, .sidebar select {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .sidebar button {
      width: 100%;
      background: #4bc5c9ff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }
    .sidebar button:hover {
      background: #4bc5c9ff;
    }

    /* Upcoming Events */
    .upcoming {
      margin-top: 30px;
      color:rgb(76, 78, 103);
    }
    .upcoming h3 {
      font-size: 18px;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 5px;
    }
    .upcoming img {
      width: 100%;
      border-radius: 8px;
    }
  </style>
</head>
<body>
    <h1 class="page-title" style=text-align:center;>Event</h1>
  <div class="container">
    <!-- Events Grid -->
     
    <div class="events">
      <!-- Event 1 -->
      <div class="event-card">
        <img src="image/event1.jpg" alt="Run for Cancer People">
        <div class="event-content">
          <div class="event-date">
            <strong>21</strong>
            <span>Mar 2017</span>
          </div>
          <div class="event-title">Run for Cancer People</div>
          <div class="event-meta"><i class="fa-solid fa-clock"></i> Started On: 09:30pm</div>
          <div class="event-meta"><i class="fa-solid fa-location-dot"></i> New Grand Street, California</div>
        </div>
      </div>

      <!-- Event 2 -->
      <div class="event-card">
        <img src="image/event2.jpg" alt="Providing Water for Farmers">
        <div class="event-content">
          <div class="event-date" style="background:#4bc5c9ff;">
            <strong>14</strong>
            <span>Apr 2017</span>
          </div>
          <div class="event-title">Providing Water for Farmers</div>
          <div class="event-meta"><i class="fa-solid fa-clock"></i> Started On: 09:30pm</div>
          <div class="event-meta"><i class="fa-solid fa-location-dot"></i> Tottenham Court Road, London</div>
        </div>
      </div>

      <!-- Event 3 -->
      <div class="event-card">
        <img src="image/event3.jpg" alt="Humanity Trailwalker">
        <div class="event-content">
          <div class="event-date" style="background:#4bc5c9ff;">
            <strong>18</strong>
            <span>May 2017</span>
          </div>
          <div class="event-title">Humanity Trailwalker</div>
          <div class="event-meta"><i class="fa-solid fa-clock"></i> Started On: 09:30pm</div>
          <div class="event-meta"><i class="fa-solid fa-location-dot"></i> New Grand Street, California</div>
        </div>
      </div>

      <!-- Event 4 -->
      <div class="event-card">
        <img src="image/event4.jpg" alt="Mini-Golf Fundraiser">
        <div class="event-content">
          <div class="event-date" style="background:#4bc5c9ff;">
            <strong>10</strong>
            <span>Jun 2017</span>
          </div>
          <div class="event-title">Mini-Golf Fundraiser</div>
          <div class="event-meta"><i class="fa-solid fa-clock"></i> Started On: 09:30pm</div>
          <div class="event-meta"><i class="fa-solid fa-location-dot"></i> Tottenham Court Road, London</div>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div>
      <div class="sidebar">
        <h3>EVENT FILTER</h3>
        <div class="filter-option">
  <label>
    <input type="radio" name="filter" value="all" checked> All
  </label>
  <label>
    <input type="radio" name="filter" value="upcoming"> Upcoming
  </label>
</div>

        <select>
          <option>Select venue</option>
          <option>Rajkot</option>
          <option>Jamnagar</option>
          <option>Ahemdabad</option>
          <option>Surat</option>
        </select>
        <input type="date">
        <input type="text" placeholder="Search...">
        <button>SEND MESSAGE</button>
      </div>

      <div class="upcoming">
        <h3>UPCOMING EVENTS</h3>
        <img src="image/event5.jpg" alt="Upcoming Event">
      </div>
    </div>
  </div>
</body>
</html>
