<?php
include 'getUser.php';
include 'connect.php';


if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $current_user['userid']; 

    // Insert into tblguestlist
    $insert_query = "INSERT INTO tblguestlist (acctid, eventid) VALUES ('$user_id', '$event_id')";
    if(mysqli_query($connection, $insert_query)) {
        // Redirect back to the dashboard after successful insertion
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($connection);
    }
} else {
    echo "Invalid request!";
}
?>
