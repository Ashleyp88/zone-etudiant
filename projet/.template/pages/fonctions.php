<?php
/**SIGNIFICATION DES VALEURS DE RETOURS	
*	-10	:	ERREUR PSEUDO INEXISTANT
*	-1	:	ERREUR EMAIL INEXISTANT
*	-2	:	ERREUR TELEPHONE INEXISTANT
*	-101:	ERREUR PSEUDO INEXISTANT ET EMAIL INEXISTANT
*	-3	:	ERREUR TENTATIVE DE DUPLICATION D'EMAIL
*	-4	:	ERREUR TENTATIVE DE DUPLICATION DE PSEUDO
*	-5	:	ERREUR TENTATIVE DE DUPLICATION DE TELEPHONE
*	-34	:	ERREUR TENTATIVE DE DUPLICATION D'EMAIL ET DE PSEUDO
*	-35	:	ERREUR TENTATIVE DE DUPLICATION D'EMAIL ET DE TELEPHONE
*	-45	:	ERREUR TENTATIVE DE DUPLICATION DE PSEUDO ET DE TELEPHONE
*	-345:	ERREUR TENTATIVE DE DUPLICATION DE PSEUDO, DE TELEPHONE ET D'EMAIL
*	 1	:	TOUT C'EST PASSER SANS PROBLEME
*	 0	:	OPERATION NON REUSSIE
*	-22	:	ERREUR DE CONNEXION
**/
function afficher_erreur($valeur)
{
	$message=0;
	switch ($valeur) {
		case -10:
			$message ="ERREUR PSEUDO INEXISTANT";
			break;
		case -1:
			$message="ERREUR EMAIL INEXISTANT";
			break;
		case -2:
			$message="ERREUR TELEPHONE INEXISTANT";
			break;
		case -101:
			$message="ERREUR PSEUDO INEXISTANT ET EMAIL INEXISTANT";
			break;
		case -3:
			$message="ERREUR TENTATIVE DE DUPLICATION D'EMAIL";
			break;
		case -4:
			$message="ERREUR TENTATIVE DE DUPLICATION DE PSEUDO";
			break;
		case -5:
			$message="ERREUR TENTATIVE DE DUPLICATION DE TELEPHONE";
			break;
		case -34:
			$message="ERREUR TENTATIVE DE DUPLICATION D'EMAIL ET DE PSEUDO";
			break;
		case -35:
			$message="ERREUR TENTATIVE DE DUPLICATION D'EMAIL ET DE TELEPHONE";
			break;
		case -345:
			$message="ERREUR TENTATIVE DE DUPLICATION DE PSEUDO, DE TELEPHONE ET D'EMAIL";
			break;
		case -22:
			$message="ERREUR DE CONNEXION";
			break;
		case 0:
			$message="ERREUR OPERATION NON REUSSIE";
			break;
		default:
			# code...
			break;
	}
	return $message;
}
include 'dbproperties.php';
$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if(mysqli_error($connexion))
	die('Erreur de connection</br>');
/**************************************************	FONCTIONS SUR LES CLASSES *************************************************************/
//AJOUTER UNE CLASSE AVEC LES INFORMATIONS OBLIGATOIRES UNIQUEMENT
//VERIFIER L'EXISTANCE D'UN EMAIL DE CLASSE
function verifier_existence_email_classe($email)
{
	addslashes($email);
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM classe WHERE email='$email'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}

function ajouter_classe($departement, $vaccation, $annee, $position, $email)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('departement', 'vaccation', 'position', 'email') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "INSERT INTO classe(departement, vaccation, annee, position, email) VALUES ('$departement', '$vaccation', $annee, '$position', '$email')";
	if(verifier_existence_email_classe($email)!=0)
	{
		return -3;
	}
	if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}	
}

//MODIFIER L'ADMINISTRATEUR D'UNE CLASSE EN CONNAISSANT LE PSEUDO DU NOUVEAU ADMINISTRATEUR
function modifier_administrateur_classe($pseudo_administrateur, $email_classe)
{
	
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo_administrateur', 'email_classe') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "UPDATE classe SET id_administrateur=(SELECT id from utilisateur where pseudo='$pseudo_administrateur') WHERE email='$email_classe'";
	
	if(verifier_existence_pseudo($pseudo_administrateur)==0 AND verifier_existence_email_classe($email_classe)==0)
	{
		return -101;
	}
	else if(verifier_existence_email_classe($email_classe)==0)
	{
		return -1;
	}
	else if(verifier_existence_pseudo($pseudo_administrateur)==0)
	{
		return -10;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}

}
//PERMET DE TROUVER L'ADMINISTRATEUR D'UNE CLASSE AVEC SON EMAIL ELLE LE PSEUDI DE L'ADMINISTRATEUR
function chercher_administrateur_classe($email_classe)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur de connexion");
	$req = "SELECT pseudo FROM utilisateur WHERE id=(SELECT id_administrateur FROM classe WHERE email='$email_classe')";
	if(verifier_existence_email_classe($email_classe)==0)
	{
		return -1;
	}
	else if($resulat = mysqli_query($connexion, $req))
	{
		while($ligne = mysqli_fetch_assoc($resulat))
			return $ligne['pseudo'];
	}
	else
		return 0;
}

/*******************************************************************************************************************************************/
/**************************************************	FONCTIONS SUR LES UTILISATEURS *********************************************************/
//AJOUTER UN NOUVEAU UTILISATEUR AVEC LES INFORMATIONS OBLIGATOIRES UNIQUEMENT
function ajouter_utilisateur($nom, $prenom, $pseudo, $email, $mot_de_passe, $telephone)
{
	
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('nom', 'prenom', 'email', 'mot_de_passe', 'telephone') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "INSERT INTO utilisateur(nom, prenom, pseudo, email, mot_de_passe, telephone) VALUES 
		('$nom', '$prenom', '$pseudo', '$email', '$mot_de_passe', '$telephone')";
	if(verifier_existence_pseudo($pseudo)!=0 AND verifier_existence_telephone($telephone)!=0 AND verifier_existence_email($email)!=0)
	{
		return -345;
	}
	else if(verifier_existence_pseudo($pseudo)!=0 AND verifier_existence_telephone($telephone)!=0)
	{
		return -45;
	}
	else if(verifier_existence_telephone($telephone)!=0 AND verifier_existence_email($email)!=0)
	{
		return -35;
	}
	else if(verifier_existence_pseudo($pseudo)!=0 AND verifier_existence_email($email)!=0)
	{
		return -34;
	}
	else if (verifier_existence_email($email)!=0) {
		return -3;
	}
	else if (verifier_existence_pseudo($pseudo)!=0) {
		return -4;
	}
	else if (verifier_existence_telephone($telephone)!=0) {
		return -5;
	}
	else if(mysqli_query($connexion, $req))
	{
		return 1;
	}
	else
		return 0;
	
}
//MODIFIER LE TYPE D'UN UTILISATEUR EN CONNAISSANT SON PSEUDO
function modifier_type_utilisateur($pseudo, $type)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'type') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	
	$req = "UPDATE utilisateur set type='$type' WHERE pseudo='$pseudo'";
	if(verifier_existence_pseudo($pseudo)==0)
	{
		return -10;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//MODIFIER LE PSEUDO D'UN UTILISATEUR EN CONNAISSANT L'ANCIEN PSEUDO
function modifier_pseudo_utilisateur($ancien_pseudo, $nouveau_pseudo)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('ancien_pseudo', 'nouveau_pseudo') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "UPDATE utilisateur set pseudo='$nouveau_pseudo' WHERE pseudo='$ancien_pseudo'";
	if(verifier_existence_pseudo($ancien_pseudo)==0)
	{
		return -10;
	}
	else if(verifier_existence_pseudo($nouveau_pseudo)!=0)
	{
		return -4;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//MODIFIER LE EMAIL D'UN UTILISATEUR EN CONNAISSANT SON PSEUDO
function modifier_email_utilisateur($pseudo, $nouveau_email)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'nouveau_mail') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "UPDATE utilisateur set email='$nouveau_email' WHERE pseudo='$pseudo'";
	if(verifier_existence_pseudo($pseudo)==0)
	{
		return -10;
	}
	else if(verifier_email_utilisateur($nouveau_email)!=0)
	{
		return -3;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//MODIFIER LE TELEPHONE D'UN UTILISATEUR EN CONNAISSANT SON PSEUDO
function modifier_telephone_utilisateur($pseudo, $nouveau_telephone)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'nouveau_telephone') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "UPDATE utilisateur set telephone='$nouveau_telephone' WHERE pseudo='$pseudo'";
	if(verifier_existence_pseudo($pseudo)==0)
	{
		return -10;
	}
	else if(verifier_telephone_utilisateur($nouveau_telephone)!=0)
	{
		return -5;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}

//REMPLACER L'EMAIL D'UN UTILISATEUR PAR UN AUTRE
function remplacer_email_utilisateur($ancien_email, $nouveau_email)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('ancien_mail', 'nouveau_mail') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}

	$req = "UPDATE utilisateur set email='$nouveau_email' WHERE pseudo='$ancien_email'";
	if(verifier_email_utilisateur($ancien_email)==0)
	{
		return -1;
	}
	else if(verifier_email_utilisateur($nouveau_email)!=0)
	{
		return -3;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//REMPLACER LE TELEPHONE D'UN UTILISATEUR PAR UN AUTRE
function remplacer_telephone_utilisateur($ancien_telephone, $nouveau_telephone)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('ancien_telephone', 'nouveau_telephone') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	
	$req = "UPDATE utilisateur set telephone='$nouveau_telephone' WHERE telephone='$ancien_telephone'";
	if(verifier_telephone_utilisateur($ancien_telephone)==0)
	{
		return -2;
	}
	else if(verifier_telephone_utilisateur($nouveau_telephone)!=0)
	{
		return -5;
	}
	if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//CHANGER LE MOT DE PASSE D'UN UTILISATEUR
function changer_mot_de_passe_utilisateur($pseudo, $ancien_mot_de_passe, $nouveau_mot_de_passe)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'ancien_mot_de_passe', 'nouveau_mot_de_passe') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	$req = "UPDATE utilisateur set mot_de_passe='$nouveau_mot_de_passe' WHERE pseudo='$pseudo'";
	if(verifier_existence_pseudo($pseudo)==0)
	{
		return -10;
	}
	else if(authentifier_utilisateur($pseudo, $ancien_mot_de_passe)==0)
	{
		return 0;
	}
	else if(mysqli_query($connexion, $req))
	{
		mysqli_close($connexion);
		return 1;
	}
	else
	{
		mysqli_close($connexion);
		return 0;
	}
}
//VERIFIER L'EXISTENCE DUN UTILISATEUR
function verifier_existence_pseudo($pseudo)
{
	addslashes($pseudo);
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE pseudo='$pseudo'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//VERIFIER L"EXIstENCE D'UN ADRESSE EMAIL
function verifier_existence_email($email)
{
	addslashes($email);
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE email='$email'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//VERIFIER L'EXISTENCE D'UN NUMERO DE TELEPHONE
function verifier_existence_telephone($telephone)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE telephone='$telephone'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//VERIFIER L'EMAIL D'UN UTILISATEUR
function verifier_email_utilisateur($pseudo, $email)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'email') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE pseudo='$pseudo' AND email='$email'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//VERIFIER LE TELEPHONE D'UN UTILISATEUR
function verifier_telephone_utilisateur($pseudo, $utilisateur)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE pseudo='$pseudo' AND telephone='$telephone'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//AUTHENTIFIER UN UTILISATEUR
function authentifier_utilisateur($pseudo, $mot_de_passe)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	foreach (array('pseudo', 'mot_de_passe') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT * FROM utilisateur WHERE pseudo='$pseudo' AND mot_de_passe='$mot_de_passe'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i++;

	return $i;
}
//CETTE FONCTION PERMET DE RECHERCHER UNE INFORMATION QUELCONQUE SUR UN UTILISTEUR MAIS ELLE NE RENVOIE QUE ZERO EN CAS D'ERREUR
function chercher_info_utilisateur($pseudo, $info)
{

	addslashes($pseudo);
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

	if(mysqli_error($connexion))
		die("Erreur Connection");
	$req = "SELECT $info FROM utilisateur WHERE pseudo='$pseudo'";
	$i=0;
	if($resultat = mysqli_query($connexion, $req))
		while($ligne = mysqli_fetch_assoc($resultat))
			$i = $ligne[$info];

	return $i;
}
/********************************************************************************************************************************************/
/*****************************************************	FONCTIONS SUR LES PUBLICATIONS ******************************************************/
//PERMET D'AJOUTER UNE PUBLICATION CETTE FONCTIION RETOURNE L'ID DE LA PUBLICATION EN QUESTION
function ajouter_une_publication($pseudo, $contenu, $categorie)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur de connexion");
	foreach (array('pseudo', 'contenu', 'categorie') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	$id_utilisateur = chercher_info_utilisateur($pseudo, "id");
	$req = "INSERT INTO publication(id_utilisateur, contenu, categorie) VALUES ('$id_utilisateur', '$contenu', '$categorie')";

	if($id_utilisateur == 0)
	{
		return -10;
	}
	else if(mysqli_query($connexion, $req))
	{
		$req = "SELECT MAX(id) FROM publication";
		if($resultat = mysqli_query($connexion, $req))
		{
			while($ligne = mysqli_fetch_assoc($resultat))
				return $ligne['MAX(id)'];				
		}
		else
			return 0;
	}
	else
	{
		return 0;
	}
}

function selectioner_dernieres_publications($quantite)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die('Erreur de connection');
	$req = "SELECT titre, contenu FROM publication WHERE id>((SELECT MAX(id) FROM publication)-$quantite)";
	$resultat = 0;
	if($resultat = mysqli_query($connexion, $req)){}
		
	return $resultat;
}
/********************************************************************************************************************************************/
/*****************************************************	FONCTIONS SUR LES COMMENTAIRES ******************************************************/
//PERMET D'AJOUTER UNE PUBLICATION CETTE FONCTIION RETOURNE L'ID DE LA PUBLICATION EN QUESTION
function ajouter_un_commentaire($pseudo, $id_publication, $contenu)
{

	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
		die("Erreur de connexion");
	foreach (array('pseudo', 'contenu', 'contenu') as $champ) {
		$$champ = $connexion->real_escape_string($$champ);
	}
	$id_utilisateur = chercher_info_utilisateur($pseudo, "id");
	$req = "INSERT INTO commentaire(id_utilisateur, id_publication, contenu) VALUES ('$id_utilisateur', '$id_publication', '$contenu')";

	if($id_utilisateur == 0)
	{
		return -10;
	}
	else if(mysqli_query($connexion, $req))
	{
		$req = "SELECT MAX(id) FROM commentaire";
		if($resultat = mysqli_query($connexion, $req))
		{
			while($ligne = mysqli_fetch_assoc($resultat))
				return $ligne['MAX(id)'];				
		}
		else
			return 0;
		
	}
	else
	{
		return 0;
	}
}

function nombre_de_commentaire_sur_publication($id_publication)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
	{
		die("Erreur de connexion");
	}
	$req = "SELECT COUNT(id) FROM commentaire WHERE id_publication='$id_publication'";
	if($resultat = mysqli_query($connexion, $req))
	{
		while($ligne = mysqli_fetch_assoc($resultat))
			return $ligne['COUNT(id)'];
	}
	else
		return 0;
}
/********************************************************************************************************************************************/
/*****************************************************	FONCTIONS SUR LES LOGICIELS ******************************************************/
function ajouter_logiciel($nom, $version, $size, $type, $lien)
{
	$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if(mysqli_error($connexion))
	{
		die("Erreur de connection");
	}

	$req = "INSERT INTO logiciel(nom, version, size, type, lien) VALUES ('$nom', '$version', '$size', '$type', '$lien')";
	if(mysqli_query($connexion, $req))
	{
		return 1;	
	}
	else
		return 0;
}

///function verifier_existence_lien()

?>