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
<div>
    <label for="phone"> *Téléphone</label>
    <input type="tel"
           name="phone"
           id="phone"
        <?php if(isset($_SESSION['old']['phone'])):?>
            value="<?= $_SESSION['old']['phone']?>"
        <?php endif;?>
           required>
</div>
        <?php if(isset($_SESSION['errors']['phone'])): ?>
            <div>
                <p>
                    <?= $_SESSION['errors']['phone'];?>
                </p>
            </div>
        <?php endif;?>
        <div>
            <label for="country">Pays</label>
            <select name="country" id="country">
                <option value="BE" selected>Belgique</option>
                <option value="FR">France</option>
                <option value="DE">Allemage</option>
                <option value="LU">Luxembourg</option>
            </select>
        </div>
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
