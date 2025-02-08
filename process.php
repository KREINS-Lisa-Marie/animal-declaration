<?php
/*var_dump($_REQUEST);*/

session_start();

$email= '';
$vemail='';
$phone='';
/*
 * Valider les 2 champs pour email
 * */
/*EMAIL*/
if (array_key_exists('email', $_REQUEST)){
    $email =trim($_REQUEST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['errors']['email'] = 'Un email valide est requis';
    }
}else {
    $_SESSION['errors']['email'] = 'L’email est requis';

}
/* VEMAIL*/
if (array_key_exists('vemail', $_REQUEST)){
    $vemail = trim($_REQUEST['vemail']);

    if ($email !== $vemail){
        $_SESSION['errors']['vemail'] = 'La verification d’email proposé n’est pas valide';
    }
}else {
    $_SESSION['errors']['vemail'] = 'Vous devez repeter votre email';
}

/* PHONE*/
if (array_key_exists('phone', $_REQUEST)){
    $phone =trim($_REQUEST['phone']);


    if (is_numeric($phone)){
        $_SESSION['errors']['phone'] = 'Un numéro de téléphone valide est requis';
    }
}else {
    $_SESSION['errors']['phone'] = 'Le numéro de téléphone est requis';
}

if (is_numeric($phone)){
    $_SESSION['errors']['phone'] = 'Un numéro de téléphone valide est requis';
}
}else {
    $_SESSION['errors']['phone'] = 'Le numéro de téléphone est requis';
}


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
            <?= $email?>
        </dd>
        <dt>
            Numéro de téléphone&nbsp;:
        </dt>
        <dd>
            <?= $phone?>
        </dd>
</dl>
</body>
</html>