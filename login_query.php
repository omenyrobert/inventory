<?php
     session_start();
    
  include_once('connection.php');
  
  if (isset($_POST['login'])) {

      $errorMsg = "";

      $username = $conn->real_escape_string($_POST['username']);
      $password = $conn->real_escape_string(md5($_POST['password']));
      
  if (!empty($username) || !empty($password)) {
        $query  = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['ID'] = $row['userId'];
			$_SESSION['businessId'] = $row['businessId'];
            $_SESSION['ROLE'] = $row['role'];
            $_SESSION['USERNAME'] = $row['username'];
          }
            if ($_SESSION['ROLE'] == 'admin'){
              header("Location:dashboard.php");
              die(); 
            }

           if ($_SESSION['ROLE'] == 'user'){
              header("Location:dashboard.php");
              die(); 
            }                      
        }else{
			echo "<script>alert('Wrong Username or password')</script>";
			echo "<script>window.location='index.php'</script>";
        } 
    }else{
		echo "<script>alert('Unknown User')</script>";
		echo "<script>window.location='index.php'</script>";
    }


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Multi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
        .bod{
  background-color: #101b3c;
  color: white;
}
  </style>
</head>
<body style="background: url('bag.jpg') no-repeat;
        background-size: cover; color: white;

         background-position: center;background-color: white; font-size: 40px; padding: 20px;
       ">

<div class="container-fluid">
  <br/>
  <center>
  <h1 style="font-size: 40px; padding: 20px; width: 700px; background-color: black; opacity: .8; padding: 20px; ">CHURCH MANAGEMENT SYSTEM</h1>
</center>
</div><br/>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
        <div class="container" style=" background-color: black; opacity: .8; font-size: 28px; padding: 50px;
       " >

<center>
  <h2>Login </h2>
        <form action="" method="POST">
          <div class="form-group">  
            <label for="username">Username:</label> 
            <input type="text" class="form-control" name="username" placeholder="Enter Username" >
          </div><br/>
          <div class="form-group">  
            <label for="password">Password:</label> 
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div><br/>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Login"> 
          </div>
        </form>
      </center>
    </div>
      </div>
  </div>
</div>
</body> -->
</html>

