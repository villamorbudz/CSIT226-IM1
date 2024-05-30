<?php    
    include 'getUser.php';
    if($current_user['usertype']=='ADMIN') {
      include('includes/headerAdmin.php');
    } else {
      include('includes/header.php');
    }
    include 'includes/imports.php';
    include 'connect.php';

    $eventCreated = false;

    if(isset($_POST['btnCreateEvent'])) {      
      $eventTitle = $_POST['txteventtitle'];
      $eventDescription = $_POST['txteventdesc'];
      $eventDate = $_POST['date'];
      $eventTime = $_POST['time'];
      $eventVenue = $_POST['txteventvenue'];
      $eventType = $_POST['txteventtype'];

      $sql = "INSERT INTO tblevent (Event_Title, Event_Description, Event_Date, Event_Time, Event_Venue, Event_Type, Host_ID) VALUES ('$eventTitle', '$eventDescription', '$eventDate', '$eventTime', '$eventVenue', '$eventType', '".$current_user['userid']."')";
      mysqli_query($connection, $sql);

      $eventCreated = true;
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Event | Eventify</title>
  <link rel="stylesheet" href="css/createEvent.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="createEventForm">
    <form class="row g-3" method="post">
      <h2 id="createEventForm-header">Create New Event</h2>
      <div class="col-12">
        <label for="newEvent-title" class="form-label">Title</label>
        <input type="text" class="form-control" id="newEvent-title" name="txteventtitle" placeholder="Title" required>
      </div>
      <div class="col-12">
        <label for="newEvent-description" class="form-label">Description</label>
        <input type="text" class="form-control" id="newEvent-description" name="txteventdesc" placeholder="Enter description..." required>
      </div>
      <div class="col md-6">
        <label for="newEvent-date" class="form-label">Date</label>
        <input class="box-form form-control" type="date" id="newEvent-date" name="date" required>
      </div>
      <div class="col md-6">
        <label for="newEvent-time" class="form-label">Time</label>
        <input class="box-form form-control" type="time" id="newEvent-time" name="time" required>
      </div>
      <div class="col-12">
        <label for="newEvent-venue" class="form-label">Venue</label>
        <input type="text" class="form-control" id="newEvent-venue" name="txteventvenue" placeholder="Venue" required>
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">Event Type</label>
        <input type="text" class="form-control" id="newEvent-type" name="txteventtype" placeholder="Event Type">
      </div>
      <div class="col-12 d-flex justify-content-center my-5">
        <button type="submit" name="btnCreateEvent" id="createEventBtn" class="btn btn-outline-success">Create Event</button>
      </div>
    </form>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          The event was successfully created!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer style="position: relative; min-height: 25vh">
    <?php
        include("includes/footerO.php");
    ?>
  </footer>

  <?php if ($eventCreated): ?>
    <script>
      $(document).ready(function() {
        $('#successModal').modal('show');

        // Redirect to dashboard when the close button is clicked
        $('#closeModalBtn, .btn-close').on('click', function() {
          window.location.href = 'dashboard.php';
        });
      });
    </script>
  <?php endif; ?>
</body>
</html>
