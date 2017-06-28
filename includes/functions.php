<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   if ($err==ERR_IS_CO){
	   exit('<p>'.$mess.'</p>
	   <p>Cliquez <a href="./Deconnexion.php">ici</a> pour vous déconnecter</p>
	   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
	} else if($err==ERR_IS_NOT_CO){
	   exit('<p>'.$mess.'</p>
	   <p>Cliquez <a href="./Connexion.php">ici</a> pour vous connecter</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
	}else{
	   exit('<p>'.$mess.'</p>
	   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
	   }
}
?>