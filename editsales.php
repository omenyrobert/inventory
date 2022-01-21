

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
	<br/><br/>
	 <div>
	 	<div class="row">
		      	<?php
include_once('connection.php');

$bid=$_SESSION['businessId'];

   $sql=$conn->query("SELECT *, SUM(sqty)  FROM  `stockin`   INNER JOIN `stockout` ON `stockout`.sitem = `stockin`.item WHERE stockin.businessId='$bid'  GROUP BY sitem") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
							{
	?>
        
        	<div class="col-md-1" style="background-color: green; border-radius: 15%; text-align: center; padding: 2px; border: 5px white solid;  color: white;">
        		<?php $channge=$row['qty']-$row['SUM(sqty)'];
                          if ($channge<11) {
                          echo "<div style='background-color: red; color:white; font-size: 10px;' >Order needed</div>";
                          }
        				 ?>
        		<div style="border: 3px white solid; border-radius: 9%; ">        			
        		<h6><?php echo  $row['sitem'];?></h6>
        		<div style="display:flex; justify-content: space-around;">
        		<h5 style="color: black;"><?php echo $row['qty'];?></h5>
        		<h5><?php echo $row['qty']-$row['SUM(sqty)'];?></h5> </div> 
        		</div> 		
	   		
	   	
	   	</div>
	   		
     <?php
   }
}


?>
</div>
		      </div>
</div>
</div>
<div id="stock" style="margin: 50px;">
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<a href="#profit">Profits</a><br/>
<table id="myTable" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
						<th>Unit Buying Price</th>
						<th>Unit Selling Price</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');




   $sql=$conn->query("SELECT * FROM  `stockout` WHERE businessId='$bid'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
	?>
        <tr><td><?php echo $row['ddate']; ?></td>
	   		<td><?php echo  $row['sitem'];?></td>
	   		<td><?php echo number_format($row['sqty']);?></td>
	   		<td><?php echo number_format($row['sbprice']);?></td>
	   		<td><?php echo number_format($row['ssprice']);?></td>
	   	
<td>

	<?php if($_SESSION['ROLE'] == 'admin'){ ?>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">Edit</button> 
		  <?php } ?>
</td>				
	   	</tr>





<div class="modal fade" style="color: black;" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="editsale.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >
                    <label>Item</label><br/>
                     <input type="text" name="sitem" value="<?php echo  $row['sitem'];?>" class="form-control" ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="sqty" value="<?php echo  $row['sqty'];?>" class="form-control" ><br/><br/>

                     <label>Unit Buying Price</label><br/>
            		<input type="number" name="sbprice" value="<?php echo  $row['sbprice'];?>" class="form-control" ><br/><br/>
                    <label>Unit Selling Price</label>
            		<input type="number" name="ssprice" value="<?php echo  $row['ssprice'];?>" class="form-control" >
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edititem" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>



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