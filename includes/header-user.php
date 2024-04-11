<?php
include('imports.php');
?>

<head>
  <link rel="stylesheet" href="css/header.css" />
</head>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand mx-3 my-1" href="index.php">
      <img src="images/eventify-logo-banner.png" alt="" width="175" class="d-inline-block align-text-center" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNav" class="navbar mx-5">
      <ul id="loggedIn" class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="createEvent.php">Create Event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <p class="nav-link">|</p>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="btn dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Profile </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Account</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="index.php">Log Out</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>
  <script src="js/index.js"></script>
</body>