<?php
session_start();

$countries = require './config/countries.php';   // initialiser variable là ou on l'utilise
$animals = require './config/animals.php';
 require './core/helpers/functions.php';

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>J'ai perdu mon animal</title>
        <link rel="stylesheet" href="./css/styles.css">
        <script defer src="/js/main.js"></script>
    </head>
    <body>
    <h1>
        Déclaration de perte d'animal
    </h1>
    <form action="/process.php" method="post">
        <?php csrf();?>


<!--        <?php /*if ($_SERVER['REQUEST_METHOD']=== 'POST' || $_SERVER['REQUEST_METHOD']=== 'post'):*/?>
        <input type="hidden" name="csrf_token" value="<?php /*csrf();*/?>">
        --><?php /*endif;*/?>
        <fieldset>
            <legend>
                Vos coordonnées&nbsp;:
            </legend>


            <div>
                <label for="email">
                    *Email
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       placeholder="placeholder"
                       required
                    <?php if(isset($_SESSION['old']['email'])):?>
                        value="<?= $_SESSION['old']['email']?>"
                    <?php endif;?>
                >
            </div>
            <?php if(isset($_SESSION['errors']['email'])): ?>
                <div>
                    <p>
                        <?= $_SESSION['errors']['email'];?>
                    </p>
                </div>
            <?php endif;?>


            <div>
                <label for="vemail">
                    *Confirmation email
                </label>
                <input type="email"
                       name="vemail"
                       id="vemail"
                       placeholder="placeholder"
                       required
                    <?php if(isset($_SESSION['old']['vemail'])):?>
                        value="<?= $_SESSION['old']['vemail']?>"
                    <?php endif;?>
                >
            </div>
            <?php if(isset($_SESSION['errors']['vemail'])): ?>
                <div>
                    <p>
                        <?= $_SESSION['errors']['vemail'];?>
                    </p>
                </div>
            <?php endif;?>


            <div>
                <label for="phone">Telephone <small> par exemple&nbsp;: +320473737383</small></label>
                <input type="tel" name="phone" id="phone"
<?php if (isset($_SESSION['old']['phone'])): ?>
value="<?=$_SESSION['old']['phone'];?>"
<?php endif; ?>
                >
            </div>
<?php if (isset($_SESSION['errors']['phone'])): ?>
<div>
    <p>
        <?= $_SESSION['errors']['phone'] ?>
    </p>
</div>
    <?php endif; ?>


            <div>
                <label for="country">Pays</label>
                <select name="country" id="country">
                    <?php
                    foreach ($countries as $code => $name):?>
                        <option value="<?= $code ?>"
                                <?php
                                if (isset($_SESSION['old']['country'])&& $code === $_SESSION['old']['country']):?>
                                selected
                                <?php endif;?>
                        >
                    <?= $name ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <?php
            if (isset($_SESSION['errors']['country'])):
                ?>
            <div>
                <p>
                    <?= $_SESSION['errors']['country'];?>
                </p>
            </div>
            <?php endif; ?>


        </fieldset>



        <!-- TRY LM-->

        <fieldset>
            <legend>
                Description de l'animal perdu
            </legend>

            <div>
                <label for="type">
                    Type d'animal
                </label>
                <select name="type" id="type">
                    <?php
                    foreach ($animals as $animalcode => $animalname):?>
                        <option value="<?= $animalcode ?>"
                            <?php
                            if (isset($_SESSION['old']['type']) && $animalcode === $_SESSION['old']['type']):?>
                                selected
                            <?php endif; ?>
                        >
                            <?= $animalname ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
            if (isset($_SESSION['errors']['type'])):
                ?>
                <div>
                    <p>
                        <?= $_SESSION['errors']['type']; ?>
                    </p>
                </div>
            <?php endif; ?>


            <div><label for="nameofanimal">
                    *Nom de l'animal
                </label>
                <input type="text"
                       name="nameofanimal" id="nameofanimal"
                    <?php if (isset($_SESSION['old']['nameofanimal'])): ?>
                        value="<?= $_SESSION['old']['nameofanimal'];
                        ?>"
                    <?php endif; ?>
                       required
                ></div>
            <?php
            if (isset($_SESSION['errors']['nameofanimal'])):
                ?>
                <div>
                    <p>
                        <?= $_SESSION['errors']['nameofanimal']; ?>
                    </p>
                </div>
            <?php endif; ?>
        </fieldset>

        <!-- TRY LM bis hier-->

        <button type="submit">
            Déclarer la perte de mon animal
        </button>

    </form>
    </body>
    </html>
<?php
$_SESSION['errors'] = null;
$_SESSION['old'] = null;

