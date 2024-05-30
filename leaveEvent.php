<?php
include 'getUser.php';
include 'connect.php';


if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $current_user['userid']; // Assuming $current_user is accessible in this file.

    // Delete the corresponding row from tblguestlist.
    $delete_query = "DELETE FROM tblguestlist WHERE eventid = $event_id AND acctid = $user_id";
    $delete_result = mysqli_query($connection, $delete_query);

    if ($delete_result) {
        // Row deleted successfully.
        header("Location: dashboard.php"); // Redirect back to the dashboard or wherever appropriate.
        exit();
    } else {
        // Error occurred while deleting the row.
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // Redirect or handle the case where event_id is not set.
}
?>
