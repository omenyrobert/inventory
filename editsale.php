<?php
	require_once'connection.php';
 
if(ISSET($_POST['edititem'])){
	   $id=$_POST['id'];
		$sitem = $_POST['sitem'];
		$sqty = $_POST['sqty'];
		$sbprice = $_POST['sbprice'];
		$ssprice=$_POST['ssprice'];		

$sql = "UPDATE stockout SET sitem='$sitem',sqty='$sqty', sbprice='$sbprice', ssprice='$ssprice' WHERE id='$id'";

		$conn->query($sql);

 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location=' editsales.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location=' editsales.php'</script>";
		}
?>
