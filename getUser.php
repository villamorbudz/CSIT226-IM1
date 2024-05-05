<?php 
	session_start();
    $current_user = null;

    if(isset($_SESSION["user"])) {
        $current_user = json_decode($_SESSION["user"], true);
    }
?>