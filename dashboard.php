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
		header('location: dashboard.php');
	
	}

	$sql=$conn->query("SELECT SUM(total) AS cou FROM `receipt` WHERE businessId='$bid'") or die("Failed to fetch row!");
	while($fetch=$sql->fetch_assoc())
{
		 $gtotal = ""." ".$fetch['cou'];
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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" > -->
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

   $sql=$conn->query("SELECT * FROM stockin WHERE  businessId='$bid' AND status='1' AND ttype='stock'") or die("Failed to row!");
   while($row=$sql->fetch_assoc()){
							{
	?>
        
        	<div class="col-md-1" style="background-color: green; border-radius: 15%; text-align: center; padding: 2px; border: 5px white solid;  color: white;">
        		<?php $dqty=$row['dqty'];
				      $warnn =$row['warnn'];
				      
                          if ($dqty < $warnn){
                          echo "<div style='background-color: red; color:white; font-size: 10px;' >Order needed</div>";
                          }
        				 ?>
        		<div style="border: 3px white solid; border-radius: 9%; ">        			
        		<h6><?php echo  $row['item'];?></h6>
        		<div style="display:flex; justify-content: space-around;">
        		<h5 style="color: black;"><?php echo $row['qty'];?></h5>
        		<h5><?php echo $row['dqty'];?></h5> </div> 
        		</div> 		
	   		
	   	
	   	</div>
	   		
     <?php
   }
}


?>
</div>
		      </div>
	<br/><br/>
	<form method="post" action="savestock.php">
	<div class="col-md-2">
		<label>Item</label><br/>
		<input type="text" name="item" class="form-control" required="required">
		
	</div>

	<div class="col-md-2">
		<label>Quantity</label><br/>
		<input type="number" name="qty" class="form-control" required="required">
		<?php echo $row['description'];?>
		<input type="hidden" name="businessId" value="<?php echo $bid; ?>" class="form-control" required="required">
		
	</div>

	<div class="col-md-2">
		<label>Unit Buying Price</label><br/>
		<input type="number" name="bprice" class="form-control" required="required">
		
	</div>

	<div class="col-md-2">
		<label>Unit Selling Price</label><br/>
		<input type="number" name="sprice" class="form-control" required="required">
		
	</div>

	<div class="col-md-2">
	<label>Type</label><br/>
		<select class="form-control" name="ttype">
			<option value="stock">stock</option>
			<option value="service">service</option>
		</select>	
	</div>

	<div class="col-md-2">
		<label>warning at</label><br/>
		<input type="number" name="warnn" class="form-control" value="10">
		
	</div>

	<div class="col-md-2"><br/>
		<button type="submit" name="savestock" class="btn btn-primary" >Save</button>
		
	</div>
	</form>
	<br/><br/><br/><br/><br/><br/><br/>	<br/><br/><br/>
</div>
</div>

<div id="stock">

<div class="row">
	<div class="col-md-8">

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




   $sql=$conn->query("SELECT * FROM  `stockin` WHERE businessId='$bid' AND status='1'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
	?>
        <tr><td><?php echo $row['date']; ?></td>
	   		<td><?php echo  $row['item'];?></td>
	   		<td><?php echo number_format($row['dqty']);?></td>
	   		<td><?php echo number_format($row['bprice']);?></td>
	   		<td><?php echo number_format($row['sprice']);?></td>
	   	
<td>
<?php if($row['dqty'] !== '0' || $row['ttype']=='service' ){ ?>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#sale<?php echo $row['id']; ?>">S</button> 
<?php } ?>

<?php if($row['dqty'] == '0' && $row['ttype']=='stock'){ ?>
	<button type="button" class="btn btn-default" style="background-color: black; color: white;" data-toggle="modal" data-target="#stock<?php echo $row['id']; ?>">Enter New Stock</button> 
<?php } ?>

	<?php if($_SESSION['ROLE'] == 'admin'){ ?>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">Ed</button> 
		  <?php } ?>

<?php if($_SESSION['ROLE'] == 'admin'){ ?>
	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?php echo $row['id']; ?>">Del</button>
		  <?php } ?>
</td>				
	   	</tr>



<div class="modal fade" style="color: black;" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<p class="text-center"><?php echo $row['item'].'<br/> '.$row['qty'].'<br/>Selling Price:&nbsp;'.$row['sprice']; ?></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="dashboard.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" style="color: black;" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="edit.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >
                    <label>Item</label><br/>
                     <input type="text" name="item" value="<?php echo  $row['item'];?>" class="form-control" ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="qty" value="<?php echo  $row['qty'];?>" class="form-control" ><br/><br/>

                     <label>Unit Buying Price</label><br/>
            		<input type="number" name="bprice" value="<?php echo  $row['bprice'];?>" class="form-control" ><br/><br/>
                    <label>Unit Selling Price</label>
            		<input type="number" name="sprice" value="<?php echo  $row['sprice'];?>" class="form-control" >
				    <br/>
					<label>warning at</label><br/>
            		<input type="number" name="warnn" value="<?php echo  $row['warnn'];?>" class="form-control" >
					<br/>
					<select name="ttype" value="<?php echo  $row['ttype'];?>" class="form-control">
					<label>Type</label>
					<option value="stock">stock</option>
					<option value="service">service</option>
					</select>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edititem" class="btn btn-warning">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>



<div class="modal fade" style="color: black;" id="sale<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Enter Sale</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="sale.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >
                    <input type="hidden" name="businessId" value="<?php echo  $row['businessId'];?>" class="form-control" >
                  
                     <input type="text" name="sitem" value="<?php echo  $row['item'];?>" class="form-control" readOnly ><br/><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="sqty" class="form-control" ><br/><br/>

            		<input type="hidden" name="sbprice" value="<?php echo  $row['bprice'];?>" class="form-control" >
					<input type="hidden" name="ttype" value="<?php echo  $row['ttype'];?>" class="form-control" >

					<input type="hidden" name="dqty" value="<?php echo  $row['dqty'];?>" class="form-control" >
                   
            		<input type="hidden" name="ssprice" value="<?php echo  $row['sprice'];?>" class="form-control" >

					
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="savesale" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>




<div class="modal fade" style="color: black;" id="stock<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Enter New Stock</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="newstock.php">
            		
            		<input type="hidden" name="id" value="<?php echo  $row['id'];?>" class="form-control" >
                    <input type="hidden" name="businessId" value="<?php echo  $row['businessId'];?>" class="form-control" >
                  
                     <input type="text" name="item" value="<?php echo  $row['item'];?>" class="form-control" readOnly ><br/>

                     <label>Quantity</label><br/>
                     <input type="number" name="qty" class="form-control" ><br/>
					 <label>Buying price</label><br/>
            		<input type="number" name="bprice" value="<?php echo  $row['bprice'];?>" class="form-control" ><br/>
                    <label>Selling Price</label><br/>
            		<input type="number" name="sprice" value="<?php echo  $row['sprice'];?>" class="form-control" >
					<br/>
					<label>warning at</label><br/>
            		<input type="number" name="warnn" value="<?php echo  $row['warnn'];?>" class="form-control" >
					<br/>
					<select name="type" value="<?php echo  $row['warnn'];?>" class="form-control">
					<option value="stock">stock</option>
					<option value="service">service</option>
					</select>
				
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="newstock" class="btn btn-primary">Save</button>
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
	<div class="col-md-4">
	<br/>
	
	<form action="addtoreceipt.php" method="POST">
		<h4>Add Customers details</h4>
		<div style="display:flex;">
		<input type="text" name="fullname" class="form-control" placeholder="enter full name">
		<input type="text" name="addresss" class="form-control" placeholder="Address">
		<input type="text" name="phone" class="form-control" placeholder="phone number">

		</div>
		<br/>
		<button class="btn btn-primary" type="submit" name="addtoreceipt">Add to receipt</button>
	</form>
	<br/>
	<table style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr><th>Item</th>
						<th>Qty</th>
						<th>Cost</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
<tbody>
<?php
include_once('connection.php');


   $sql=$conn->query("SELECT * FROM  `receipt` WHERE businessId='$bid'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
	?>
        <tr><td><?php echo  $row['item'];?></td>
	   		<td><?php echo number_format($row['qty']);?></td>
	   		<td><?php echo number_format($row['price']);?></td>
	   		<td><?php echo number_format($row['total']);?></td>
	   	
<td>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ed<?php echo $row['id']; ?>">Ed</button> 
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del<?php echo $row['id']; ?>">Del</button>	  
</td>				
	   	</tr>

<div class="modal fade" style="color: black;" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Record</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to Delete</p>
				<p class="text-center"><?php echo $row['item']; ?></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="deletefrom.php?id=<?php echo $row['itemid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" style="color: black;" id="ed<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">edit</h4></center>
            </div>
            <div class="modal-body">	
            	<form method="post" action="editfrom.php">
            		<h4><?php echo  $row['item']; ?></h4>
            		<input type="hidden" name="itemid" value="<?php echo  $row['itemid'];?>" class="form-control" >
					<input type="hidden" name="price" value="<?php echo  $row['price'];?>" class="form-control" >
                    <label>Quantity</label><br/>
                     <input type="number" name="qty" value="<?php echo  $row['qty'];?>" class="form-control" ><br/><br/>

                
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edititem" class="btn btn-warning">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>



     <?php
   }



?>

<?php
include_once('connection.php');




   $query=$conn->query("SELECT * FROM  `receipt` WHERE businessId='$bid' LIMIT 1") or die("Failed to fetch row!");
						while($fetch=$query->fetch_assoc()){
							{
	?>
    <div style="display: flex; justify-content: space-between;">
	<p><b><?php echo $fetch['fullname'];?> </b></p>
	   		<p><b><?php echo $fetch['phone'];?></b></p>
	   		<p><b><?php echo $fetch['addresss'];?></b></p>
	</div>
	   		
			   <?php   
   }
}


?>
	   	
</tbody>
<tr><td colspan="3"><h4>Total</h4></td> <td><h4><?php echo number_format((float)(float)$gtotal); ?></h4></td></tr>
</table>

	</div>




</div>





</div>
 
<div id="profit">



<br/><br/>
<a href="#stock">Stock</a>
<h1>Profits</h1>

<table id="myTable2" style=" color: black; background-color: white;" class="table table-bordered">
<thead>
					<tr>
						<th>Date</th>
						<th>Item</th>
						<th>Quantity</th>
						<th>Quantity Sold</th>
						<th>Quantity Remaining</th>
						<th>Costs</th>
						<th>Sales</th>
						<th>Profits</th>
					</tr>
				</thead>
<tbody>



 	<?php
include_once('connection.php');

$ddate=date('Y-m-d');

   $sql=$conn->query("SELECT *,  SUM(sqty) FROM  `stockin` INNER JOIN `stockout` ON `stockout`.sitem = `stockin`.item WHERE stockin.businessId='$bid' AND ddate='$ddate' AND stockin.businessId='$bid'  GROUP BY sitem") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
							{
	?>
        
        	<tr>
        		<td><?php echo  $row['ddate'];?></td>
        		<td><?php echo  $row['sitem'];?></td>
        		<td><?php echo $row['qty'];?></td>
        		<td><?php echo $row['SUM(sqty)'];?></td>
        		<td><?php echo $row['qty']-$row['SUM(sqty)'];?></td>
        		<td><?php echo number_format($row['bprice']*$row['SUM(sqty)']);?></td>
        		<td><?php echo number_format($row['sprice']*$row['SUM(sqty)']);?></td>
        		<td><?php echo number_format( $row['SUM(sqty)']*($row['ssprice']-$row['sbprice']));?></td>
        		
	   	
	   	</tr>
	  
	   		
     <?php
   }
}


?>
 
  <?php
include_once('connection.php');


$ddate=date('Y-m-d');

   $sql=$conn->query("SELECT *, SUM(sqty) FROM  `stockin`  INNER JOIN `stockout` ON `stockout`.sitem = `stockin`.item WHERE stockin.businessId='$bid' AND ddate='$ddate' GROUP BY sitem") or die("Failed to row row!");
   $pro=0;
   $cost=0;
   $sale=0;
   while($row=$sql->fetch_assoc()){
							{

								$pro+=$row['SUM(sqty)']*($row['ssprice']-$row['sbprice']);
								$cost+=$row['bprice']*$row['SUM(sqty)'];
								$sale+=$row['sprice']*$row['SUM(sqty)'];

								
	?>
	
	   
  <?php
   }
}


?>
     
</tbody>
<tr><td colspan="5"><h3>Total</h3></td> <td><h3><?php echo number_format($cost); ?></h3></td> <td> <h3><?php echo number_format($sale); ?>	</h3></td>  <td><h3><?php echo number_format($pro); ?>	</h3></td></tr>
</table>
 
</div>




  </div>
</div>

<div class="container-fluid" style="margin-bottom: 5vw;">
			<div class="row">
				<div class="col-md-4">
					<div class="card mt-4" style="background-color: #f0f6fa; border-radius: 5px;">
						<div class="card-header" style="background-color:green; color:white; border-radius: 5px; padding: 0.5vw;">Pie Chart</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="pie_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mt-4" style="background-color: #f0f6fa; border-radius: 5px;">
						<div class="card-header" style="background-color: gold; color: black; border-radius: 5px; padding: 0.5vw;">Line Chart</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="doughnut_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mt-4 mb-4" style="background-color: #f0f6fa; border-radius: 5px;">
						<div class="card-header" style="background-color: #2e3192; color: white; border-radius: 5px; padding: 0.5vw;">Bar Chart</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="bar_chart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->




<script>
	
$(document).ready(function(){

	$('#submit_data').click(function(){

		var item = $('input[name=programming_item]:checked').val();

		$.ajax({
			url:"data.php",
			method:"POST",
			data:{action:'insert', item:item},
			beforeSend:function()
			{
				$('#submit_data').attr('disabled', 'disabled');
			},
			success:function(data)
			{
				$('#submit_data').attr('disabled', false);

				$('#programming_item_1').prop('checked', 'checked');

				$('#programming_item_2').prop('checked', false);

				$('#programming_item_3').prop('checked', false);

				alert("Your Feedback has been send...");

				makechart();
			}
		})

	});

	makechart();

	function makechart()
	{
		$.ajax({
			url:"data.php",
			method:"POST",
			data:{action:'fetch'},
			dataType:"JSON",
			success:function(data)
			{
				var item = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					item.push(data[count].item);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:item,
					datasets:[
						{
							label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"line",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>






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