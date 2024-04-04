
<?php    
    include 'connect.php';
    require_once 'includes/header.php'; 

    $query = 'SELECT * from  tbldashboard';
        $resultset = mysqli_query($connection, $query);
?>
    
<div style='background-color:#ffff00'>
    <center>
        <p style="color:white"><h2>List of Events</h2></p>
    </center>
</div>
<!--
<div>
	<button><a href="addrecord.php">Add New Student</a></button>
</div> -->

    <div>        
        <table id="tblCustomerRecords " class="table
            table-striped table-bordered table-sm" cellspacing="0" width="100%"> 
            <thead>
                <tr> 
                    <th>Event ID</th> 
                    <th>Event Name</th> 
                    <th>Event Description</th>
                    <th>Event Host</th>
                </tr> 
            </thead>  
            <tbody>
                <?php
                    while($row = $resultset->fetch_assoc()):
                    	$id = $row['Event_ID'];
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $row['Event_Name'] ?></td>
                    <td><?php echo $row['Event_Description'] ?></td>
                    <td><?php echo $row['Host_ID'] ?></td>
                </tr>
                <?php endwhile;?>
            </tbody>         
        </table>
        
    </div>

<?php require_once 'includes/footer.php'; ?>