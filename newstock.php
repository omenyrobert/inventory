<?php
	require_once 'connection.php';
	if(ISSET($_POST['newstock'])){
        $id = $_POST['id'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$dqty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];
		$businessId=$_POST['businessId'];
		$ddate=date('Y-m-d');
		$warnn = $_POST['warnn'];
		$ttype = $_POST['ttype'];
		

        $sql2 = "UPDATE `stockin` SET status='0' WHERE id='$id'";
		$conn->query($sql2);   

$sql = "INSERT INTO `stockin` (date,item, qty, dqty, bprice, sprice, businessId, status,warnn,ttype)VALUES ('$ddate','$item', '$qty','$dqty', '$bprice', '$sprice','$businessId','1','$warnn','$ttype')";
 
		$conn->query($sql);

		header('location: dashboard.php');
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}


			?>