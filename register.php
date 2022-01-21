	<?php
	require_once 'connection.php';
	if(ISSET($_POST['register'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$address = $_POST['address'];
		$businessName=$_POST['businessName'];
		$contact = $_POST['contact'];
        $description = $_POST['description'];
        $role=$_POST['role'];
        $set = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $businessId = substr(str_shuffle($set), 0, 8);
		

   

$sql = "INSERT INTO `users` (username ,password, address, businessName, contact, description, role, businessId)
 VALUES ('$username' ,'$password', '$address', '$businessName', '$contact', '$description', '$role','$businessId')";
 
		$conn->query($sql);
				echo "<script>alert('Registration successful!')</script>";
				echo "<script>window.location='index.php'</script>";
		}else{
			echo "<script>alert('Check and make sure you have filled in all the fields correctly')</script>";
			echo "<script>window.location='index.php'</script>";
		}


			?>