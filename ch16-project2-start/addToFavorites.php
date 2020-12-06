<?php 
session_start();
if(isset($_GET['paintid'])) {
	if(in_array($_GET['paintid'], $_SESSION['paintid'])) {
	} else {
		$_SESSION['paintid'][] = $_GET['paintid'];
		
		$_SESSION['paintfile'][] = $_GET['paintfile'];
		$_SESSION['paintTitle'][] = $_GET['paintTitle'];
		
	}
	header('location: view-favorites.php');
}
?>