<?php

class DAO
{   
    public function conecta()
    {
        $pdo = null;
        try {
            $pdo = new PDO("mysql:host=". HOST .";port=". PORT .";dbname=". DB , USER, PASS);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo("Error!: " . $e->getMessage() . "<br/>");
            die();
        }
        return $pdo;
    }
}