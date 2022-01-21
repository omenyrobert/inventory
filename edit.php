<?php
	require_once'connection.php';
 
if(ISSET($_POST['edititem'])){
	   $id=$_POST['id'];
	   $warnn = $_POST['warnn'];
		$ttype = $_POST['ttype'];
		$item = $_POST['item'];
		$qty = $_POST['qty'];
		$bprice = $_POST['bprice'];
		$sprice=$_POST['sprice'];	
		$ttype=$_POST['ttype'];	

$sql = "UPDATE stockin SET item='$item',qty='$qty', dqty='$qty', bprice='$bprice', sprice='$sprice',warnn='$warnn', ttype='$ttype' WHERE id='$id'";

		$conn->query($sql);

		header('location: dashboard.php');
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
