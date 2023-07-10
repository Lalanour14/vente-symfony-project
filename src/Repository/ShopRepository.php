<?php

namespace App\Repository;

use App\Entity\Shop;

class ShopRepository
{

    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM shop");

        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $list[] = new Shop($line["name"], $line["adress"], $line["id"]);

        }

        return $list;



    }

    public function findById(int $id): ?Shop
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM shop WHERE id=:id ");
        $query->bindValue(":id", $id);
        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $shop = new Shop($line["name"], $line["adress"], $line["id"]);

            return $shop;
        }
        return null;

    }

    public function persist(Shop $shop)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("INSERT INTO shop (name,adress) VALUES (:name,:adress)");
        $query->bindValue(':name', $shop->getName());
        $query->bindValue(':adress', $shop->getAdress());



        $query->execute();


        $shop->setId($connection->lastInsertId());
    }

    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM shop WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function update(Shop $shop)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("UPDATE shop SET name=:name,adress=:adress WHERE id=:id");
        $query->bindValue(':name', $shop->getName());
        $query->bindValue(':adress', $shop->getAdress());


        $query->bindValue(":id", $shop->getId());

        $query->execute();
    }







}