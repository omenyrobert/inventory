<?php
	include_once('connection.php');

  if (isset($_POST['saveprofits'])) {
    foreach ($profits=$_POST['profits']) {
        
        // save to database
        $query = "INSERT INTO profits (profits)values('$profits')";
        $run = $conn->query($query) or die("Error in saving image".$conn->error);
    }
    if ($result) {
        echo '<script>alert(" successfully !")</script>';
        echo '<script>window.location.href="dashboard.php";</script>';
    }
}
?>
