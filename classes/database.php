<?php


class database {

    private static $connection;

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    public static function connect($host, $user, $password, $database) {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
        return self::$connection;
    }

    public static function query ($sql, $parameters = array()) {
        $query = self::$connection->prepare($sql);
        $query->execute($parameters);
        return $query;
    }


    public static function selectHost () {
        $developerDbHost = 'localhost';
        $productionDbHost = 'md55.wedos.net';
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            return $developerDbHost;
        }
        if ($_SERVER['HTTP_HOST'] == 'raml.cz') {
            return $productionDbHost;
        }
        return 'si kokot';
    }

    public static function selectDatabase () {
        $developerDb = 'reservation';
        $productionDb = 'd225105_raml';
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            return $developerDb;
        }
        if ($_SERVER['HTTP_HOST'] == 'raml.cz') {
            return $productionDb;
        }
        return 'si kokot';
    }

    public static function selectUser () {
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            return 'root';
        }
        if ($_SERVER['HTTP_HOST'] == 'raml.cz') {
            return 'a225105_raml';
        }
        return 'kamo neco je spatne';
    }

    public static function selectPassword () {
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            return '';
        }
        if ($_SERVER['HTTP_HOST'] == 'raml.cz') {
            return 'Stephan123!';
        }
    }
}