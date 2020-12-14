<?php 
@session_start();
if(isset($_GET['id']) ) {
	if(isset($_SESSION['paintingID'])) {
	if(in_array($_GET['id'], $_SESSION['paintingID'])) {
	} else {
		$_SESSION['paintingID'][] = $_GET['id'];
		$_SESSION['Title'][] = $_GET['title'];
		$_SESSION['fileName'][] = $_GET['file'];
	}
} else {
	$_SESSION['paintingID'][] = $_GET['id'];
		$_SESSION['Title'][] = $_GET['title'];
		$_SESSION['fileName'][] = $_GET['file'];
}
	@header('location: view-favorites.php');
}
?>