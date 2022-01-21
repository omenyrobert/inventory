<?php
	require_once'connection.php';
 
if(ISSET($_POST['edititem'])){
	   $id=$_POST['itemid'];
       $price =$_POST['price'];
		$qty = $_POST['qty'];
        $sprice = $price*$qty;
				

$sql2 = "UPDATE receipt SET qty='$qty', total='$sprice' WHERE itemid='$id'";
$conn->query($sql2);

$sql = "UPDATE stockout SET sqty='$qty', total='$sprice' WHERE itemid='$id'";

		$conn->query($sql);

        header('location: dashboard.php');
		}else{
			echo "<script>alert('there was an error!')</script>";
			echo "<script>window.location='dashboard.php'</script>";
		}
?>
