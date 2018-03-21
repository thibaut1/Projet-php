<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP PHP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

<?php
spl_autoload_extensions(".php");
spl_autoload_register();
date_default_timezone_set('Europe/Paris');

$dbConnexion = new Database('192.168.209.25', 'admin3', 'azerty', 'bibligrp3');

$uneVerification = "SELECT role FROM utilisateur WHERE login = '". $_POST["unLogin"] . "' ;";
$datas = $dbConnexion->requeteSelect($uneVerification);
$role = $datas[0]['role'];
if ($role == "admin")
{
    //Récupération de la valeur du mot de passe pour le login saisi
    $maRequete = "SELECT password FROM utilisateur WHERE login = '". $_POST["unLogin"] . "' ;";
    $datas = $dbConnexion->requeteSelect($maRequete);
    //Faire un var_dump($datas) pour voir la forme de la donnée récupérée
    $mdpUtilisateur = $datas[0]['password'];

    //Si le mot de passe saisi correspond au mot de passe du login saisi, on réalise le calcul
    if ($_POST["unPassword"] == $mdpUtilisateur ) 
    {
        $table = "SELECT * FROM adhesion;";
        $datas = $dbConnexion->requeteSelect($table); ?>
        <br/>
        <div class="container">
            <table style="width:100%"class="table-bordered">
                <tr>
                    <th>id</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>date_naissance</th>
                    <th>date_adhésion</th>
                    <th>prix_adhesion</th>
                    <th>nom_ville</th>
                    <th>id_utilisateur</th>
                </tr>
                <?php
                foreach ($datas as $ligne)
                {?>
                    <tr>
                        <th><?php echo $ligne['id']; ?></th>
                        <th><?php echo $ligne['nom']; ?></th>
                        <th><?php echo $ligne['prenom']; ?></th>
                        <th><?php echo $ligne['date_naissance']; ?></th>
                        <th><?php echo $ligne['date_adhesion']; ?></th>
                        <th><?php echo $ligne['prix_adhesion']; ?></th>
                        <th><?php echo $ligne['nom_ville']; ?></th>
                        <th><?php echo $ligne['id_utilisateur']; ?></th>
                    </tr> 
                <?php } ?>
             </table>
         </body>
     </html>
    <?php
    }
}
else
echo "Vous n'êtes pas un administrateur. Veuillez vous connecter sur la page user.";
   ?>
