<?php    
    include 'getUser.php';
    if($current_user['usertype']=='ADMIN') {
        include('includes/headerAdmin.php');
    }else{
        include('includes/header.php');
    }
    include 'connect.php';
    include 'includes/imports.php';

    $query1 = 'SELECT * from  tblevent';
        $resultset1 = mysqli_query($connection, $query1);

    $query2 = 'SELECT * from  tbluseraccount';
        $resultset2 = mysqli_query($connection, $query2);

    $query3 = "SELECT Event_ID, Event_Title, Event_Description, Event_Date, Event_Time from tblevent where Host_ID={$current_user['userid']}";
        $resultset3 = mysqli_query($connection, $query3);
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
        <!-- display events created by user -->
        <div class="left-child centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">List of Events you Created</h2> 
            <div>
                <table id="tblEventsManaged" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead colA">Event ID</th> 
                            <th class="colHead colB">Event Title</th> 
                            <th class="colHead colA">Event Description</th>
                            <th class="colHead colB">Date</th>
                            <th class="colHead colA">Time</th>
                            <th class="colB"></th>
                            <th class="colA"></th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            while($row = $resultset3->fetch_assoc()):
                                $id = $row['Event_ID'];
                        ?>
                        <tr>
                            <td class="elemCenter colA"><?php echo $id ?></td>
                            <td class="colB"><?php echo $row['Event_Title'] ?></td>
                            <td class="colA"><?php echo $row['Event_Description'] ?></td>
                            <td class="elemCenter colB"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                            <td class="elemCenter colA"><?php echo date('g:i a', strtotime($row['Event_Time'])) ?></td>
                            <td class="colB"><a class="btn toUpdate" href="updateEvent.php?event_id=<?php echo $id; ?>">Edit Event</a></td>
                            <td class="colA"><a class="btn toUpdate" href="deleteEvent.php?event_id=<?php echo $id ?>">Delete Event</a></td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>         
                </table>
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
                            <th class="colHead colA">Event Host ID</th>
                            <th class="colB"></th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            while($row = $resultset1->fetch_assoc()):
                                $id = $row['Event_ID'];
                        ?>
                        <tr>
                            <td class="colA"><?php echo $row['Event_Title'] ?></td>
                            <td class="colB"><?php echo $row['Event_Description'] ?></td>
                            <td class="elemCenter colA"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                            <td class="elemCenter colB"><?php echo date('g:i a', strtotime($row['Event_Time'])) ?></td>
                            <td class="elemCenter colA"><?php echo $row['Host_ID'] ?></td>
                            <!-- displays "Join Event" button when event's Host_ID is different than the currentuser id -->
                            <td class="colB">
                            <?php if($current_user['userid'] != $row['Host_ID']) { ?>
                                <a class="btn toUpdate" href="#">Join Event</a>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>         
                </table>
            </div>
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