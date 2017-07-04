<?php
	include('dbproperties.php');
	$connexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if($connexion->error)
		echo "Erreur de connection : ".$connexion->error;
	else
	{
		echo 'Connexion effectue avec succes</br>';

	/*******************************************	CREATION DE  CLASSE 	************************************************************/
		$req = <<<SQL
		CREATE TABLE `classe`(
			`id` INT(3) NOT NULL AUTO_INCREMENT,
			`departement` VARCHAR(70) NOT NULL,
			`vaccation` VARCHAR(7) NOT NULL,
			`annee` INT(2) NOT NULL,
			`position` VARCHAR(1),
			`email` VARCHAR(100) UNIQUE NOT NULL,
			`id_administrateur` INT(6),
			PRIMARY KEY(`id`)

		)
SQL;
	if($connexion->query($req))
		echo 'Table classe creer avec succes</br>';
	else
		echo 'Erreur dans la creation de  classe</br>';
	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  UTILISATEUR 	********************************************************/
		$req1 = <<<SQL
		CREATE TABLE `utilisateur`(
			`id` INT(5) NOT NULL AUTO_INCREMENT,
			`pseudo` VARCHAR(20) UNIQUE NOT NULL,
			`nom` VARCHAR(80) NOT NULL,
			`prenom` VARCHAR(100) NOT NULL,
			`email` VARCHAR(100) UNIQUE NOT NULL,
			`type` VARCHAR(15) NOT NULL,
			`id_classe` INT(3),
			`mot_de_passe` VARCHAR(50) NOT NULL,
			`telephone` VARCHAR(11) UNIQUE NOT NULL,
			PRIMARY KEY(`id`)
			)
SQL;
if($connexion->query($req1))
		echo 'Table utilisateur creer avec succes</br>';
	else
		echo 'Erreur dans la creation de  utilisateur</br>';
	
	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  COMMENTAIRE 	********************************************************/
	$req2 = <<<SQL
	CREATE TABLE `commentaire` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT,
  	`id_publication` INT(11) NOT NULL,
  	`id_utilisateur` INT(11) NOT NULL,
  	`date` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  	`contenu` TEXT NOT NULL,
  	PRIMARY KEY(`id`)
    )
SQL;
	
	if($connexion->query($req2))
		echo 'Table Commentaire creer avec succes </br>';
	else
		echo 'Erreur dans la creation de  commentaire</br>';

	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  MESSAGE FORUM 	********************************************************/
	
	$req3 = <<<SQL
	CREATE TABLE `message_forum` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_sujet` INT(11) NOT NULL,
  `id_utilisateur` INT(5) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `contenu` TEXT NOT NULL,
  	PRIMARY KEY(`id`)
	)
SQL;
	if($connexion->query($req3))
		echo 'Table Message Forum Creer avec succes</br>';
	else
		echo 'Erreur de creation de  Message Forum</br>';

	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  MESSAGE PRIVE 	********************************************************/
	$req4 = <<<SQL
	CREATE TABLE `message_prive` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user_sent` INT(5) NOT NULL,
  `id_user_receive` INT(5) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `contenu` TEXT NOT NULL,
  	PRIMARY KEY(`id`)
	)
SQL;
	if($connexion->query($req4))
		echo 'Table Message Prive Creer avec succes</br>';
	else
		echo 'Erreur de creation de  Message Prive</br>';

	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  PUBLCATION 	********************************************************/
	
	$req5 = <<<SQL
	CREATE TABLE `publication` (
 	`id` INT(11) NOT NULL AUTO_INCREMENT,
  	`id_utilisateur` INT(5) NOT NULL,
  	`date` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  	`contenu` TEXT NOT NULL,
  	`categorie` VARCHAR(25),
  	PRIMARY KEY(`id`)
	)
SQL;
	if($connexion->query($req5))
		echo 'Table Publication Creer avec succes</br>';
	else
		echo 'Erreur de creation de  Publication</br>';
	/***********************************************************************************************************************************/
	/*******************************************	CREATION DE  SUJET FORUM 	********************************************************/
	
	$req6 = <<<SQL
	CREATE TABLE `sujet_forum` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT,
  	`categorie` VARCHAR(25) NOT NULL,
  	`contenu` TEXT NOT NULL,
  	`date` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  	`id_utilisateur` INT(5) NOT NULL,
  	PRIMARY KEY(`id`)
) 

SQL;
	if($connexion->query($req6))
		echo 'Table Sujet Forum Creer avec Succes </br>';
	else
		echo 'Erreur dans la creatiuon de  Sujet Forum';


	/***********************************************************************************************************************************/
	/***********************************************	CREATION DE  AUDIO 	***********************************************************/

	$req14 = <<<SQL
	CREATE TABLE `audio` (
 	 `id` INT(11) NOT NULL AUTO_INCREMENT,
  	`nom` INT(11) NOT NULL,
  	`auteur` VARCHAR(100) NOT NULL,
  	`longueur` TIME NOT NULL,
  	`matiere` VARCHAR(100) NOT NULL,
  	`extension` VARCHAR(8) NOT NULL,
  	`lien` VARCHAR(255) UNIQUE NOT NULL,
  	`lien_temporaire` VARCHAR(255) NOT NULL,
  	PRIMARY KEY(`id`)
	) 
SQL;
	if($connexion->query($req14))
		echo 'Table Audio creer avec succes </br>';
	else
		echo 'Erreur dans la creation de la table Audio';
	
	/***********************************************************************************************************************************/
	/***********************************************	CREATION DE  FORMATION 	*******************************************************/
	$req17 = <<<SQL
	CREATE TABLE `formation` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT,
  	`nom` VARCHAR(50) NOT NULL,
  	`contenu` VARCHAR(100) NOT NULL,
  	`quantite` INT(11) NOT NULL,
  	`lien` VARCHAR(255) UNIQUE NOT NULL,
  	`lien_temporaire` VARCHAR(255) NOT NULL,
  	`extension` VARCHAR(8) NOT NULL,
  	`matiere` VARCHAR(100) NOT NULL,
  	PRIMARY KEY(`id`)
)
SQL;
	if($connexion->query($req17))
		echo 'Table Formation creer avec succes </br>';
	else
		echo 'Erreur dans la creation de la table Formation ';
	/***********************************************************************************************************************************/
	/***********************************************	CREATION DE  LIVRE 	************************************************************/
	$req18 = <<<SQL
	CREATE TABLE `livre` (
  	`id` INT(6) NOT NULL AUTO_INCREMENT,
  	`isbn` INT(11) NOT NULL,
  	`nom` VARCHAR(100) NOT NULL,
  	`auteur` VARCHAR(100) NOT NULL,
  	`domaine` VARCHAR(100) NOT NULL,
  	`collection` VARCHAR(100) NOT NULL,
  	`nombre_de-page` INT(3) NOT NULL,
  	`matiere` VARCHAR(100) NOT NULL,
  	`lien` VARCHAR(255) NOT NULL,
  	`anne_sortie` INT(4) NOT NULL,
  	`lien_temporaire` VARCHAR(255) NOT NULL,
  	PRIMARY KEY(`id`)
)
SQL;
	if($connexion->query($req18))
		echo 'Table Livre creer avec succes </br>';
	else
		echo 'Erreur dans la creation de la table Livre ';
	/***********************************************************************************************************************************/
	/***********************************************	CREATION DE  LOGICIEL 	********************************************************/
	$req19 = <<<SQL
	CREATE TABLE `logiciel` (
  	`id` INT(4) NOT NULL AUTO_INCREMENT,
  	`nom` VARCHAR(100) NOT NULL,
  	`version` VARCHAR(100) NOT NULL,
  	`size` BIGINT(20) NOT NULL,
  	`type` VARCHAR (15) NOT NULL,
  	`domaine` VARCHAR(100) NOT NULL,
  	`matiere` VARCHAR(100) NOT NULL,
  	`lien` VARCHAR(255) NOT NULL,
  	PRIMARY KEY(`id`)
)
SQL;
	if($connexion->query($req19))
		echo 'Table Logiciel creer avec succes </br>';
	else
		echo 'Erreur dans la creation de la table Logiciel ';
	/***********************************************************************************************************************************/
	/***************************************************	CREATION DE  VIDEO 	********************************************************/

	$req20 = <<<SQL
	CREATE TABLE `video` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT,
  	`nom` VARCHAR(100) NOT NULL,
  	`extension` VARCHAR(8) NOT NULL,
  	`lien` VARCHAR(255) NOT NULL,
  	`matiere` VARCHAR(100) NOT NULL,
  	`lien_temporaire` VARCHAR(255) NOT NULL,
  	`longueur` TIME NOT NULL,
  	`auteur` VARCHAR(100) NOT NULL,
  	PRIMARY KEY(`id`)
)
SQL;
	if($connexion->query($req20))
		echo 'Table Logiciel creer avec succes </br>';
	else
		echo 'Erreur dans la creation de la table video ';
	/***********************************************************************************************************************************/


	/***************************************************************************************************************************************/
	/*************************************************   	AJOUT DE CLEFS SECONDAIRES 	****************************************************/
	$req7 = <<<SQL
	ALTER TABLE `classe`
	ADD CONSTRAINT `Classe_ibfk_2` FOREIGN KEY (`id_administrateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;

	$req8 = <<<SQL
	ALTER TABLE `commentaire`
	ADD CONSTRAINT `Commentaire_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `Commentaire_ibfk_2` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
	$req9 = <<<SQL
	ALTER TABLE `message_forum`
	ADD CONSTRAINT `Message_forum_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `Message_forum_ibfk_2` FOREIGN KEY (`id_sujet`) REFERENCES `sujet_forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
	$req10 = <<<SQL
	ALTER TABLE `message_prive`
	ADD CONSTRAINT `Message_prive_ibfk_1` FOREIGN KEY (`id_user_sent`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `Message_prive_ibfk_2` FOREIGN KEY (`id_user_receive`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
	$req11 =  <<<SQL
	ALTER TABLE `publication`
	ADD CONSTRAINT `Publication_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
	$req12 = <<<SQL
	ALTER TABLE `sujet_forum`
	ADD CONSTRAINT `Sujet_forum_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
	$req13 = <<<	SQL
	ALTER TABLE `utilisateur`
	ADD CONSTRAINT `Utilisateur_ibfk_1` FOREIGN KEY (`id_Classe`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;

	if($connexion->query($req7) && $connexion->query($req8) && $connexion->query($req9) && $connexion->query($req10) 
		&& $connexion->query($req11) && $connexion->query($req12) && $connexion->query($req13))
		echo 'Ajout des clefs secondaires fait avec succes';
	else
		echo 'Erreur dans l\'ajout des clefs secondaires';


	$connexion->close();
	}


?>


