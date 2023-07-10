<?php

namespace App\Repository;

use App\Entity\Verre;

class VerreRepository
{

    /**
     * Summary of findAll
     * @return array
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM verre ");

        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Verre($line["genre"], $line["price"], $line["id"]);

        }

        return $list;

    }
    public function findById(int $id): ?Verre
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM verre WHERE id=:id ");
        $query->bindValue(":id", $id);
        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $verre = new Verre($line["genre"], $line["price"], $line["id"]);

            return $verre;
        }
        return null;

    }

    public function persist(Verre $verre)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("INSERT INTO (genre,price) VALUES (:genre,:price)");
        $query->bindValue(':genre', $verre->getGenre());
        $query->bindValue(':price', $verre->getPrice());



        $query->execute();


        $verre->setId($connection->lastInsertId());
    }

    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM verre WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function update(Verre $verre)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("UPDATE verre SET Genre=:Genre,pricce=:pricce WHERE id=:id");
        $query->bindValue(':Genre', $verre->getGenre());
        $query->bindValue(':pricce', $verre->getPrice());


        $query->bindValue(":id", $verre->getId());

        $query->execute();
    }


}