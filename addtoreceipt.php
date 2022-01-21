<?php
	require_once'connection.php';
 
if(ISSET($_POST['addtoreceipt'])){
	    $ddate=date('Y-m-d');
		$fullname = $_POST['fullname'];
		$addresss = $_POST['addresss'];
		$phone = $_POST['phone'];

$sql = "UPDATE receipt SET fullname='$fullname',addresss='$addresss', phone='$phone'";
		$conn->query($sql);

		$sql2 = "INSERT INTO `stockOut` (itemid,sitem, sqty, sbprice, ssprice,ddate,fullname,addresss,phone)
		VALUES ('', '', '','','','$ddate','$fullname','$addresss','$phone')";
			   $conn->query($sql2);	
	 				header('location: dashboard.php');
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
