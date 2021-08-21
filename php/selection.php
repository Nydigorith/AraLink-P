<?php
 session_start();
if (isset($_GET['subject'])) {
	$subject=$_GET['subject'];
	$selected = $subject;
	$_SESSION['selected'] = $selected;	
	}