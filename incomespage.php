

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
 
		$conn->query("DELETE FROM `incometbl` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='incomespage.php'</script>";
	
	}




	$sqll=$conn->query("SELECT SUM(amount) AS cou FROM `incometbl`  WHERE businessId='$bid'") or die("Failed to row row!");
while($row=$sqll->fetch_assoc())
{
     $totalincome = ""." ".$row['cou'];
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
						 $sql=$conn->query("SELECT COUNT(*) AS cou FROM `stockin`  WHERE businessId='$bid'") or die("Failed to row row!");
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
<div class="row">      
<div class="col-md-2" >
<?php require_once'sidebar.php';?>
	
</div>   

       <div class="col-md-10">
	   <?php require_once'highlights.php';?>

<div class="row">
	<h3>Add Incomes</h3>
	 <div>
		      </div>
	<br/>
	<form method="post" action="addincome.php">
    <input type="hidden" name="businessId" value="<?php echo $_SESSION['businessId'];?>">
	<div style="display:flex;">
	<div style="margin:10px;">

    <label>Select Income Type</label>
		<select name="ttype" class="form-control">
        <?php
include_once('connection.php');
$bid=$_SESSION['businessId'];



   $query=$conn->query("SELECT * FROM  `incometype` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
               <option value="<?php echo $fetch['ttype']; ?>"><?php echo $fetch['ttype']; ?></option>
	   	
     <?php
   }
}


?>
		</select>
        <?php
include_once('connection.php');
$bid=$_SESSION['businessId'];



   $query=$conn->query("SELECT * FROM  `incometype` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
               <input type="hidden" name="code" value="<?php echo $fetch['code']; ?>">
	   	
     <?php
   }
}


?>

    </div>


    <div style="margin:10px;">
        <label>Amount</label>
        <input type="number" class="form-control" name="amount">
    </div>

    <div style="margin:10px;">
        <label>Date</label>
        <input type="date" class="form-control" name="incomedate">
    </div>

    <div style="margin:10px;">
        <label>comment</label>
        <input type="text" class="form-control" name="incomecomment">
    </div>      
		
	</div>
    <br/>
    <button type="submit" name="incometype" class="btn btn-success" style="width:150px;" >Save</button>
	</form>
</div>

<br/><br/><br/>

<div class="row">
	<div class="col-md-10">
	<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Income Type</th>
						<th>Amount</th>	
						<th>Date</th>
						<th>Comment</th>				
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
$bid=$_SESSION['businessId'];



   $query=$conn->query("SELECT * FROM  `incometbl` WHERE businessId='$bid' ORDER BY ttype") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
        <tr><td><?php echo $fetch['ttype']; ?></td>
	   	<td><?php echo number_format($fetch['amount']);?></td>
		<td><?php echo  $fetch['incomedate'];?></td>
		<td><?php echo  $fetch['incomecomment'];?></td>
			   
	   	
<td>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $fetch['id']; ?>">Edit</button>
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
				<h3 class="text-center">Type of Income<br/>&nbsp;&nbsp;<?php echo $fetch['ttype']; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="incomespage.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" style="color: black;" id="edit<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="incomeedit.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >

					<label>Select Income Type</label>
		<select name="type" class="form-control" value="<?php echo $fetch['ttype']; ?>">
     <option value="<?php echo $fetch['ttype']; ?>"><?php echo $fetch['ttype']; ?></option>
		</select><br/>

                     <label>Amount</label><br/>
                     <input type="number" name="amount" value="<?php echo  $fetch['amount'];?>" class="form-control" ><br/>

                     <label>Date</label><br/>
            		<input type="date" name="incomedate" value="<?php echo  $fetch['incomedate'];?>" class="form-control" ><br/>
                    <label>Comment</label>
            		<input type="text" name="incomecomment" value="<?php echo  $fetch['incomecomment'];?>" class="form-control" >
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="editincome" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>




     <?php
   }
}


?>
</tbody>

<tr><td><h3>Total</h3></td><td><h3> <?php echo number_format($totalincome); ?></h3></td>  <td></td> <td></td> <td></td> </tr>
</table>
	</div>


</div>


<br/>
<br/>
<br/>
		
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