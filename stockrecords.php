<?php

session_start();

require_once'connection.php';

$bid=$_SESSION['businessId'];
if (!isset($_SESSION['ID'])) {
	header("Location:index.php");
	exit();
}


 if(ISSET($_REQUEST['id'])){
		$id=$_REQUEST['id'];
 
		$conn->query("DELETE FROM `stockin` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='dashboard.php'</script>";
	
	}


	$sql1=$conn->query("SELECT COUNT(*) AS cou FROM `incometype`  WHERE businessId='$bid' ") or die("Failed to row row!");
	while($row=$sql1->fetch_assoc())
{
		 $incomeno = ""." ".$row['cou'];
}

	$sql2=$conn->query("SELECT COUNT(*) AS cou FROM `expensetype`  WHERE businessId='$bid'") or die("Failed to fetch row!");
	while($row=$sql2->fetch_assoc())
{
		 $expenseno = ""." ".$row['cou'];
	 }

						 $sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockin`  WHERE businessId='$bid' AND status='1' ") or die("Failed to row row!");
						 while($row=$sql->fetch_assoc())
	{
							  $output = ""." ".$row['cou'];
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
<body class="bod">
<div class="container-fluid">

<?php require_once'head.php';?>
	<br/><br/>
</div><br/><br/>



<div id="stock" style="margin:50px;">
<a href="#" onclick="window.print();">Print</a><br/>
<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
                        <th>Qty Left</th>
						<th>Unit Buying Price</th>
						<th>Unit Selling Price</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $sql=$conn->query("SELECT * FROM  `stockin` WHERE businessId='$bid'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
	?>
        <tr><td><?php echo $row['date']; ?></td>
	   		<td><?php echo  $row['item'];?></td>
            <td><?php echo number_format($row['qty']);?></td>  
	   		<td><?php echo number_format($row['dqty']);?></td>
	   		<td><?php echo number_format($row['bprice']);?></td>
	   		<td><?php echo number_format($row['sprice']);?></td>
		
	   	</tr>


     <?php
   }



?>
</tbody>

</table>

</div>
 




  </div>
</div>




			
</div>
</div>
</div>









	


<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});


$(document).ready(function(){
	//inialize datatable
    $('#myTable2').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>

</html>