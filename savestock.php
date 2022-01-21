	<?php
	require_once 'connection.php';
	if(ISSET($_POST['savestock'])){
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$dqty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];
		$warnn = $_POST['warnn'];
		$ttype = $_POST['ttype'];
		$businessId=$_POST['businessId'];
		$ddate=date('Y-m-d');
		

$sql = "INSERT INTO `stockin` (date,item, qty, dqty, bprice, sprice, businessId, status,warnn,ttype)
 VALUES ('$ddate','$item', '$qty','$dqty', '$bprice', '$sprice','$businessId','1','$warnn','$ttype')";
 
		$conn->query($sql);
		header('location: dashboard.php');
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}


			?>