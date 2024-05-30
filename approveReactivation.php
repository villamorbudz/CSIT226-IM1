<?php
include('getUser.php');
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if acctid is set in the POST request
    if (isset($_POST['acctid'])) {
        // Get acctid from the POST request
        $acctid = $_POST['acctid'];

        // Update isActive value in tbluseraccount table
        $sqlUpdate = "UPDATE tbluseraccount SET active = 1 WHERE acctid = $acctid";

        if (mysqli_query($connection, $sqlUpdate)) {
            // Delete the corresponding row from tblreactivate
            $sqlDelete = "DELETE FROM tblreactivate WHERE acctid = $acctid";

            if (mysqli_query($connection, $sqlDelete)) {
                echo "<script>
                        alert('Account reactivated successfully');
                        window.location.href = 'reactivation.php';
                    </script>";
                // Make sure the script stops after the redirection
                exit(); 
            } else {
                echo "Error deleting reactivation request: " . mysqli_error($connection);
            }
        } else {
            echo "Error updating user status: " . mysqli_error($connection);
        }
    } else {
        echo "Acctid not provided.";
    }
}
?>
