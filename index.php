<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Inventory</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	</head>
<body style="background-color: #f0f6fa;">
	
	
<div class="container-fluid">
<div class="row">
<div class="col-md-6">
<div style="padding: 5vw;">
			<!-- Login Form Starts -->
			<center>
			<form method="POST"  action="login_query.php">	
				<h1 style="color: #000; font-size: 40px;">LOGIN</h1>
				<div style="display: flex; justify-content: space-around;">

				<div class="form-group">
					<label style="color: black;">Username</label><br/>
					<input type="text" name="username"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/>
				</div>
				<div class="form-group">
					<label style="color: black;">Password</label><br/>
					<input type="password" name="password"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/>
				</div>
				<div class="form-group" style="padding-top: 0.5vw;">
					<br/>
				<button style="color: #ffffff; background-color: black; width: 150px; border:none; padding: 10px; border-radius: 50px;" name="login">Login</button>
                </div>
				<?php
					//checking if the session 'error' is set. Erro session is the message if the 'Username' and 'Password' is not valid.
					if(ISSET($_SESSION['error'])){
				?>
				<!-- Display Login Error message -->
					<div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
					//Unsetting the 'error' session after displaying the message. 
					session_unset($_SESSION['error']);
					}
				?><br/>
			
			</form>	
			
			</center>
			<!-- Login Form Ends -->
			<img src="screen1.png" style="width: 100%;">
			<br/><br/>
			<img src="screen2.png" style="width: 100%;">
		</div>

</div>

<div class="col-md-6">
	<img src="backk.png" style="width: 100%;" >
<!-- <div style="background-color: #f2126c; padding-top: 50px; margin-top: 50px; padding-bottom: 100px; "> -->
			<!-- Login Form Starts -->
			<center>
			<!-- <form method="POST"  action="register.php">	
				<h1 style="color: #ffffff; font-size: 40px;">Register</h1>
				<div class="form-group">
					<label style="color: black;">Username</label><br/>
					<input type="text" name="username"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/>
				</div>
				<div class="form-group">
					<label style="color: black;">Password</label><br/>
					<input type="password" name="password" id="myInput"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" required="required"/><br/>
				 <input type="checkbox" onclick="myFunction()"/> show password
				</div>
                 
				<div class="form-group">
					<label style="color: black;">Business Name</label><br/>
					<input type="text" name="businessName"  style=" width: 200px; border:none; padding: 10px; border-radius: 50px;" placeholder="optional"/>
				</div>
                
				<div class="form-group">
					<label style="color: black;">Business Address</label><br/>
					<input type="text" name="address"  style=" width: 250px; border:none; padding: 10px; border-radius: 50px;" placeholder="optional"/>
				</div>

				<div class="form-group">
					<label style="color: black;">Contacts</label><br/>
					<textarea type="text" name="contact"  style=" width: 250px; border:none; height: 100px; padding: 10px; border-radius: 25px;" placeholder="optional"></textarea>
				</div>
				<div class="form-group">
					<label style="color: black;">Short description</label><br/>
					<textarea type="text" name="description"  style=" width: 250px; border:none; height: 100px; padding: 10px; border-radius: 25px;" placeholder="optional"></textarea>
				</div>
				<div class="form-group">
					<label style="color: black;">Role</label><br/>
					<select name="role"  style=" width: 250px; border:none;  padding: 10px; border-radius: 25px;" required="required">
                    <option value="admin">admin</option>
					<option value="user">user</option>
					</select>
					
				</div> -->
				<?php
					//checking if the session 'error' is set. Erro session is the message if the 'Username' and 'Password' is not valid.
					if(ISSET($_SESSION['error'])){
				?>
				<!-- Display Login Error message -->
					<div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
					//Unsetting the 'error' session after displaying the message. 
					session_unset($_SESSION['error']);
					}
				?><br/>
				<!-- <button style="color: #ffffff; background-color: black; width: 220px; border:none; padding: 10px; border-radius: 50px;" name="register">register</button> -->
			</form>	
			<!-- Login Form Ends -->
			</center>
		<!-- </div> -->


</div>

</div>

</div>
	
	</div>

	<script>
		function myFunction(){
			var x=document.getElementById("myInput");
			if(x.type==="password"){
				x.type="text";
			}else{
				x.type ="password";
			}
			}
		</script>
</body>
</html>