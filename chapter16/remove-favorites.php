<?php 
session_start();
if(isset($_GET['action']) && $_GET['action'] == 'removeAllFavourites') {
	session_destroy();
	header('location: view-favorites.php');
} else if(isset($_GET['action']) && $_GET['action'] == 'singleFavorite') {
	if(isset($_SESSION['paintingID'])) {
		for($a = 0; $a < count($_SESSION['paintingID']); $a++) {
			$id = $_GET['id'];
			if($_SESSION['paintingID'][$a] == $id) {
				array_splice($_SESSION['paintingID'], $a, 1);
				array_splice($_SESSION['fileName'], $a, 1);
				array_splice($_SESSION['Title'], $a, 1);
			}
		}
	}
	header('location: view-favorites.php');
}