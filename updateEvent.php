<?php
  include 'getUser.php';
  if($current_user['usertype']=='ADMIN') {
    include('includes/headerAdmin.php');
  }else{
    include('includes/header.php');
  }
  include 'includes/imports.php';
  include 'connect.php';

if(isset($_GET['event_id'])) {
    $event_id = mysqli_real_escape_string($connection, $_GET['event_id']);

    // Retrieve the event details from the database
    $query = "SELECT * FROM tblevent WHERE Event_ID = '$event_id'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0) {
        // Event found, pre-populate the edit form with event details
        $event = mysqli_fetch_assoc($result);
    } else {
        // Event not found
        echo "Event not found.";
        exit();
    }
} else {
    // Event ID not provided in URL parameters
    echo "Event ID not provided.";
    exit();
}

// Handle form submission to update event details
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated event details from form fields
    $event_title = mysqli_real_escape_string($connection, $_POST['txteventtitle']);
    $event_description = mysqli_real_escape_string($connection, $_POST['txteventdesc']);
    $event_date = mysqli_real_escape_string($connection, $_POST['date']);
    $event_time = mysqli_real_escape_string($connection, $_POST['time']);
    $event_venue = mysqli_real_escape_string($connection, $_POST['txteventvenue']);
    $event_type = mysqli_real_escape_string($connection, $_POST['txteventtype']);

    // Construct the SQL UPDATE query
    $query = "UPDATE tblevent SET Event_Title='$event_title', Event_Description='$event_description', Event_Date='$event_date', Event_Time='$event_time', Event_Venue='$event_venue', Event_Type='$event_type' WHERE Event_ID = '$event_id'";

    if(mysqli_query($connection, $query)) {
        echo "<script>localStorage.setItem('updateSuccess', 'true'); window.location.href='updateEvent.php?event_id=$event_id';</script>";
        exit();
    } else {
        echo "Error updating event: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Event | Eventify</title>
    <link rel="stylesheet" href="css/createEvent.css">
    <!-- Add Bootstrap CSS for the modal dialog -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div id="createEventForm">
        <form class="row g-3" method="post" id="updateEventForm">
            <h2 id="createEventForm-header">Update Event</h2>
            <div class="col-12">
                <label for="newEvent-title" class="form-label">Title</label>
                <input type="text" class="form-control" id="newEvent-title" name="txteventtitle" placeholder="Title" value="<?php echo $event['Event_Title']; ?>" required>
            </div>
            <div class="col-12">
                <label for="newEvent-description" class="form-label">Description</label>
                <input type="text" class="form-control" id="newEvent-description" name="txteventdesc" placeholder="Enter description..." value="<?php echo $event['Event_Description']; ?>" required>
            </div>
            <div class="col md-6">
                <label for="newEvent-date" class="form-label">Date</label>
                <input class="box-form form-control" type="date" id="newEvent-date" name="date" value="<?php echo $event['Event_Date']; ?>" required>
            </div>
            <div class="col md-6">
                <label for="newEvent-time" class="form-label">Time</label>
                <input class="box-form form-control" type="time" id="newEvent-time" name="time" value="<?php echo $event['Event_Time']; ?>" required>
            </div>
            <div class="col-12">
                <label for="newEvent-venue" class="form-label">Venue</label>
                <input type="text" class="form-control" id="newEvent-venue" name="txteventvenue" placeholder="Venue" value="<?php echo $event['Event_Venue']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Event Type</label>
                <input type="text" class="form-control" id="newEvent-type" name="txteventtype" placeholder="Event Type" value="<?php echo $event['Event_Type']; ?>" required>
            </div>
            <div class="col-12 d-flex justify-content-center my-5">
                <button type="button" name="btnCreateEvent" id="createEventBtn" class="btn btn-outline-success" data-toggle="modal" data-target="#confirmationModal">Confirm Update</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are the following details correct?
                    <ul>
                        <li>Title: <span id="confirm-title"></span></li>
                        <li>Description: <span id="confirm-description"></span></li>
                        <li>Date: <span id="confirm-date"></span></li>
                        <li>Time: <span id="confirm-time"></span></li>
                        <li>Venue: <span id="confirm-venue"></span></li>
                        <li>Type: <span id="confirm-type"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmUpdateBtn">Continue Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('createEventBtn').addEventListener('click', function() {
            document.getElementById('confirm-title').textContent = document.getElementById('newEvent-title').value;
            document.getElementById('confirm-description').textContent = document.getElementById('newEvent-description').value;
            document.getElementById('confirm-date').textContent = document.getElementById('newEvent-date').value;
            document.getElementById('confirm-time').textContent = document.getElementById('newEvent-time').value;
            document.getElementById('confirm-venue').textContent = document.getElementById('newEvent-venue').value;
            document.getElementById('confirm-type').textContent = document.getElementById('newEvent-type').value;
        });

        document.getElementById('confirmUpdateBtn').addEventListener('click', function() {
            document.getElementById('updateEventForm').submit();
        });

        window.onload = function() {
            if (localStorage.getItem('updateSuccess') === 'true') {
                localStorage.removeItem('updateSuccess');
                alert('Event Successfully Updated');
                window.location.href = 'dashboard.php';
            }
        };
    </script>
</body>
<footer style="position: relative; min-height: 25vh">
    <?php
        include("includes/footerO.php");
    ?>
</footer>
</html>
