<?php
	require_once'connection.php';
 
if(ISSET($_POST['change'])){
	   $id=$_POST['id'];
		$image_name   = $_FILES['receipt']['name'];
		$image        = $_FILES['receipt']['tmp_name'];
		$location     = "images/".$image_name;
		move_uploaded_file($image, $location);

$sql = "UPDATE expensetbl SET receipt='$image_name' WHERE id='$id'";

		$conn->query($sql);
 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='expensepage.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='expensepage.php'</script>";
		}
?>
