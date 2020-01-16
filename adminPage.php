<?php
session_start();
mb_internal_encoding('UTF-8');
require 'classes/database.php';
require 'classes/admin.php';
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());
?>
<html>
<head>
    <title>Admin stranka</title>
</head>
<body>
    <div><button class="btn button-primary"><a href="logout.php">Logout</a></button></div>
</body>
</html>
<?php
$admin = new admin();
$admin->checkLogin('reservationLogin.php');
$admin->displayTable();
$admin->updateApproved();


