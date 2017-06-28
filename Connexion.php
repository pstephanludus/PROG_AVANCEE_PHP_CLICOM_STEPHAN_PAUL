<?php
session_start();
require_once('includes/InfosBDD.php');
require_once('includes/debut.php');
require_once('includes/menu.php');
echo '<link rel="stylesheet" type="text/css" href="Formulaire.css"/>';
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index</a> --> Connexion';
echo '<h1>Connexion</h1>';
if ($id!='') {
	erreur(ERR_IS_CO);
}
if(!isset($_POST['login'])){
    echo '<form method="post" action="Connexion.php">
			<fieldset>
				<legend>Connexion</legend>
				<p>
					<label for="login">Login :</label><input name="login" type="text" id="login" /><br />
					<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
				</p>
			</fieldset>
				<p>
					<input type="submit" value="Connexion" />
				</p>
			</form>
			<a href="./Inscription.php">Pas encore inscrit ?</a>     
		</div>
    </body>
</html>';
}
else{
    $message='';
    if (empty($_POST['login']) || empty($_POST['password']) )
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
					Vous devez remplir tous les champs</p>
					<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    } else {
		$connexion = connect($dsn, USER, PASSWORD);
		$query = $connexion->prepare('SELECT LOGIN, PASSWORD, NCLI FROM client WHERE LOGIN = :login');
		$query->bindParam('login',$_POST['login']);
		$query->execute();
		$data=$query->fetch();
		if ($data['PASSWORD'] == md5($_POST['password']))
		{
			$_SESSION['id'] = $data['NCLI'];
			$_SESSION['login']=$data['LOGIN'];
			$message = '<p>Bienvenue '.$_SESSION['login'].', 
            vous êtes maintenant connecté!</p>
            <p>Cliquez <a href="./index.php">ici</a> 
            pour revenir à la page d accueil</p>';  
		} else {
			$message = '<p>Une erreur s\'est produite
						pendant votre identification.<br /> Le mot de passe ou le pseudo
						entré n\'est pas correct.</p><p>Cliquez <a href="./connexion.php">ici</a>        pour revenir à la page précédente
						<br /><br />Cliquez <a href="./index.php">ici</a>
						pour revenir à la page d accueil</p>';
		}
		$query->CloseCursor();

    }
	echo $message.'</div></body></html>';
}
if (isset($_SERVER['HTTP_REFERER']) && isset($_POST['page'])){
	echo '<input type="hidden" name="page" value="<?php echo $_SERVER[\'HTTP_REFERER\']; ?>" />';
	$page = htmlspecialchars($_POST['page']);
	echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';
}
?>