<?php
include('db.php');

/* include('function.php'); */
if(isset($_POST["video_operation"]))
{
	if($_POST["video_operation"] == "Add")
	{
		$titles=$_POST['titles'];
		$subjects=$_POST['subjects'];
		$dates=$_POST['dates'];
		$links=$_POST['links'];
		$linkcode=$_POST['linkcode'];

		$statement = $conn->prepare("
			INSERT INTO classvideo (titles, subjects, dates, links, linkcode) VALUES (:titles, :subjects, :dates, :links, :linkcode)");
		$result = $statement->execute(
			array(
				':titles'	=>	$titles,
				':subjects'	=>	$subjects,
				':dates'	=>	$dates,
				':links'	=>	$links,
				':linkcode'	=>	$linkcode
			)
		);
	}
	if($_POST["video_operation"] == "Edit")
	{
		$titles=$_POST['titles'];
		$subjects=$_POST['subjects'];
		$dates=$_POST['dates'];
		$links=$_POST['links'];
		$linkcode=$_POST['linkcode'];
		$video_id = $_POST['video_id'];
		
		$statement = $conn->prepare(
			"UPDATE classvideo
			SET titles = :titles, subjects = :subjects, dates = :dates, links = :links, linkcode = :linkcode WHERE id = :id");
		$result = $statement->execute(
			array(
				':titles'	=>	$titles,
				':subjects'	=>	$subjects,
				':dates'	=>	$dates,
				':links'	=>	$links,
				':linkcode'	=>	$linkcode,
				':id'		=>	$video_id
			)
		);
	}
} else {

if(isset($_POST["video_id"]))
{
	$video_id = $_POST['video_id'];
	$statement = $conn->prepare(
		"DELETE FROM classvideo WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$video_id)
		
	    );
}}
?>