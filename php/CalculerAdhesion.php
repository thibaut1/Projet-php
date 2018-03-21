<?php

spl_autoload_extensions(".php");
spl_autoload_register();
date_default_timezone_set('Europe/Paris');
// on se branche sur le fournisseur de donnée avec utilisateur du serveur souhaité
$dbConnexion = new Database('192.168.209.25', 'admin3', 'azerty', 'bibligrp3');

// définition des constantes fournies dans le cahier des charges
// pour traiter le cas des majeurs et celui des mineurs
define("agelim", 18);
// les diff�rents prix
define("gratuit", 0);
define("prixJeuneSect", 7.5);
define("PrixJeuneHorsSect", 15);
define("PrixDomi", 7.5);
define("PrixSect", 15);
define("PrixHorsSect", 20);
// pour gérer la domiciliation à Enycan ou ailleurs
define("ici", 1);
// prise en compte de l'année EN COURS
// le cahier des charges se base sur l'écart entre l'année en cours et l'année de naissance saisie 
// SANS TENIR COMPTE DE LA DATE D'ANNIVERSAIRE 
// TAF : modifier le projet pour considérer que l'usage est majeur à partir du jour exact
// de son 18ème anniversaire ; utiliser la fonction date_diff

$dateAujourdhui = new DateTime();
$dateAujourdhui->format('Y-m-d H:i:s');

$dateNaissance = strtotime($_POST["ANais"]);
$date_naissance= date('Y-m-d', $dateNaissance);
$dateNaissance = new DateTime($date_naissance);

$diff = $dateAujourdhui->diff($dateNaissance);
$age = $diff->y;

$uneVerification = "SELECT role FROM utilisateur WHERE login = '". $_POST["unLogin"] . "' ;";
$datas = $dbConnexion->requeteSelect($uneVerification);
$role = $datas[0]['role'];
if ($role == "user")
{
    //Récupération de la valeur du mot de passe pour le login saisi
    $maRequete = "SELECT password FROM utilisateur WHERE login = '". $_POST["unLogin"] . "' ;";
    $datas = $dbConnexion->requeteSelect($maRequete);
    //Faire un var_dump($datas) pour voir la forme de la donnée récupérée
    $mdpUtilisateur = $datas[0]['password'];

    //Si le mot de passe saisi correspond au mot de passe du login saisi, on réalise le calcul
    if ($_POST["unPassword"] == $mdpUtilisateur ) {
        If ($age < agelim) 
        {
        // les solutions qui comparent $_POST["ANais"] avec 1999 sont fonctionnelles en 2017 uniquement !
            // cas des mineurs
            If ($_POST["Domi"] == ici)
                $Cotis = gratuit;
            Else
            // attention : le critère scolarité n'est à prendre en compte que pour les usagers
            // non domiciliés à Enycan
            If (isset($_POST["Scol"])) {
                // on peut accéder à la valeur de $_POST["Scol"] uniquement si la case a été cochée
                // le isset vérifie préalablement que la variable $_POST["Scol"] existe
                if ($_POST["Scol"] == "ON")
                    $Cotis = prixJeuneSect;
            } Else
                $Cotis = PrixJeuneHorsSect;
        }
        Else
        // cas des majeurs
        // les remarques du bloc ci-dessus sont à appliquer au cas des majeurs {
            If ($_POST["Domi"] == ici)
                $Cotis = PrixDomi;
            Else
            If (isset($_POST["Scol"])) {
                if ($_POST["Scol"] == "ON")
                    $Cotis = PrixSect;
            } Else
                $Cotis = PrixHorsSect;

        echo "la cotisation sera de " . $Cotis . " euros <br>";

        //Réaliser l'insertionn  dans la base de données

        $nom = $_POST["unNom"];
        $prenom = $_POST["unPrenom"];
        if ($_POST["Domi"] == 1)
        {
            $Domicile = "ENYCAN";
        }
        else
        {
            $Domicile = "Autres";
        }
        $id = "SELECT id FROM utilisateur WHERE login = '". $_POST["unLogin"] . "' ;";
        $datas = $dbConnexion->requeteSelect($id);
        $id = $datas[0]['id']; 
        $requete = "INSERT INTO `adhesion` (`nom`, `prenom`, `date_naissance`, `prix_adhesion`, `nom_ville`, `id_utilisateur`) VALUES (' ".$_POST["unNom"]. "','" .$_POST["unPrenom"].  "','" .$date_naissance."','" .$Cotis."','" .$Domicile."', " .$id.")";
        $datas = $dbConnexion->requeteInsert($requete);
        $idActivite = $datas[0]['id'];                   
        }
    else
    {
        echo "Erreur login/password";
    }
}
else
{
    echo "Vous êtes un administrateur, veuillez vous connecter sur l'autre page. ";
}
?>

