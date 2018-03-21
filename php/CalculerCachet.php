<?php

// définition des constantes fournies dans le cahier des charges
define("forfaitTech", 60);
define("forfaitReal", 80);
define("forfaitCom", 70);
define("coef3", 1);
define("coef2", 1.2);
define("coef1", 1.5);
define("majoration", 0.5);
// le cachet journalier dépend du statut
switch ($_POST["statut"]):
    case "comédien":
        $cachetJournalier = forfaitCom;
        break;
    case "technicien":
        $cachetJournalier = forfaitTech;
        break;
    case "réalisateur":
        $cachetJournalier = forfaitReal;
        break;
endswitch;
// le coefficient dépend de la catégorie  
if ($_POST["categ"] == 1) {
    $cachetJournalier = $cachetJournalier * coef1;
} elseif ($_POST["categ"] == 2) {
    $cachetJournalier = $cachetJournalier * coef2;
} else {
    $cachetJournalier = $cachetJournalier * coef3;
}

$cachet = $cachetJournalier * ( ( $_POST["nbJourEngagt"] - $_POST["nbJourRepr"] ) + $_POST["nbJourRepr"] * ( 1 + majoration ) );
echo $cachet . " euros";
?>