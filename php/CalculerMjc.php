<?php
spl_autoload_extensions(".php");
spl_autoload_register();
date_default_timezone_set('Europe/Paris');

///Connexion vers la base de données bdd_mjc avec l'utilisateur root
$dbConnexion = new Database('localhost', 'root', 'root', 'bdd_mjc');

define("jeune", 20);
define("senior", 65);

define("artistiques", 200);
define("musicales", 180);
define("sportives", 150);
define("devperso", 220);

$dateAujourdhui = new DateTime();
$dateAujourdhui->format('Y-m-d H:i:s');

$dateNaissance = new DateTime($_POST["DateNaissance"]);

$diff = $dateAujourdhui->diff($dateNaissance);
$age = $diff->y;

$prix = 0;

//Récupération de la valeur du mot de passe pour le login saisi
$datas = $dbConnexion->requeteSelect("SELECT password FROM utilisateur WHERE login = '". $_POST["login"] . "' ;");
//Faire un var_dump($datas) pour voir la forme de la donnée récupérée
$mdpUtilisateur = $datas[0]['password'];

//Si le mot de passe saisi correspond au mot de passe du login saisi, on réalise le calcul
if ($_POST["password"] == $mdpUtilisateur ) {

    switch ($_POST["Activites"]):
        case "artistiques":
            $prix = artistiques;
            break;
        case "musicales":
            $prix = musicales;
            break;
        case "sportives":
            $prix = sportives;
            break;
        case "devperso":
            $prix = devperso;
            break;
    endswitch;


    if (($age <= jeune) || ($age >= senior)) {
        $prix = $prix * 0.8;
    }


    echo "le prix de l'inscription sera de " . $prix . " euros <br>";
    
    //Réaliser l'insertionn  dans la base de données
    
    // 1) Récupérer l'id de l'utilisateur
    $datas = $dbConnexion->requeteSelect("SELECT id FROM utilisateur WHERE login ='". $_POST["login"] . "';" );
    $idUtilisateur = $datas[0]['id'];
    
    // 2) Récupérer l'id de l'activité
    $datas = $dbConnexion->requeteSelect("SELECT id FROM activites WHERE nom ='". $_POST["Activites"] . "';" );
    $idActivite = $datas[0]['id'];
    
    // 3) Réaliser l'insertion avec une requête SQL INSERT INTO
    $dbConnexion->requeteInsert("INSERT INTO inscription (id_utilisateur, id_activite, prix) VALUES ('". $idUtilisateur . "', '". $idActivite . "', '". $prix ."');");
    
} else {
    echo "Erreur login/password";
}
?>

