<?php
include('includes/imports.php');
include('includes/header.php');
?>

<html data-bs-theme="dark">
<head>
  <link rel="stylesheet" href="css/userAuth.css">
</head>

<body>
  <div class="form-container">
    <form class="row g-3">
      <h1 id="header">Log in to Eventify</h1>
      <div class="col-12">
        <label for="inputEmail" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="inputEmail" placeholder="name@domain.com" required>
      </div>
      <div id="login-password" class="col-12">
        <label for="inputpassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputpassword" placeholder="Password" required>
      </div>
      <div class="col-12 d-flex justify-content-center my-5">
        <button type="submit" id="nextBtn" class="btn btn-success">Log In</button>
      </div>
    </form>
    <div class="redirect">
      <hr>
      <span>Don't have an account?</span>
      <a href="register.php">Sign Up</a>
    </div>
  </div>
  <?php
    include('includes/footer-villamor.php');
  ?>
  
  <script src="js/userAuth.js"></script>
</body>
</html>