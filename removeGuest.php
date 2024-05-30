<?php
echo "Script is being executed.";
// Include necessary files and connect to the database
include 'getUser.php';
include 'connect.php';

// Check if guest_id and event_id are set in the URL parameters
if (isset($_GET['guest_id']) && isset($_GET['event_id'])) {
    // Retrieve guest_id and event_id from the URL parameters
    $guestId = $_GET['guest_id'];
    $eventId = $_GET['event_id'];

    // Delete the guest with the specified guest_id for the given event_id
    $query = "DELETE FROM tblguestlist WHERE acctid = $guestId AND eventid = $eventId";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        // Redirect back to the updateEvent.php page with the event_id parameter
        header("Location: updateEvent.php?event_id=$eventId");
        exit();
    } else {
        // Handle any errors that occur during the query execution
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // Handle the case when guest_id or event_id is not set in the URL parameters
    echo "Guest ID or Event ID not provided.";
}
?>
