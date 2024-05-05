<?php    
    include 'getUser.php';
    include 'connect.php';
    include 'includes/imports.php';
    require_once 'includes/headerAdmin.php';

    $query1 = "SELECT userid, firstname, lastname, gender from  tbluserprofile where firstname like '%i%' and lastname like '%a%' and gender='MALE'";
        $resultset1 = mysqli_query($connection, $query1);
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
        <!-- display all available events -->
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
    </div>
    </body>

    <footer style="position: relative; min-height: 25vh">
        <?php
            include("includes/footerO.php");
        ?>
    </footer>
    
</html>