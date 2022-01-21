	<?php
	require_once 'connection.php';
	if(ISSET($_POST['savesale'])){
		$id = $_POST['id'];
		$businessId = $_POST['businessId'];
		$sitem = $_POST['sitem'];
		$sqty = $_POST['sqty'];
		$sbprice = $_POST['sbprice'];
		$ssprice=$_POST['ssprice'];
		$ddate=date('Y-m-d');
		$dqty = $_POST['dqty'];
		$x=$dqty-$sqty;
		$total=$sqty*$ssprice;
		$ttype = $_POST['ttype'];

		if($ttype =='stock' && $x<0){
			echo "<script>alert('You don't enough items')</script>";
				echo "<script>window.location='dashboard.php'</script>";
		} else{

$sql1 = "UPDATE stockin SET dqty='$x' WHERE id='$id'";
		$conn->query($sql1);

$sql = "INSERT INTO `stockout` (ddate,sitem, sqty, sbprice, ssprice, total,businessId,ttype,itemid)
 VALUES ('$ddate','$sitem', '$sqty', '$sbprice', '$ssprice', '$total','$businessId','$ttype','$id')";
 
		$conn->query($sql);

$sql2 = "INSERT INTO `receipt` (item, qty, price, total,businessId,itemid)
		VALUES ('$sitem', '$sqty', '$ssprice', '$total','$businessId','$id')";
		$conn->query($sql2);

		header('location: dashboard.php');
	}
	}

			?>