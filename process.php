<?php

require './vendor/autoload.php';
/** @var array $countries */    /* pour que phpstorm se calme */
require './core/helpers/functions.php';

session_start();

use Tecgdcs\Screencast\Response;
use Tecgdcs\Screencast\Validator;

// remplace /*require 'core/Validator.php';*/

$countries = require './config/countries.php';       // charger fichier un assigner à nom de variable
$messages = require './lang/fr/validation.php';
$animals = require './config/animals.php';
/*require 'core/validation.php';*/ //plus utile car on l'a remplacé par $messages et on a mis les vérifications dans la classe Validator     // charger fichier
/*dd($_SERVER);*/
/*dd($_REQUEST, $_SERVER);*/


$email= '';
$vemail='';
$phone='';
$country='';

/*var_dump($_SERVER);die();*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {        // tjs dispo
    Response::abort();
}
if (!isset($_POST['_csrf']) || $_POST['_csrf'] !== $_SESSION['csrf_token']) {
    Response::abort();
}
unset($_SESSION['csrf_token']);


Validator::check([          // contrat pour que = facile a lire
        'email'=>'required|email',
        'vemail'=>'required|same:email',
        'phone'=>'phone',
        'country'=>'in_collection:countries',
]);

/*Validator::required('email');
Validator::required('vemail');
Validator::email('email');
// check_min('phone', 9);
Validator::phone('phone');
Validator::same('vemail', 'email');
Validator::collection('country', 'countries', $countries);
/*var_dump($_SESSION); die();*/
/*Validator::collection('type', 'animals', $animals);*/



/*
 *S'il y a des erreurs, on redirige vers la page du formulaire, en mémorisant le temps d'une requête les erreurs et les anciennes données
 * */

/*if(!is_null($_SESSION['errors'])){
    $_SESSION['old'] = $_REQUEST;
    header('Location: /index.php');
    exit;
}*/


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
        <dt>
            Pays&nbsp;:
        </dt>
        <dd>
            <?= $country?>
        </dd>
</dl>
</body>
</html>