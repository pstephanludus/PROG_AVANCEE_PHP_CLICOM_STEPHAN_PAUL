<doctype html>
<html>
	<head>
		<?php
			echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Forum </title>';
		?>
	</head>
<?php
	$id=(isset($_SESSION['id']))? $_SESSION['id']:'';
	$login=(isset($_SESSION['login']))?$_SESSION['login']:'';
	
	include('./includes/functions.php');
	include('./includes/constants.php');
	
?>