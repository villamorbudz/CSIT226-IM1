<?php    
    include 'getUser.php';
    include 'connect.php';
    include 'includes/imports.php';

    if($current_user['usertype']=='ADMIN') {
        include('includes/headerAdmin.php');
    }else{
        include('includes/header.php');
    }

    $query1 = 'SELECT * from  tblevent ORDER BY Event_Date ASC, Event_Time ASC, Event_Title ASC';
        $resultset1 = mysqli_query($connection, $query1);

    $query2 = 'SELECT * from  tbluseraccount';
        $resultset2 = mysqli_query($connection, $query2);

    $query3 = "SELECT Event_ID, Event_Title, Event_Description, Event_Date, Event_Time from tblevent where Host_ID={$current_user['userid']} ORDER BY Event_Date ASC, Event_Time ASC, Event_Title ASC";
        $resultset3 = mysqli_query($connection, $query3);

    $query4 = "SELECT e.Event_ID, e.Event_Title, e.Event_Description, e.Event_Date, e.Event_Time 
               FROM tblguestlist g
               JOIN tblevent e ON g.eventid = e.Event_ID
               WHERE g.acctid = {$current_user['userid']}
               ORDER BY e.Event_Date ASC, e.Event_Time ASC, e.Event_Title ASC";
    $resultset4 = mysqli_query($connection, $query4);
    $joinedEvents = mysqli_fetch_all($resultset4, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard | Eventify</title>
        <link rel="stylesheet" href="css/cssDashboard.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/cssLogReg.css">
    </head>

    <body class="bgCustom">
        <div class="dashboard-main">
        <!-- display events that user is part of as a guest-->
        <div class="left-child centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">List of Events you joined</h2> 
            <div>
                <?php if (empty($joinedEvents)): ?>
                    <p class="label-form">You have joined no events yet.</p>
                <?php else: ?>
                    <table id="tblEventsJoined" cellspacing="0" width="100%"> 
                        <thead class="label-form">
                            <tr> 
                                <th class="colHead colB">Event Title</th> 
                                <th class="colHead colA">Event Description</th>
                                <th class="colHead colB">Date</th>
                                <th class="colHead colA">Time</th>
                                <th class="colB"></th>
                                <th class="colA"></th>
                            </tr> 
                        </thead>  
                        <tbody class="label-form">
                            <?php foreach ($joinedEvents as $row): 
                                $id = $row['Event_ID'];
                            ?>
                            <tr>
                                <td class="colB"><?php echo $row['Event_Title'] ?></td>
                                <td class="colA"><?php echo $row['Event_Description'] ?></td>
                                <td class="elemCenter colB"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                                <td class="elemCenter colA"><?php echo date('g:i a', strtotime($row['Event_Time'])) ?></td>
                                <td id="view" class="colB"><a class="btn toUpdate" href="viewEvent.php?event_id=<?php echo $id; ?>">View</a></td>
                                <td class="colA"><a id="cancel" class="btn toUpdate" href="cancelEvent.php?event_id=<?php echo $id ?>">Cancel</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>         
                    </table>
                <?php endif; ?>
            </div>
        </div>
        

        <!-- display all available events -->
        <div class="right-child centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">List of Available Events</h2> 
            <div>
                <table id="tblEventsDashboard" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead colA">Event Title</th> 
                            <th class="colHead colB">Event Description</th>
                            <th class="colHead colA">Date</th>
                            <th class="colHead colB">Time</th>
                            <th class="colHead colA">Event Host</th> 
                            <th class="colB"></th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            while($row = $resultset1->fetch_assoc()):
                                $id = $row['Event_ID'];
                                // Fetching username from the related table based on Host_ID
                                $host_username_query = "SELECT username FROM tbluseraccount WHERE acctid = '".$row['Host_ID']."'";
                                $host_username_result = $connection->query($host_username_query);
                                $host_username_row = $host_username_result->fetch_assoc();
                                $host_username = $host_username_row['username'];

                                // Checking if the username matches the current user's username
                                $display_username = ($current_user['username'] == $host_username) ? "(YOU)" : $host_username;

                                // Check if the event is already joined by the current user
                                $joined_event_ids = array_column($joinedEvents, 'Event_ID');
                                $is_joined = in_array($id, $joined_event_ids);
                        ?>
                        <tr>
                            <td class="colA"><?php echo $row['Event_Title'] ?></td>
                            <td class="colB"><?php echo $row['Event_Description'] ?></td>
                            <td class="elemCenter colA"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                            <td class="elemCenter colB"><?php echo date('g:i a', strtotime($row['Event_Time'])) ?></td>
                            <td class="elemCenter colA"><?php echo $display_username ?></td>
                            <!-- displays "Join Event" button when event's Host_ID is different than the current user id -->
                            <td class="colB">
                                <?php if($current_user['userid'] != $row['Host_ID'] && !$is_joined) { ?>
                                    <a class="btn toUpdate" href="joinEvent.php?event_id=<?php echo $id ?>">Join Event</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>         
                </table>
            </div>
        </div>


        </div>

        <div class="dashboard-main">
        <!-- display events created by user -->
        <div class="left-child centerHorizontallyDiv1 form-bg shadow-box marginTop">
        <h2 class="tableTitle">List of Events you Created</h2> 
        <div>
            <?php if(mysqli_num_rows($resultset3) == 0): ?>
                <p>You have not created any event yet.</p>
            <?php else: ?>
                <table id="tblEventsManaged" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead colB">Event Title</th> 
                            <th class="colHead colA">Event Description</th>
                            <th class="colHead colB">Date</th>
                            <th class="colHead colA">Time</th>
                            <th class="colB"></th>
                            <th class="colA"></th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php while($row = $resultset3->fetch_assoc()): ?>
                            <tr>
                                <td class="colB"><?php echo $row['Event_Title'] ?></td>
                                <td class="colA"><?php echo $row['Event_Description'] ?></td>
                                <td class="elemCenter colB"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                                <td class="elemCenter colA"><?php echo date('g:i a', strtotime($row['Event_Time'])) ?></td>
                                <td class="colB"><a class="btn toUpdate" href="updateEvent.php?event_id=<?php echo $row['Event_ID']; ?>">Edit Event</a></td>
                                <td class="colA"><a id="cancel" class="btn toUpdate" href="deleteEvent.php?event_id=<?php echo $row['Event_ID']; ?>">Delete Event</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>         
                </table>
            <?php endif; ?>
        </div>
    </div>



        <!-- display all users -->
        <div class="centerHorizontallyDiv2 form-bg shadow-box marginTop">
            <h2 class="tableTitle">List of Users</h2> 
            <div>
                <table id="tblUsers" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead">User ID</th> 
                            <th class="colHead">Username</th> 
                            <th class="colHead">Email Address</th>
                            <th class="colHead">Usertype<th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                    <?php
                        while($row = $resultset2->fetch_assoc()):
                            $uid = $row['acctid'];
                    ?>
                    <tr>
                        <td class="elemCenter"><?php echo $uid ?></td>
                        <td class="elemCenter"><?php echo $row['username'] ?></td>
                        <td class="elemCenter"><?php echo $row['emailadd'] ?></td>
                        <td class="elemCenter"><?php echo $row['usertype'] ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>           
                </table>
            </div>
        </div>  
        
        
        </div>

    </body>

    <footer style="position: relative; min-height: 25vh">
        <?php
            include("includes/footerO.php");
        ?>
    </footer>
    
</html>

<?php
    function ordinalSuffix($number) {
        $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if (($number % 100) >= 11 && ($number % 100) <= 13) {
            return $number.'th';
        } else {
            return $number.$suffix[$number % 10];
        }
    }
?>