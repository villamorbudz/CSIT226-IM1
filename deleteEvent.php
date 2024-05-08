<?php
include 'connect.php';

if(isset($_GET['event_id'])) {
    $event_id = mysqli_real_escape_string($connection, $_GET['event_id']);

    // Construct the SQL DELETE query
    $query = "DELETE FROM tblevent WHERE Event_ID = '$event_id'";

    if(mysqli_query($connection, $query)) {
        // Event deleted successfully
        header('Location: dashboard.php'); 
        exit();
    } else {
        // Error occurred while deleting the event
        echo "Error deleting event: " . mysqli_error($connection);
    }
} else {
    // Event ID not provided in URL parameters
    echo "Event ID not provided.";
}
?>
