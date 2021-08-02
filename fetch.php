<?php
include('db.php');
session_start(); 
$varivari= $_SESSION["classcode"];
$output = array();

$statement = $conn->prepare("SELECT * FROM classsubject WHERE subjectcode ='$varivari'");
$statement->execute();
$result = $statement->fetchAll();
$data = array();
/* $filtered_rows = $statement->rowCount(); */
foreach($result as $row)
{
	$sub_array = array();
	
	$sub_array[] = $row["id"];

	$sub_array[] = $row["subjects"];
	$sub_array[] = $row["subjectcode"];

	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-sm update"></button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
	$data[] = $sub_array;
}
$output = array(
	
	"data"				=>	$data
);
echo json_encode($output);
?>