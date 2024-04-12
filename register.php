<?php
include('includes/imports.php');
include('includes/header.php');
include('includes/footer-villamor.php');23
?>

<head>
  <link rel="stylesheet" href="css/userAuth.css">
</head>

<body>
  <div id="register">
    <form class="row g-3">
      <h1 id="register-header">Sign Up to Eventify</h1>
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
        <label for="register-date" class="form-label">Date</label>
        <input class="box-form form-control" type="date" id="register-date" name="date" required>
      </div>
      <div id="register-password" class="col-12">
        <label for="inputpassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputpassword" required>
      </div>
      <div class="col-12 d-flex justify-content-center my-5">
        <button type="submit" id="nextBtn" class="btn btn-success">Next</button>
      </div>
    </form>
  </div>

  <script src="js/userAuth.js"></script>
</body>