<?php    
    include 'connect.php';
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
        <link rel="stylesheet" href="css/cssDashboard.css">
        
    </head>

    <body>
        <div style='background-color:#ffff00'>
            <center>
                <p style="color:white"><h2>List of Available Events</h2></p>
            </center>
        </div>

        <div>        
            <table id="tblEventsDashboard" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>Event ID</th> 
                        <th>Event Title</th> 
                        <th>Event Description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Event Host</th>
                    </tr> 
                </thead>  
                <tbody>
                    <?php
                        while($row = $resultset1->fetch_assoc()):
                            $id = $row['Event_ID'];
                    ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $row['Event_Title'] ?></td>
                        <td><?php echo $row['Event_Description'] ?></td>
                        <td><?php echo $row['Event_Date'] ?></td>
                        <td><?php echo $row['Event_Time'] ?></td>
                        <td><?php echo $row['Host_ID'] ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>         
            </table>
        </div>

        <div style='background-color:#ffff00'>
            <center>
                <p style="color:white"><h2>List of Users</h2></p>
            </center>
        </div>

        <div>        
            <table id="tblUsers" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>User ID</th> 
                        <th>Username</th> 
                        <th>Email Address</th>
                    </tr> 
                </thead>  
                <tbody>
                    <?php
                        while($row = $resultset2->fetch_assoc()):
                            $uid = $row['acctid'];
                    ?>
                    <tr>
                        <td><?php echo $uid ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['emailadd'] ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>         
            </table>
        </div>
    </body>

    <footer style="position: relative; min-height: 25vh">
        
    </footer>
    <?php
            include("includes/footerO.php");
        ?>
    
</html>