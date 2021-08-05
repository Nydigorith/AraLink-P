<?php

function get_total_all_records()
{
	include('database connection.php');
	$statement = $conn->prepare("SELECT * FROM classvideo");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>