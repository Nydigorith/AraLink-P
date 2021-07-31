<?php
include 'connection.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$titles=$_POST['titles'];
		$subjects=$_POST['subjects'];
		$dates=$_POST['dates'];
		$links=$_POST['links'];
		$linkcode=$_POST['linkcode'];
		$sql = "INSERT INTO `classvideo`( `titles`, `subjects`,`dates`,`links`,`linkcode`) 
		VALUES ('$titles','$subjects','$dates','$links','$linkcode')";
		if (mysqli_query($con, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$titles=$_POST['titles'];
		$subjects=$_POST['subjects'];
		$dates=$_POST['dates'];
		$links=$_POST['links'];
		$linkcode=$_POST['linkcode'];
		$sql = "UPDATE `classvideo` SET `titles`='$titles',`subjects`='$subjects',`dates`='$dates',`links`='$links',`linkcode`='$linkcode'WHERE id=$id"; 
		if (mysqli_query($con, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `classvideo` WHERE id=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM 'classvideo' WHERE id in ($id)";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}

?>