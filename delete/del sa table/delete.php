<?php

include('database connection.php');


if(isset($_POST["video_id"]))
{
	$video_id = $_POST['video_id'];
	$statement = $conn->prepare(
		"DELETE FROM classvideo WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$video_id)
		
	    );
}

?>