<?php
	require_once'connection.php';
 
if(ISSET($_POST['editincome'])){
	   $id=$_POST['id'];
       $type = $_POST['type'];
       $amount = $_POST['amount'];
       $incomedate=$_POST['incomedate'];
       $incomecomment=$_POST['incomecomment'];		

$sql = "UPDATE incometbl SET ttype='$type', amount='$amount', incomedate='$incomedate', incomecomment='$incomecomment' WHERE id='$id'";

		$conn->query($sql);
 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='incomespage.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='incomespage.php'</script>";
		}
?>
