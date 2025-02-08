<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>J'ai perdu mon animal</title>
</head>
<body>
<h1>
    Déclaration de perte d'animal
</h1>
<form action="/process.php" method="post">
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
        <button type="submit">
            Déclarer la perte de mon animal
        </button>

    </fieldset>

</form>
</body>
</html>
<?php
$_SESSION['errors'] = null;
$_SESSION['old'] = null;
