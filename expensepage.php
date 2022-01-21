

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
 
		$conn->query("DELETE FROM `expensetbl` WHERE `id`='$id'") or die("Failed to delete a row!");
		echo "<script>alert(' informational deleted successfully!')</script>";
				echo "<script>window.location='expensepage.php'</script>";
	
	}



	$sql1=$conn->query("SELECT COUNT(*) AS cou FROM `incometype`  WHERE businessId='$bid'") or die("Failed to row row!");
	while($row=$sql1->fetch_assoc())
{
		 $incomeno = ""." ".$row['cou'];
}

$sqll=$conn->query("SELECT SUM(amount) AS cou FROM `expensetbl`  WHERE businessId='$bid'") or die("Failed to row row!");
while($row=$sqll->fetch_assoc())
{
     $totalex = ""." ".$row['cou'];
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
	<form method="post" action="addexpense.php" enctype="multipart/form-data">
    <input type="hidden" name="businessId" value="<?php echo $_SESSION['businessId'];?>">
	<div style="display:flex;  flex-wrap: wrap; width:85vw;">
	<div style="margin:10px;">

    <label>Select expense Type</label>
		<select name="ttype" class="form-control">
        <?php
include_once('connection.php');
$bid=$_SESSION['businessId'];



   $query=$conn->query("SELECT * FROM  `expensetype` WHERE businessId='$bid'") or die("Failed to fetch row!");
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



   $query=$conn->query("SELECT * FROM  `expensetype` WHERE businessId='$bid'") or die("Failed to fetch row!");
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
        <label>Given by</label>
        <input type="text" class="form-control" name="givenby">
    </div>

    <div style="margin:10px;">
        <label>Received by</label>
        <input type="text" class="form-control" name="receivedby">
    </div>

    <div style="margin:10px;">
        <label>Date</label>
        <input type="date" class="form-control" name="expensedate">
    </div>
    
    <div style="margin:10px;">
        <label>Reason</label>
        <input type="text" class="form-control" name="reason">
    </div>  

    <div style="margin:10px;">
        <label>comment</label>
        <input type="text" class="form-control" name="expensecomment">
    </div> 

    <div style="margin:10px;">
        <label>Receipt</label>
        <input type="file" class="form-control" name="receipt">
    </div>       
		
	</div>
    <br/>
    <button type="submit" name="expensetype" class="btn btn-success" style="width:150px;" >Save</button>
    <br/><br/><br/>
	</form>
</div>
</div>
<br/><br/><br/>

<div class="row">
    
	<div style="margin:50px;">
	<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>expense Type</th>
						<th>Amount</th>	
						<th>Date</th>
						<th>Comment</th>
                        <th>Given by</th>
                        <th>Received by</th>
                        <th>Reason</th>
                        <th>Receipt</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');
$bid=$_SESSION['businessId'];



   $query=$conn->query("SELECT * FROM  `expensetbl` WHERE businessId='$bid' ORDER BY ttype") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>   
        <tr><td><?php echo $fetch['ttype']; ?></td>
	   	<td><?php echo number_format($fetch['amount']);?></td>
           <td><?php echo  $fetch['expensedate'];?></td>
		<td><?php echo  $fetch['expensecomment'];?></td>
        <td><?php echo $fetch['givenby']; ?></td>
	   	<td><?php echo  $fetch['receivedby'];?></td>
		<td><?php echo  $fetch['reason'];?></td>
		<td><img src="images/<?php echo  $fetch['receipt'];?>" style="width:50px;" ><button class="btn btn-default" data-toggle="modal" data-target="#photo<?php echo $fetch['id']; ?>">Change</button></td>
			   
	   	
<td>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $fetch['id']; ?>">Delete</button>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $fetch['id']; ?>">Edit</button>
</td>				
	   	</tr>

<div class="modal fade" style="color: black;" id="photo<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Vochure</h4></center>
            </div>
            <form method="POST" action="receiptupdate.php" enctype="multipart/form-data">
            <div class="modal-body">	
            <img src="images/<?php echo $fetch['receipt']; ?>" style="width: 90%;"> 
            <input type="file" name="receipt" >
            <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            <button type="submit" name="change" class="btn btn-warning">Change</button>
            </div>

        </div>
    </div>
</div>


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
                <a href="expensepage.php?id=<?php echo $fetch['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
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
            	<form method="post" action="expenseedit.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $fetch['id'];?>" class="form-control" >

                    <label>Select expense Type</label>
		<select name="ttype" class="form-control">
        <?php
include_once('connection.php');
$bid=$_SESSION['businessId'];

   $query1=$conn->query("SELECT * FROM  `expensetype` WHERE businessId='$bid'") or die("Failed to fetch row!");
						while($row=$query1->fetch_assoc()){
							{
	?>
               <option value="<?php echo $row['ttype']; ?>"><?php echo $row['ttype']; ?></option>
	   	
     <?php
   }
}


?>
		</select><br/>

                     <label>Amount</label><br/>
                     <input type="number" name="amount" value="<?php echo $fetch['amount'] ;?>" class="form-control" ><br/>

                     <label>Given By</label><br/>
            		<input type="text" name="givenby" value="<?php echo  $fetch['givenby'];?>" class="form-control" ><br/>
                    
                    <label>Receivedby</label>
            		<input type="text" name="receivedby" value="<?php echo  $fetch['receivedby'];?>" class="form-control" >
				
                    <div style="margin:10px;">
        <label>Date</label>
        <input type="date" class="form-control" value="<?php echo  $fetch['expensedate'];?>" name="expensedate">
    </div>
    
    <div style="margin:10px;">
        <label>Reason</label>
        <input type="text" class="form-control" value="<?php echo  $fetch['reason'];?>" name="reason">
    </div>  

    <div style="margin:10px;">
        <label>comment</label>
        <input type="text" class="form-control" value="<?php echo  $fetch['expensecomment'];?>" name="expensecomment">
    </div> 

			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="editexpense" class="btn btn-primary">Update</button>
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
<tr><td><h3>Total</h3></td><td><h3> <?php echo number_format($totalex); ?></h3></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr>
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