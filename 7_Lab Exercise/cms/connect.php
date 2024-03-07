<?php 
	$connection = new mysqli('localhost', 'root','','dbstudentinfosystem');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>