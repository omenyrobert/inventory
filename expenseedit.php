<?php
	require_once'connection.php';
 
if(ISSET($_POST['editexpense'])){
	   $id=$_POST['id'];
       $type = $_POST['ttype'];
       $amount = $_POST['amount'];
       $expensedate=$_POST['expensedate'];
       $expensecomment=$_POST['expensecomment'];
	   $reason = $_POST['reason'];	
	   $givenby = $_POST['givenby'];
	   $receivedby =$_POST['receivedby'];
	  
		// $image_name   = $_FILES['receipt']['name'];
		// $image        = $_FILES['receipt']['tmp_name'];
		// $location     = "images/".$image_name;
		// move_uploaded_file($image, $location);

$sql = "UPDATE expensetbl SET ttype='$type', amount='$amount', expensedate='$expensedate', expensecomment='$expensecomment', reason='$reason', givenby='$givenby', receivedby='$receivedby' WHERE id='$id'";

		$conn->query($sql);
 				echo "<script>alert('Information updated successfully!')</script>";
				echo "<script>window.location='expensepage.php'</script>";
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='expensepage.php'</script>";
		}
?>
