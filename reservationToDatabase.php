<?php

mb_internal_encoding('UTF-8');

function loadClass($class) {
    require('classes/'.$class.'.php');
}

spl_autoload_register('loadClass');
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());

$rezervace = new reservation();
$rezervace->ifFreeDate();


//zkouska



