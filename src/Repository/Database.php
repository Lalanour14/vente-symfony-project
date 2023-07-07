<?php

namespace App\Repository;


class Database
{

    public static function getConnection()
    {
        return new \PDO("mysql:host=localhost;dbname=vente_symfony_project", "root", "Tasine69+");
    }
}