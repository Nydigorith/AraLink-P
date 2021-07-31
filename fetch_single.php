<?php
include('db.php');
/* include('function.php'); */
if(isset($_POST["video_id"]))
{
	$output = array();
	$video_id = $_POST['video_id'];
	$statement = $conn->prepare(
		"SELECT * FROM classvideo WHERE id = :id LIMIT 1"
	);
	$statement->execute([':id'	=>	$video_id]);
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["id"] = $row["id"];
		$output["titles"] = $row["titles"];
		$output["subjects"] = $row["subjects"];
		$output["dates"] = $row["dates"];
		$output["links"] = $row["links"];
		$output["linkcode"] = $row["linkcode"];
		
	}
	echo json_encode($output);
}
?>