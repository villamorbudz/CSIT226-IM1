<?php 
	$connection = new mysqli('localhost', 'root','','dbomasasf1');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>