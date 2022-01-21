<?php
	require_once 'connection.php';
	if(ISSET($_POST['incometype'])){
		$type = $_POST['ttype'];
        $businessId = $_POST['businessId'];
        $amount = $_POST['amount'];
		$incomedate=$_POST['incomedate'];
		$incomecomment=$_POST['incomecomment'];
        
		
$sql = "INSERT INTO `incometbl` (ttype , businessId, amount, incomedate, incomecomment)
 VALUES ('$type' ,'$businessId','$amount', '$incomedate','$incomecomment')";
 
		$conn->query($sql);
				echo "<script>alert('Income type created successful!')</script>";
				echo "<script>window.location='incomespage.php'</script>";
		}else{
			echo "<script>alert('Check and make sure you have filled in all the fields correctly')</script>";
			echo "<script>window.location='incomespage.php'</script>";
		}


			?>