<?php
	
	include 'connect.php';
	
	$query = 'SELECT * from  tblstudent';
        $resultset = mysqli_query($connection, $query);

	
?>