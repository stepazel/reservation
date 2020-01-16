<?php


class reservation {
    public $name;
    public $email;
    public $datetime;
    public $city;
    public $approved;
    public $created;

    public function __construct() {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->datetime = $_POST['datetime'];
        $this->city = $_POST['city'];
        $this->approved = 0;
        $this->created = $this->getDate();
    }

    private function getDate () {
        return date('Y-m-d', time());
    }

    private function insertToDatabase () {
        database::query('INSERT INTO reservationinfo (name, email, datetime, place, approved, created) 
            VALUES (?, ?, ?, ?, ?, ?)'
            , array($this->name, $this->email, $this->datetime, $this->city, $this->approved, $this->created));
    }

    private function freeDate () {
        $dateDiffMinus = date('yy-m-d H:i:s', strtotime($this->datetime .'+4 hours'));
        $dateDiffPlus = date('yy-m-d H:i:s', strtotime($this->datetime .'-4 hours'));
        $vysledek = database::query("SELECT datetime FROM reservationinfo WHERE datetime BETWEEN '". $dateDiffPlus ."' AND '". $dateDiffMinus ."'");
        $array = $vysledek->fetchAll(PDO::FETCH_COLUMN);
        if (empty($array)) {
            return true;
        } else return false;
    }

    public function ifFreeDate () {
        if ($this->freeDate() == true) {
            $this->insertToDatabase();
            echo 'Děkujeme za váš zájem! Dáme vám vědět.';
        } else {
            echo 'Zadaný termín je již obsazený.';
        }
    } //komentar



    function neco () {

    }
}

