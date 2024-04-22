<?php
const DB_HOST = '127.0.0.1';
const DB_USER = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'users';
const DB_PORT = 3306;


function connect_to_db_pdo(){
    try {
        $dsn= "mysql:host=localhost;dbname=users;port=3306";

        $pdo=  new PDO($dsn, DB_USER, DB_PASSWORD);
        var_dump($pdo);
        return $pdo;
    }
    catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
        return false;
    }
}
?>

