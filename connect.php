<?php 
	$connection = new mysqli('localhost', 'root','','dbvillamorf1');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>