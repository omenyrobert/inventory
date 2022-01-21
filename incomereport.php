

<?php
session_start();
require_once'connection.php';







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

<?php require_once'head.php';?><br/>

<form action="" method="GET" >
            	<div class="row">
            		<div class="col-md-2">
            			<input type="date" name="from_date" class="form-control" >
            		</div>

            		<div class="col-md-2">
            			<input type="date" name="to_date" class="form-control" >
            		</div>

            		<div class="col-md-2">
            			<button class="form-control btn-dark " type="submit" >Generate</button>
            		</div>
            		
            	</div>

            </form>

            <br/>

<br/>
 
<div id="profit">



<br/><br/>
<br/><br/>
<p style="color:black;" onclick="window.print();">Print</p>
<h1 style="color:black;">Income Report</h1>
<br/>
<br/>

<table id="myTable2" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr>
						<th>Income Type</th>
						<th>Amount</th>
						<th>Date</th>
						<th>Comment</th>
					</tr>
				</thead>
<tbody>



 	<?php
include_once('connection.php');
$bid=$_SESSION['businessId'];

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];

   $query=$conn->query("SELECT * FROM incometbl WHERE businessId='$bid' AND incomedate BETWEEN '$from_date' AND '$to_date' ") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
        
        	<tr>
        		<td><?php echo  $fetch['ttype'];?></td>
        		<td><?php echo number_format($fetch['amount']);?></td>
        		<td><?php echo $fetch['incomedate'];?></td>
        		<td><?php echo $fetch['incomecomment'];?></td>
        		       		
	   	
	   	</tr>
	  
	   		

 
		   <?php
   }
}
}


?>
     
</tbody>
<?php
include_once('connection.php');
$bid=$_SESSION['businessId'];

if(isset($_GET['from_date'])&&isset($_GET['to_date']))
{
	$from_date=$_GET['from_date'];
	$to_date=$_GET['to_date'];


	$sql1=$conn->query("SELECT SUM(amount) AS cou FROM `incometbl`  WHERE businessId='$bid'  AND incomedate BETWEEN '$from_date' AND '$to_date'") or die("Failed to row row!");
	while($row=$sql1->fetch_assoc())
	{
		 $total = ""." ".$row['cou'];
	}
	?>


<tr><td><h3>Total </h3></td> <td><h3> <?php echo number_format($total); ?></h3></td><td></td> <td></td></tr>
<?php
   }


?>
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
    $('#myTable2').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>

</html>