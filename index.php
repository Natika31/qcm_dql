<?php
require_once'class/Cfg.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Accueil</title>
</head>
<body>
<div class="row">
    <div class="col-3 mx-auto text-center">
        <h4>Bienvenue dans cette application web fait par Natacha et Arnaud</h4>
    </div>
</div>


<div class="row mt-5">
    <div class="col-4 mx-auto p-3">
        <form method="post">
            <div class="row form-group">
                <div class="mx-auto">
                    <input type="text" placeholder="Login..." class="form-control">
                </div>
            </div>
            <div class="row mt-3 form-group">
                <div class="mx-auto">
                    <input type="password" placeholder="mot de passe..." class="form-control">
                </div>
            </div>
            <div class="row mt-2 form-group">
                <div class="mx-auto">
                    <input type="button" class="btn btn-success" value="Se connecter">
                </div>
            </div>
        </form>
        <div class="row">
            <small class="font-italic mx-auto">Pas de compte ? <a href="register.php">cliquez ici</a> pour vous inscrire</small>
        </div>
    </div>
</div>
</body>
</html>