<?php    
    include 'getUser.php';
    include 'connect.php';
    include 'includes/imports.php';
    require_once 'includes/headerAdmin.php';

    $query1 = "SELECT userid, firstname, lastname, gender from  tbluserprofile where firstname like '%i%' and lastname like '%a%' and gender='MALE'";
        $resultset1 = mysqli_query($connection, $query1);

    // $query2 = "SELECT acctid, username, COUNT(Host_ID) as event_count from tbluseraccount, tblevent where Host_ID=acctid group by acctid";

    $query2 = "SELECT acctid, username, COUNT(Host_ID) as event_count from tbluseraccount left join tblevent on acctid=Host_ID group by acctid"; 
        $resultset2 = mysqli_query($connection, $query2);

    $query3 = "SELECT Event_Date, COUNT(Event_Date) as num_events from tblevent group by Event_Date order by num_events desc limit 3";
        $resultset3 = mysqli_query($connection, $query3);
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

        <!-- display number of events each user has -->
        <div class="centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">Report for Number of Events each User has</h2> 
            <div>
                <table id="tblNumberEvents" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead">User ID</th>
                            <th class="colHead">Username</th> 
                            <th class="colHead">Count</th> 
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                        while ($row = mysqli_fetch_assoc($resultset2)):
                            $userID = $row['acctid'];
                            $username = $row['username'];
                            $count = ($row['event_count'] == null) ? 0 : $row['event_count'];
                        ?>
                        <tr>
                            <td class="elemCenter"><?php echo $userID ?></td>
                            <td class="elemCenter"><?php echo $username ?></td>
                            <td class="elemCenter"><?php echo $count ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>  
                </table>
            </div>
        </div>

        <!-- display the top 3 busiest day, i.e., the day that has most events to be held on -->
        <div class="centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">Top 3 Busiest Day Report</h2> 
            <div>
                <table id="tblBusyDays" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead">Rank</th>
                            <th class="colHead">Event Date</th>
                            <th class="colHead">Number of Events</th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            $rank = 1;
                            while ($row = mysqli_fetch_assoc($resultset3)):
                        ?>
                        <tr>
                            <td class="elemCenter"><?php echo ordinalSuffix($rank) ?></td>
                            <td class="elemCenter"><?php echo date('F j, Y', strtotime($row['Event_Date'])) ?></td>
                            <td class="elemCenter"><?php echo $row['num_events'] ?></td>
                        </tr>
                        <?php 
                            $rank++;
                            endwhile; 
                        ?>
                    </tbody>  
                </table>
            </div>
        </div>

        <!-- display All Users that are MALE, has "I" in their First Name, and has "A" in their Last Name -->
        <div class="centerHorizontallyDiv1 form-bg shadow-box marginTop">
            <h2 class="tableTitle">Report for All Users that are MALE, has "I" in their First Name, and has "A" in their Last Name</h2> 
            <div>
                <table id="tblEventsDashboard" cellspacing="0" width="100%"> 
                    <thead class="label-form">
                        <tr> 
                            <th class="colHead">User ID</th> 
                            <th class="colHead">First Name</th> 
                            <th class="colHead">Last Name</th>
                            <th class="colHead">Gender</th>
                        </tr> 
                    </thead>  
                    <tbody class="label-form">
                        <?php
                            while($row = $resultset1->fetch_assoc()):
                                $id = $row['userid'];
                        ?>
                        <tr>
                            <td class="elemCenter"><?php echo $id ?></td>
                            <td class="elemCenter"><?php echo $row['firstname'] ?></td>
                            <td class="elemCenter"><?php echo $row['lastname'] ?></td>
                            <td class="elemCenter"><?php echo $row['gender'] ?></td>
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