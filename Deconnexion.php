<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/debut.php");
include("includes/menu.php");
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index</a> --> Deconnexion';
if ($id=='') erreur(ERR_IS_NOT_CO);
echo '<p>Vous êtes à présent déconnecté <br />';
if (isset($_SERVER['HTTP_REFERER'])){
	echo 'Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a>
pour revenir à la page précédente.<br />';
}

echo 'Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p></div></body></html>';
?>

