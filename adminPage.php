<?php
if (!isset($_GET['pageID'])) {
    header('Location: adminPage.php?pageID=1');
}
session_start();
require 'classes/database.php';
require 'classes/admin.php';
require 'classes/paginator.php';
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());
$admin = new admin();
$adminPaginator = new paginator(3);
$admin->checkLogin('reservationLogin.php');
mb_internal_encoding('UTF-8');



$admin->updateApproved();
//$admin->displayTable();


?>
<html>
<head>
    <title>Admin stranka</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<div><button class="btn button-primary"><a href="logout.php">Logout</a></button></div>
<div class="container">
    <table class="table"><thead>
        <tr>
            <th>Jméno</th>
            <th>E-mail</th>
            <th>Datum konání koncertu</th>
            <th>Místo konání</th>
            <th>Datum odeslání rezervace</th>
            <th>Potvrzeno</th>
            <th>Potvrdit</th>
        </tr>
        </thead>
        <tbody> <?php $adminPaginator->displayResults();?>

<div class="container">
   <?php $adminPaginator->displayLinks();?>

</div>

</body>
</html>
