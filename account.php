<?php
include('getUser.php');
include('connect.php');
if($current_user['usertype']=='ADMIN') {
    include('includes/headerAdmin.php');
}else{
    include('includes/header.php');
}
include('includes/footer.php');
include('includes/imports.php');

if (!$current_user) {
    header('Location: index.php'); // Redirect to home if the user is not logged in
    exit();
}

// Handle form submission after confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmed']) && $_POST['confirmed'] == 'true') {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        // Update user details in the database
        $query = "UPDATE tbluseraccount SET username='$username', emailadd='$email' WHERE acctid='$current_user[userid]'";

        if (mysqli_query($connection, $query)) {
            echo "<script>
                    alert('Account details updated successfully');
                    window.location.href = 'account.php';
                  </script>";
            // Update session variables
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            // Make sure the script stops after the redirection
            exit(); 
        } else {
            echo "<script>alert('Error updating account details: " . mysqli_error($connection) . "');</script>";
        }
    } elseif (isset($_POST['delete_confirmed']) && $_POST['delete_confirmed'] == 'true') {
        // Handle account deletion
        $query = "UPDATE tbluseraccount SET active='0' WHERE acctid='$current_user[userid]'";

        if (mysqli_query($connection, $query)) {
            // Destroy the session and redirect to the home page
            session_destroy();
            echo "<script>
                    alert('Account deleted successfully');
                    window.location.href = 'index.php';
                  </script>";
            // Make sure the script stops after the redirection
            exit(); 
        } else {
            echo "<script>alert('Error deleting account: " . mysqli_error($connection) . "');</script>";
        }
    }
}

// Retrieve current user details
$query = "SELECT username, emailadd FROM tbluseraccount WHERE acctid='$current_user[userid]'";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error retrieving user details: " . mysqli_error($connection);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/index.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/createEvent.css">
    <title>Account | Eventify</title>
</head>

<body>
    <div class="container">
        <h2>Update Account Details</h2>
        <form id="updateForm" method="post">
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['emailadd']); ?>" required>
            </div>
            <input type="hidden" name="confirmed" id="confirmed" value="false">
            <input type="hidden" name="delete_confirmed" id="delete_confirmed" value="false">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Update</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Deactivate Account</button>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are the following details correct?
                    <ul>
                        <li>Username: <span id="confirmUsername"></span></li>
                        <li>Email: <span id="confirmEmail"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Yes, Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Account Deactivation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to deactivate your account? To reactive your account, you need to contact an Admin.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteConfirmBtn">Yes, Deactivate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelector('button[data-target="#confirmModal"]').addEventListener('click', function () {
            document.getElementById('confirmUsername').innerText = document.getElementById('username').value;
            document.getElementById('confirmEmail').innerText = document.getElementById('email').value;
        });

        document.getElementById('confirmBtn').addEventListener('click', function () {
            document.getElementById('confirmed').value = 'true';
            document.getElementById('updateForm').submit();
        });

        document.getElementById('deleteConfirmBtn').addEventListener('click', function () {
            document.getElementById('delete_confirmed').value = 'true';
            document.getElementById('updateForm').submit();
        });
    </script>
</body>

</html>
