<?php    
		include 'includes/header.php';
    include 'connect.php';
    include 'readrecords.php';   
		include 'includes/imports.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/createEvent.css">
  </head>
  <body>
    <div id="createEventForm">
      <form class="row g-3">
        <h2 id="createEventForm-header">Create New Event</h2>
        <div class="col-12">
          <label for="newEvent-title" class="form-label">Title</label>
          <input type="text" class="form-control" id="newEvent-title" placeholder="Title" required>
        </div>
        <div class="col-12">
          <label for="newEvent-description" class="form-label">Description</label>
          <input type="text" class="form-control" id="newEvent-description" placeholder="Enter description..." required>
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
          <input type="text" class="form-control" id="newEvent-venue" placeholder="Venue" required>
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Event Type</label>
          <input type="text" class="form-control" id="newEvent-type" placeholder="Event Type">
        </div>
        <div class="col-12 d-flex justify-content-center my-5">
          <button type="submit" id="createEventBtn" class="btn btn-outline-success">Create Event</button>
        </div>
      </form>
    </div>
  </body>
</html>