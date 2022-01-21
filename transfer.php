<?php
	require_once'connection.php';
 
if(ISSET($_GET['clear'])){

    $id=$_GET['clear'];
	  
$sql = "DELETE FROM  receipt";
	$conn->query($sql);

 				echo "<script>alert('receipt cleared successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
