<?php
include_once('connection.php');


$bid=$_SESSION['businessId'];

   $sql=$conn->query("SELECT * FROM users WHERE businessId = '$bid'") or die("Failed to row row!");
   while($row=$sql->fetch_assoc()){
							{
	?>    		


   	<div  style="background-color: #0c1e53; color: white; padding: 1vw; width: 15vw; margin-left: -0.5vw; margin-top: -1vw;">

	<h3><?php echo $row['businessName'];?></h3>
<br/><br/>
	<a href="printreceipt.php" style="color: white;" >Print</a>
	         <p style="background-color: grey; padding: 5px;">Incomes </p>
		     <a href="incometype.php" style="color: white;" >Types of Incomes</a>
		     <a href="incomespage.php" style="color: white;" >Add incomes</a>
		      <a href="incomereport.php" style="color: white;" >Income report</a>
              <p style="background-color: grey; padding: 5px;">Expenses </p>
		     <a href="expensetype.php" style="color: white;" >Types of Expenses</a>
		     <a href="expensepage.php" style="color: white;" >Add Expenses</a>
		      <a href="expensereport.php" style="color: white;" >Expenses report</a>
			  <a href="editsales.php" style="color: white;" >Edit Sales</a>
			  <p style="background-color: grey; padding: 5px;">Sales & Stock </p>
			  <a href="stockrecords.php" style="color: white;" >Stock records</a>
			  <a href="daily.php" style="color: white;" >Sales Reports</a>
			  <a href="printreceipt.php" style="color: white;" >Print Receipt</a><br/>
			  <a href="viewreceipt.php" style="color: white;" >Edit Receipt</a>

<br/>
<br/>


<p><?php echo $row['contact'];?></p>

  <p><?php echo $row['description'];?></p>

  <p><?php echo $row['address'];?></p>

	</div>

		
	<?php
   }
}


?>

<!-- <div style="background-color: #e810c7; padding: 5px; text-align: center;" >
      	<h3>Dashboard</h3>
      </div>
      <div style="background-color: #0072bc; padding: 20px; ">
	  <a href="printreceipt.php" style="color: white;" >Print</a>
	         <p style="background-color: grey; padding: 5px;">Incomes </p>
		     <a href="incometype.php" style="color: white;" >Types of Incomes</a>
		     <a href="incomespage.php" style="color: white;" >Add incomes</a>
		      <a href="incomereport.php" style="color: white;" >Income report</a>
              <p style="background-color: grey; padding: 5px;">Expenses </p>
		     <a href="expensetype.php" style="color: white;" >Types of Expenses</a>
		     <a href="expensepage.php" style="color: white;" >Add Expenses</a>
		      <a href="expensereport.php" style="color: white;" >Expenses report</a>
			  <a href="editsales.php" style="color: white;" >Edit Sales</a>
			  <p style="background-color: grey; padding: 5px;">Sales & Stock </p>
			  <a href="stockrecords.php" style="color: white;" >Stock records</a>
			  <a href="daily.php" style="color: white;" >Sales Reports</a>
			  <a href="printreceipt.php" style="color: white;" >Print Receipt</a><br/>
			  <a href="viewreceipt.php" style="color: white;" >Edit Receipt</a>
		 </div>
 -->
