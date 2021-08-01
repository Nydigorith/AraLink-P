<?php

 session_start(); 
include('db.php');

$varivari= $_SESSION["classcode"];
/* $sclasscode = $_SESSION["classcode"]; */



/* function get_total_all_records()
{
	include('db.php');
	$query = $conn->prepare("SELECT * FROM classvideo " );
	$query->execute();
	$result = $query->fetchAll();
	return $query->rowCount();
} */


$statement = '';
$output = array();
$statement .= "SELECT * FROM classvideo WHERE linkcode ='$varivari' ";
if(isset($_POST["search"]["value"]))
{
	$statement .= 'AND titles LIKE "%'.$_POST["search"]["value"].'%" ';
	/* $statement .= 'AND dates LIKE "%'.$_POST["search"]["value"].'%" '; */
}

$query = $conn->prepare($statement);/* "SELECT * FROM classvideo WHERE linkcode ='$varivari'" */
$query->execute();
$result = $query->fetchAll();
$data = array();
$filtered_rows = $query->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	
	$sub_array[] = $row["id"];
	$sub_array[] = $row["titles"];
	$sub_array[] = $row["subjects"];
	$sub_array[] = $row["dates"];
	$sub_array[] = $row["links"];
	$sub_array[] = $row["linkcode"];

	$sub_array[] = '<button type="button"  name="update" id="'.$row["id"].'" class="btn btn-primary btn-sm update"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
	$sub_array[] = '<button type="button"  name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
	$data[] = $sub_array;
}


$output = array(
/* 	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(), */
	"data"				=>	$data
);
echo json_encode($output);
exit;
?>