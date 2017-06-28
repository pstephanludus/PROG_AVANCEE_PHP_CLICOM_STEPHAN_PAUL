<?php
session_start();
$titre="Index du site";
require_once('includes\infosBDD.php');
require_once('includes\debut.php');
require_once('includes\menu.php');
echo'<i>Vous êtes ici : </i><a href ="./index.php">Index</a>';
?>