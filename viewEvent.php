<?php
include 'getUser.php';
include 'connect.php';
include 'includes/imports.php';


if ($current_user['usertype'] == 'ADMIN') {
    include('includes/headerAdmin.php');
} else {
    include('includes/header.php');
}


include("includes/footerO.php");

// Function to get event details using mysqli
function getEventDetails($eventId, $connection) {
    $stmt = $connection->prepare('SELECT * FROM tblevent WHERE Event_ID = ?');
    $stmt->bind_param('i', $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to get host details by user_id
function getHostDetails($userId, $connection) {
    $stmt = $connection->prepare('SELECT username, emailadd FROM tbluseraccount WHERE acctid = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to delete guest list entry
function deleteGuestListEntry($eventId, $userId, $connection) {
    $stmt = $connection->prepare('DELETE FROM tblguestlist WHERE eventid = ? AND acctid = ?');
    $stmt->bind_param('ii', $eventId, $userId);
    $stmt->execute();
    return $stmt->affected_rows;
}

// Check if event_id is set
if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];

    // Fetch event details
    $event = getEventDetails($eventId, $connection);

    if ($event) {
        // Event found
        $eventTitle = htmlspecialchars($event['Event_Title']);
        $eventDescription = htmlspecialchars($event['Event_Description']);
        $eventDate = date('F j, Y', strtotime($event['Event_Date']));
        $eventTime = date('g:i a', strtotime($event['Event_Time']));

        // Fetch user_id (assuming it's the host's user ID) of the event being viewed
        $userId = $event['Host_ID'];

        // Fetch host details
        $hostDetails = getHostDetails($userId, $connection);
    } else {
        // Event not found
        $error = "Event not found.";
    }
} else {
    // No event_id provided
    $error = "No event ID provided.";
}

// Handle Leave Event button click
if (isset($_GET['leave_event'])) {
    $userId = $current_user['userid'];
    // Delete guest list entry
    $deletedRows = deleteGuestListEntry($eventId, $userId, $connection);
    if ($deletedRows > 0) {
        // Redirect to some page or display a message indicating successful deletion
        header("Location: index-logged.php");
        exit();
    } else {
        // Error handling if deletion failed
        $error = "Failed to leave the event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event</title>
    <link rel="stylesheet" href="css/cssDashboard.css">
    <link rel="stylesheet" href="css/cssViewEvent.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bgCustom">
    <div class="center-div">

    <!-- display event details -->
    <div class="dashboard-main">
        <div class="left-child">
            <div class="marginTop1 form-bg" id="eventDetails">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php else: ?>
                <h2 class="childTitle">Event Details</h2>
                <p><strong>Host:</strong> <?php echo $hostDetails['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $hostDetails['emailadd']; ?></p>
                <p><strong>Title:</strong> <?php echo $eventTitle; ?></p>
                <p><strong>Description:</strong> <?php echo $eventDescription; ?></p>
                <p><strong>Date:</strong> <?php echo $eventDate; ?></p>
                <p><strong>Time:</strong> <?php echo $eventTime; ?></p>
            <?php endif; ?>
            <a class="btn toUpdate" href="leaveEvent.php?event_id=<?php echo $eventId; ?>">Leave Event</a>
            </div>
        </div>

        <div class="right-child">
            <div class="marginTop1 form-bg" id="hostDetails">
                <h2 class="childTitle">You are cordially invited!</h2>
                <p>Good Day fellow <span id="spanWebName">Eventify</span> user, I, 
                <?php if (isset($hostDetails)): ?>
                    <span id="spanHostName"><?php echo $hostDetails['username']; ?></span>
                <?php else: ?>
                    <p>Host details not found.</p>
                <?php endif; ?>
                , am happy to let you know that you are invited to the event I am hosting.
                </p>
            </div>
        </div>

    </div>

    </div>  

</body>

<!-- <footer style="position: relative; min-height: 20vh">
    <?php
        include("includes/footerO.php");
    ?>
</footer> -->

</html>
