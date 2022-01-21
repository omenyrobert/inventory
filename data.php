<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=inventory", "root", "");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		$data = array(
			':item'		=>	$_POST["item"]
		);

		$query = "
		INSERT INTO stockin 
		(item) VALUES (:item)
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		echo 'done';
	}

	if($_POST["action"] == 'fetch')
	{
		$query = "
		SELECT item, qty AS Total 
		FROM stockin 
		GROUP BY item
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'item'		=>	$row["item"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}


?>