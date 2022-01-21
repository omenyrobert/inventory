

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
 
		$conn->query("DELETE FROM `expensetype` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='expensetype.php'</script>";
	
	}


// 	$sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockin`") or die("Failed to row row!");
// 						while($row=$sql->rowArray())
//    {
//                          	$output = ""." ".$row['cou'];
//                          }

						 $sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockin`  WHERE businessId='$bid'") or die("Failed to row row!");
						 while($row=$sql->fetch_assoc())
	{
							  $output = ""." ".$row['cou'];
						  }

	 					  $sql1=$conn->query("SELECT COUNT(*) AS cou FROM `incometype`  WHERE businessId='$bid'") or die("Failed to row row!");
	 					  while($row=$sql1->fetch_assoc())
	 {
	 						   $incomeno = ""." ".$row['cou'];
					   }

						   $sql2=$conn->query("SELECT COUNT(*) AS cou FROM `expensetype`  WHERE businessId='$bid'") or die("Failed to fetch row!");
						   while($row=$sql2->fetch_assoc())
	  {
								$expenseno = ""." ".$row['cou'];
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
<div class="row">      
<div class="col-md-2" >
<?php require_once'sidebar.php';?>
	
</div>   

       <div class="col-md-10">
	   <?php require_once'highlights.php';?>

<div class="row">
	 <div>
	 	
		      </div>
	<h3>Add Types Expenses</h3>
	<br/>
	<form method="post" action="addexpensetype.php">
	<div class="col-md-10">
	<input type="hidden" name="businessId" style="width:250px;" value="<?php echo $_SESSION['businessId'];?>">
	<h6>Enter type of expenses</h6>
	<input type="text" name="type" class="form-control" style="width:250px;" placeholder="Enter new expense type" required="required"><br/>
		<button type="submit" name="expensetype" class="btn btn-success" style="width:200px;" >Save</button>
	</div>
	</form>
</div>

<br/><br/><br/>

<div class="row">
	<div class="col-md-10" style="width:550px;">
	<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>expense Type</th>				
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
   $query=$conn->query("SELECT * FROM  `expensetype` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
        <tr><td><?php echo $fetch['ttype']; ?></td>
	   	
<td>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button>
</td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<h3 class="text-center">Type of expense<br/>&nbsp;&nbsp;<?php echo $fetch['ttype']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="expensetype.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>



     <?php
   }
}


?>
</tbody>

</table>

	</div>


</div>



		
</div>
</div>
<br/><br/><br/><br/>
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


// $(document).ready(function(){
// 	//inialize datatable
//     $('#myTable2').DataTable();

//     //hide alert
//     $(document).on('click', '.close', function(){
//     	$('.alert').hide();
//     })
// });
</script>
</body>

</html>