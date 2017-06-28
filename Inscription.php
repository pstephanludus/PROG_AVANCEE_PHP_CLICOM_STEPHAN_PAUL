<?php
session_start();
$titre="Inscription";
require_once('includes/InfosBDD.php');
require_once('includes/debut.php');
require_once('includes/menu.php');
echo '<link rel="stylesheet" type="text/css" href="Formulaire.css"/>';
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index</a> --> Enregistrement';
if ($id!=0) erreur(ERR_IS_CO);


if (empty($_POST['login']))
{
	echo '<h1>Inscription 1/2</h1>';
	echo "		<form action='Inscription.php' method='POST'>
					<fieldset>
						<label id=\"label\" for='name'>Votre nom:</label>
						<input id=\"input\" type='text' name='name' maxlength=25/>
						<label id=\"label\" for='adresse'>Votre adresse:<br/></label>
						<label id=\"label\" for='adr_check'>Saisissez bien votre adresse, ou vous risqueriez de ne pas être livré après avoir commandé !</label>
						<input id=\"input\" type='text' name='adresse' maxlength=40/>
						<label id=\"label\" for='localite'>Votre ville:</label>
						<input id=\"input\" type='text' name='localite' maxlength=25/>
						<label id=\"label\" for='categorie'>Sélectionnez votre catégorie<br/></label>
						<select name='categorie'>
							<option value='B1'>B1</option>
							<option value='B2'>B2</option>
							<option value='C1'>C1</option>
							<option value='C2'>C2</option>
						</select>
						<label id=\"label\" for='login'><br/>Login désiré:</label>
						<input id=\"input\" type='text' name='login' maxlength=20/>
						<label id=\"label\" for='password'>Mot de passe désiré:</label>
						<input id=\"input\" type='password' name='password' maxlength=30/>
						<label id=\"label\" for='confirm'>Confirmez le mot de passe:</label>
						<input id=\"input\" type='password' name='confirm' maxlength=30/>
						<input id=\"input\" type='submit' name='Submit' value='Submit' />
					</fieldset>
				</form>
			</body>
		</html>";
} else {
	$name_error_empty = NULL;
	$adresse_error_empty = NULL;
	$localite_error_empty = NULL;
	$categorie_error_unchosen = NULL;
    $login_error_used = NULL;
    $login_error_short = NULL;
    $login_error_long = NULL;
    $pwd_error = NULL;
	
	$name=$_POST['name'];
	$adresse=$_POST['adresse'];
	$localite=$_POST['localite'];
	$categorie=$_POST['categorie'];
	$login=$_POST['login'];
	$password=md5($_POST['password']);
	$confirm=md5($_POST['confirm']);
	
	$connexion = connect($dsn, USER, PASSWORD);
	$query=$connexion->prepare('SELECT COUNT(*) AS nbr FROM client WHERE LOGIN =:login');
	$query->bindParam(':login', $login);
	$query->execute();
    $login_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
	
	$err = 0;
	if($name==''){
		$name_error_empty = NAME_ERROR_EMPTY;
		$err++;
	}
	if($adresse==''){
		$adresse_error_empty = ADRESSE_ERROR_EMPTY;
		$err++;
	}
	if($localite==''){
		$localite_error_empty = LOCALITE_ERROR_EMPTY;
		$err++;
	}
	if($categorie==''){
		$categorie_error_unchosen = CATEGORIE_ERROR_UNCHOSEN;
		$err++;
	}
    if(!$login_free)
    {
        $login_error_used = LOGIN_ERROR_USED;
        $err++;
    }
	if(strlen($login) < 3){
		$login_error_short = LOGIN_ERROR_SHORT;
		$err++;
	}
	if(strlen($login) > 20){
		$login_error_long= LOGIN_ERROR_LONG;
		$err++;
	}
    if ($password != $confirm || empty($confirm) || empty($password))
    {
        $pwd_error = PWD_ERROR;
        $err++;
    }
	
 if ($err==0){
	 $id=rand(0,999);
	 if ($id<10){
		 $id="00".strval($id);
	 } else if ($id<100){
		 $id="0".strval($id);
	 }
	$id=substr($name, 0, 1).$id;
	$query=$connexion->prepare("INSERT INTO `client` (`NCLI`, `LOGIN`, `PASSWORD`, `NOM`, `ADRESSE`, `LOCALITE`, `CAT`, `COMPTE`) VALUES(:id, :login, :password, :name, :adresse, :localite, :cat, 5000)");
	echo "   ".$id."   ".$login."   ".$password."   ".$name."   ".$adresse."   ".$localite."   ".$categorie;
    $query->bindValue(':id', $id);
    $query->bindValue(':login', $login);
    $query->bindValue(':password', $password);
    $query->bindValue(':name', $name);
    $query->bindValue(':adresse', $adresse);
    $query->bindValue(':localite', $localite);
    $query->bindValue(':cat', $categorie);
    $query->execute();
	$query->CloseCursor();
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
    echo'<h1>Inscription terminée</h1>';
    echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['login'])).' vous êtes maintenant inscrit ! </p>
    <p>Cliquez <a href="./Index.php">ici</a> pour revenir à la page d accueil</p>';


} else {
	echo'<h1>Inscription interrompue</h1>';
	echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
	echo'<p>'.$err.' erreur(s)</p>';
	echo'<p>'.$name_error_empty.'</p>';
	echo'<p>'.$adresse_error_empty.'</p>';
	echo'<p>'.$localite_error_empty.'</p>';
	echo'<p>'.$categorie_error_unchosen.'</p>';
	echo'<p>'.$login_error_used.'</p>';
	echo'<p>'.$login_error_short.'</p>';
	echo'<p>'.$login_error_long.'</p>';
	echo'<p>'.$pwd_error.'</p>';
	
	echo'<p>Cliquez <a href="./Inscription.php">ici</a> pour recommencer</p>';
    }
}
?>
</div>
</body>
</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
