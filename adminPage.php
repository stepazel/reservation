<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>

</head>
</html>
<?php
mb_internal_encoding('UTF-8');
require 'classes/database.php';
require 'classes/admin.php';
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());

$admin = new admin();
$admin->displayTable();
$admin->updateApproved();

