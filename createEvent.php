<?php    
    include 'getUser.php';
    if($current_user['usertype']=='ADMIN') {
      include('includes/headerAdmin.php');
    }else{
      include('includes/header.php');
    }
		include 'includes/imports.php';
<<<<<<< HEAD
    include 'connect.php';



    if(isset($_POST['btnCreateEvent'])){		

      $eventTitle = $_POST['txteventtitle'];
      $eventDescription = $_POST['txteventdesc'];
      $eventDate = $_POST['date'];
      $eventTime = $_POST['time'];
      $eventVenue = $_POST['txteventvenue'];
      $eventType = $_POST['txteventtype'];

      $query = 'SELECT * from  tbluseraccount';
      $resultset = mysqli_query($connection, $query);

        while($row = $resultset->fetch_assoc()) {
          $id = $row['acctid'];
        }

      $sql ="Insert into tblevent(Event_Title,Event_Description,Event_Date,Event_Time,Event_Venue,Event_Type,Host_ID) values('".$eventTitle."','".$eventDescription."','".$eventDate."','".$eventTime."','".$eventVenue."','".$eventType."','".$current_user['userid']."')";
      mysqli_query($connection,$sql);
        
    }
=======
    include 'includes/footerV.php';
>>>>>>> 539b287df6f9cdbbc390a066884f2c5448cff985
?>

<!DOCTYPE html>
<html>
  <head>
  <title>Create Event | Eventify</title>
    <link rel="stylesheet" href="css/createEvent.css">
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
  </body>

  <footer style="position: relative; min-height: 25vh">
    <?php
        include("includes/footerO.php");
    ?>
  </footer>
</html>