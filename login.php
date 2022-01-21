<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<style type="text/css">
			
					.bod{
	background-color: #101b3c;
	color: white;
}
		</style>
	</head>
<body class="bod">
	
	<div >
	
		<br style="clear:both;"/><br />
		<div>
			<!-- Login Form Starts -->
				<div  style="background-color: black; color: white; height: 200px; margin-top: -100px;" class="container-fluid">
	<h1 class="page-header text-center" style="font-size: 50px;  padding: 50px;">Agape Primary And Nursery School Accounting System</h1>
</div>
			<form method="POST" action="login_query.php" style="margin-left: 500px; margin-top: 50px;">	
				<h1>Login</h1>
				<div class="form-group">
					<label><h1>Username</h1></label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label><h1>Password</h1></label>
					<input type="password" name="password" class="form-control" required="required"/>
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
				?>
				<button style="background-color: black; color: white; width: 160px;" name="login"> Login</button>
			</form>	
			<!-- Login Form Ends -->
		</div>
	</div>
</body>
</html>