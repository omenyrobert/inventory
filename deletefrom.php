<?php

require_once'connection.php';

if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `receipt` WHERE `itemid`='$id'") or die("Failed to delete a row!");

		$conn->query("DELETE FROM `stockout` WHERE `itemid`='$id'") or die("Failed to delete a row!");
        header('location: dashboard.php');
	
	}
    ?>