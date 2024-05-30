<?php
include('includes/header-noLogged.php');
include('includes/footer.php');
include('includes/imports.php');
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['adminFiel'])) {
        $adminUserId = 1;
    } elseif (isset($_POST['adminGiles'])) {
        $adminUserId = 2;
    } else {
        exit("Invalid request");
    }

    $username = $_POST['username'];

    $sql = "SELECT active FROM tbluseraccount WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && $row['active'] == 1) {
        echo "<script>alert('Your account is not deactivated');</script>";
    } else {
        // Prepare a SQL statement to select the user from tbluseraccount
        $sql = "SELECT * FROM tblreactivate WHERE acctid IN (SELECT acctid FROM tbluseraccount WHERE username = '$username')";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('A request for reactivation is already pending');</script>";
        } else {
            // Prepare a SQL statement to select the user from tbluseraccount
            $sql1 = "SELECT acctid FROM tbluseraccount WHERE username = '$username'";
            $result1 = mysqli_query($connection, $sql1);

            // Check if user is found
            if (mysqli_num_rows($result1) > 0) {
                $user = mysqli_fetch_assoc($result1);
                // Insert into tblreactivate
                $sql2 = "INSERT INTO tblreactivate (adminid, acctid) VALUES ('$adminUserId', '{$user['acctid']}')";
                if (mysqli_query($connection, $sql2)) {
                    // Display a popup message in the browser using JavaScript
                    echo "<script>alert('Reactivation Request has been filed successfully');</script>";
                    // You can redirect user to a success page if needed
                } else {
                    echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
                }
            } else {
                echo "User not found.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="css/cssLogReg.css" rel="stylesheet" />
  <title>Reactivate Request | Eventify</title>
</head>

<body class="bgCustom">
    <div class="center form-bg shadow-box padding10">
        <h2 class="div-center headerDiv marginBottom10">Request Reactivation for your Account</h2>
        <form method="post" class="form-container">
            <div class="flex-wrapper1">
                <label for="username" class="vertical-center">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <br>
            <div class="flex-wrapper2">
                <button id="btn" class="centerButton" type="submit" name="adminFiel">adminFiel</button>
                <button id="btn" class="centerButton" type="submit" name="adminGiles">adminGiles</button>
            </div>                
        </form>
    </div> 
</body>


</html>