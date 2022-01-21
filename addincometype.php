<?php
	require_once 'connection.php';
	if(ISSET($_POST['incometype'])){
		$type = $_POST['type'];
        $businessId = $_POST['businessId'];
		
$sql = "INSERT INTO `incometype` (ttype , businessId)
 VALUES ('$type' ,'$businessId')";
 
		$conn->query($sql);
				echo "<script>alert('Income type created successful!')</script>";
				echo "<script>window.location='incometype.php'</script>";
		}else{
			echo "<script>alert('Check and make sure you have filled in all the fields correctly')</script>";
			echo "<script>window.location='incometype.php'</script>";
		}


			?>