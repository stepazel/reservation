<?php
session_start();
require 'classes/database.php';
require 'classes/admin.php';
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());
$admin = new admin();
$admin->checkLogin('reservationLogin.php');
mb_internal_encoding('UTF-8');

$admin->updateApproved();
$admin->displayTable();


?>
<html>
<head>
    <title>Admin strankaa</title>
</head>
<body>
<div><button class="btn button-primary"><a href="logout.php">Logout</a></button></div>
</body>
</html>
