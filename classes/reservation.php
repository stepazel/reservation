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
        $sql = 'SELECT datetime FROM reservationinfo';
        $vysledek = database::query($sql);
        $array = $vysledek->fetchAll(PDO::FETCH_COLUMN);
        $formDate = new DateTime($this->datetime);

        foreach ($array as $value) {
            $dbDate = new DateTime($value);
            $interval = $formDate->diff($dbDate)->format('%R%h hours');
            if ($interval >= -4 AND $interval <= 4) {
                return false;
            }
        }
        return true;
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

