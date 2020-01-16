<!DOCTYPE html>
<html lang="cs-cz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezervace koncertu</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .container {
             border-radius: 5px;
             background-color: #f2f2f2;
             padding: 10px;
         }

        @media screen and (max-width: 600px) {
            .column, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }

    </style>
</head>
<body>
<?php
    mb_internal_encoding('UTF-8');

    function loadClass($class) {
        require('classes/'.$class.'.php');
    }

    spl_autoload_register('loadClass');

database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());



    ?>

<div class="container">
    <div style="text-align:center">
        <h2>DayDreams</h2>
        <p>Zarezervujte si naši kapelu právě na vaši akci:</p>
    </div>
    <form action="reservationToDatabase.php" method="post">
        <div class="form-group">
            <label for="name">Celé jméno</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Zadejte vaše jméno">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Zadejte svůj email">
        </div>
        <div class="form-group">
            <label for="picker">Vyberte čas a datum koncertu</label>
            <input type="text" class="form-control" id="picker" name="datetime">
        </div>
        <div class="form-group">
            <label for="city">Město</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Zadejte město konání">
        </div>
            <button type="submit" class="btn btn-primary" id="submit" name="submit" >Odeslat</button>

    </form>
</div>

<script>
    $('#picker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerSeconds: false,
        timePicker24Hour: true,
        locale: {
            format: 'YYYY/MM/DD HH:mm'
        }
    })
</script>

</body>
</html>