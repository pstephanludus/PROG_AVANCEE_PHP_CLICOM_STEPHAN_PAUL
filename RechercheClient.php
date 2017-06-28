<?php
session_start();
require_once('includes/InfosBDD.php');
require_once('includes/debut.php');
require_once('includes/menu.php');
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index</a> --> Recherche de clients';
echo '<h1>Recherche de clients</h1>';
if ($id=='') {
	erreur(ERR_IS_NOT_CO);
}
if(!isset($_POST['login'])){
    echo '<form method="post" action="RechercheClient.php">
			<fieldset>
				<legend>Recherche</legend>
				<p>
					<label for="login">Login :</label><input name="login" type="text" id="login" />
				</p>
			</fieldset>
				<p>
					<input type="submit" value="Connexion" />
				</p>
			</form>    
		</div>
    </body>
</html>';
} else {
	$connexion = connect($dsn, USER, PASSWORD);
	$query=$connexion->prepare('SELECT LOGIN, NOM, ADRESSE, LOCALITE, CAT FROM client WHERE LOGIN LIKE "%:login%"');
	$query->bindParam(':login', $_POST['login']);
	$query->execute();
    $query->CloseCursor();
	
	echo "<table border = 5>
			<tr>
				<th align=center>NCLI</th>
				<th align=center>NOM</th>
				<th align=center>ADRESSE</th>
				<th align=center>LOCALITE</th>
				<th align=center>(CAT)</th>
				<th align=center>COMPTE</th>
			</tr>";
	while ($clients = $query->fetch()){
		echo ("<tr>
					<td align=center>".$clients['LOGIN']."</td>
					<td align=center>".$clients['NOM']."</td>
					<td align=center>".$clients['ADRESSE']."</td>
					<td align=center>".$clients['LOCALITE']."</td>
					<td align=center>".$clients['CAT']."</td>
				</tr>");
	}
	echo "</table>";
}