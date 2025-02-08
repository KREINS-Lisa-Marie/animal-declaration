<?php
/*var_dump($_REQUEST);*/

session_start();

/*
 * Valider les 2 champs pour email
 * */


/*
 *S'il y a des erreurs, on redirige vers la page du formulaire, en mémorisant le temps d'une requête les erreurs et les anciennes données
 * */

if(!is_null($_SESSION['errors'])){
    $_SESSION['old'] = $_REQUEST;
    header('Location: /index.php');
    exit;
}

/*
 * Assurer le rendu récapitulatif des données soumises
 * */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif de la déclaration</title>
</head>
<body>
<h1>
    Récapitulatif de la déclaration
</h1>
<dl>
    <div>
        <dt>
            Email&nbsp;:
        </dt>
        <dd>
            <?= $_REQUEST['email']?>
        </dd>
    </div>
</dl>
</body>
</html>