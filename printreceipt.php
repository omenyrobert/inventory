
<?php
session_start();
require_once'connection.php';
$bid=$_SESSION['businessId'];


	$sql=$conn->query("SELECT SUM(total) AS cou FROM `receipt` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($fetch=$sql->fetch_assoc())
   {
                         	$gtotal = ""." ".$fetch['cou'];
                         }


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>System</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.bod{
	background-color: white;
	color: black;
}
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>
</head>
<body style="width: 300px;">
<p onclick="window.print();">Print</p>
<a href="dashboard.php">back</a>
<div style="margin:100px; width: 480px;">

<?php
include_once('connection.php');


$bid=$_SESSION['businessId'];

   $sql=$conn->query("SELECT * FROM users WHERE businessId = '$bid'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
							{
	?>    		


   	<div  style="" class="container-fluid">
	<h1 class="page-header text-center"><?php echo $row['businessName'];?></h1>
	<p><?php echo $row['description'];?></p>
	<div style="display:flex; justify-content: space-between;">
	<p><?php echo $row['contact'];?></p>	
  <p><?php echo $row['address'];?></p>
	</div>

	 
		
	<?php
   }
}


?>

</div>

<table  style=" color: black; background-color: white; width: 300px;" class="table">
<thead>
   
					<tr><th>Item</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
						
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
        <tr>
	   		<td><?php echo  $fetch['item'];?></td>
	   		<td><?php echo number_format((float)$fetch['qty']);?></td>
	   		<td><?php echo number_format((float)$fetch['price']);?></td>
	   		<td><b> <?php echo number_format((float)$fetch['total']);?></b></td>
				
	   	</tr>


     <?php
   }
}


?>
<tr><td colspan="3"><h4>Total</h4></td> <td><h4><?php echo number_format((float)$gtotal); ?></h4></td></tr>

<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt` WHERE businessId='$bid' LIMIT 1") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
    <tr>
	<td><b><?php echo $fetch['fullname'];?> </b></td>
	   		<td><b><?php echo $fetch['phone'];?></b></td>
	   		<td><b><?php echo $fetch['addresss'];?></b></td>
                            </tr>
	   		
			   <?php   
   }
}


?>
	   	
</tbody>

</table>
</div>
<a href="transfer.php?clear=all" onclick="return confirm('Are you sure u want to clear the receipt?')">Clear</a>
</body>

</html>
