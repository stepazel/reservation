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


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPage</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<div>
    <button class="btn button-primary"><a href="logout.php">Logout</a></button>
</div>
<div>
    <form method="post" action="">
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
            <tr>
                <td>
                    <label for="filterName">Zadejte jméno</label>
                    <input type="text" name="filterName" id="filterName">
                </td>
                <td>
                    <label for="filterEmail">Zadejte E-mail</label>
                    <input type="email" name="filterEmail" id="filterEmail">
                </td>
                <td>
                    <label for="filterEventDate">Zadejte datum konání</label>
                    <input type="date" name="filterEventDateFrom" id="filterEventDateFrom">
                    <input type="date" name="filterEventDateTo" id="filterEventDateTo">
                </td>
                <td>
                    <label for="filterPlace">Zadejte místo</label>
                    <input type="text" name="filterPlace" id="filterPlace">
                </td>
                <td>
                    <label for="filterCreatedDate">Zadejte datum vytvoření</label>
                    <input type="date" name="filterCreatedDateFrom" id="filterCreatedDateFrom">
                    <input type="date" name="filterCreatedDateTo" id="filterCreatedDateTo">
                </td>
                <td>
                    <label for="filterApproved">Zadejte stav potvrzení</label>
                    <input type="text" name="filterApproved" id="filterApproved">
                </td>
                <td>
                    <input type="submit" value="Filtrovat">
                </td>
            </tr>
        </thead>
        <tbody> <?php $adminPaginator->displayResults();
        $filterData = new FilterData();
        $filter = new Filter($filterData);
        ?>


<div class="container">
   <?php $adminPaginator->displayLinks();?>
    </form>
</div>

</body>
<script>
    $(function() {
        $('input[name="filterEventDatea"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });
    });
    $(function() {
        $('input[name="filterCreatedDatde"]').daterangepicker({
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    </script>
</html>

