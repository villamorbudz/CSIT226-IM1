<?php
    $id = $_GET["id"];
 
    include("connect.php");
    $query = "DELETE from tblevent WHERE Event_ID = '$id'";
    mysqli_query($connection, $query);
 
    header("Location: index.php");
?>