<?php
session_start();
mb_internal_encoding('UTF-8');

function loadClass($class) {
    require('classes/'.$class.'.php');
}

spl_autoload_register('loadClass');


$admin = new admin;
$admin->loginUser();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Přihlášení do rezervačního systému DayDreams</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>

<div class="container">
    <h2>Příhlášení do rezervačního systému DayDreams</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Zadejte svůj e-mail">
        </div>
        <div class="form-group">
            <label for="password">Heslo</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Zadejte své heslo">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" id="submit" name="submit" >Přihlásit se</button>
        </div>
    </form>
</div>

</body>
</html>
