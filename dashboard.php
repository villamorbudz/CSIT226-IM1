<?php    
    include 'connect.php';
    include 'includes/imports.php';
    require_once 'includes/header.php';

    $query1 = 'SELECT * from  tblevent';
        $resultset1 = mysqli_query($connection, $query1);

    $query2 = 'SELECT * from  tbluseraccount';
        $resultset2 = mysqli_query($connection, $query2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard | Eventify</title>
        <link rel="stylesheet" href="css/cssLogReg.css">
        <link rel="stylesheet" href="css/cssDashboard.css">
    </head>

    <body class="bgCustom">
        <div class="centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">List of Available Events</h2> 
            <div>
                <table id="tblEventsDashboard" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead">Event ID</th> 
                            <th class="colHead">Event Title</th> 
                            <th class="colHead">Event Description</th>
                            <th class="colHead">Date</th>
                            <th class="colHead">Time</th>
                            <th class="colHead">Event Host ID</th>
                            <th></th>
                            <th></th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            while($row = $resultset1->fetch_assoc()):
                                $id = $row['Event_ID'];
                        ?>
                        <tr>
                            <td class="elemCenter"><?php echo $id ?></td>
                            <td><?php echo $row['Event_Title'] ?></td>
                            <td><?php echo $row['Event_Description'] ?></td>
                            <td class="elemCenter"><?php echo $row['Event_Date'] ?></td>
                            <td class="elemCenter"><?php echo $row['Event_Time'] ?></td>
                            <td class="elemCenter"><?php echo $row['Host_ID'] ?></td>
                            <td><a class="toUpdate" href="updateEvent.php">Edit Event</a></td>
                            <td><a class="toUpdate" href="deleteEvent.php">Delete Event</a></td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>         
                </table>
            </div>
        </div>

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
        
    </footer>
    <?php
            include("includes/footerO.php");
        ?>
    
</html>