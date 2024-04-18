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
      <h1 id="header">Sign Up to Eventify</h1>
      <div class="col-md-6">
        <label for="register-firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="register-firstName" placeholder="First Name" required>
      </div>
      <div class="col md-6">
        <label for="register-lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="register-lastName" placeholder="Last Name" required>
      </div>
      <div class="col-12">
        <label for="register-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="register-username" placeholder="Username" required>
      </div>
      <div class="col-12">
        <label for="inputEmail" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="inputEmail" placeholder="name@domain.com" required>
      </div>
      <div class="col md-6">
        <label for="register-birthdate" class="form-label">Birthdate</label>
        <input class="box-form form-control" type="date" id="register-birthdate" name="date" required>
      </div>
      <div id="register-password" class="col-12">
        <label for="inputpassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputpassword" placeholder="Password" required>
      </div>
      <div class="col-12 d-flex justify-content-center my-5">
        <button type="submit" id="nextBtn" class="btn btn-success">Sign Up</button>
      </div>
    </form>
    <div class="redirect">
      <hr>
      <span>Already have an account?</span>
      <a href="login.php">Log in</a>
    </div>
  </div>

<?php
    include('includes/footer-villamor.php');
?>

  <script src="js/userAuth.js"></script>
</body>
</html>