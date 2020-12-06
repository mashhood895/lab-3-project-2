<?php 
session_start();
if(isset($_GET['delete']) && $_GET['delete'] == 'removeall') {
	session_destroy();
	header('location: view-favorites.php');
} else if(isset($_GET['delete']) && $_GET['delete'] == 'singleitem') {
	if(isset($_SESSION['paintid'])) {
		for($i = 0; $i < count($_SESSION['paintid']); $i++) {
			$paintingid = $_GET['paintingid'];
			if($_SESSION['paintid'][$i] == $paintingid) {
				array_splice($_SESSION['paintid'], $i, 1);
				array_splice($_SESSION['paintfile'], $i, 1);
				array_splice($_SESSION['paintTitle'], $i, 1);
			}
		}
	}
	header('location: view-favorites.php');
}