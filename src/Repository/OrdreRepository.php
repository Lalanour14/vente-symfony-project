<?php

namespace App\Repository;

use App\Entity\Ordre;
use DateTime;


class OrdreRepository
{




    /**
     * Summary of findAll
     * @return array
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM ordre ");

        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Ordre(new DateTime($line["createdAt"]), $line["customName"], $line["id_monture"], $line["id"]);

        }

        return $list;

    }
    public function findById(int $id): ?Ordre
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM ordre WHERE id=:id ");
        $query->bindValue(":id", $id);
        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $ordre = new Ordre(new DateTime($line["createdAt"]), $line["customName"], $line["id_monture"], $line["id"]);

            return $ordre;
        }
        return null;

    }

    public function persist(Ordre $ordre)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("INSERT INTO ordre (createdAt,customName,id_monture) VALUES (:createdAt,:customName,:id_monture)");
        $query->bindValue(':createdAt', $ordre->getCreatedAt()->format('Y-m-d'));
        $query->bindValue(':customName', $ordre->getCustomName());
        $query->bindValue(':id_monture', $ordre->getIdMonture());



        $query->execute();


        $ordre->setId($connection->lastInsertId());
    }

    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM ordre WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function update(Ordre $ordre)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("UPDATE ordre SET createdAt=:createdAt,customName=:customName,id_monture=:id_monture WHERE id=:id");
        $query->bindValue(':createdAt', $ordre->getCreatedAt()->format('Y-m-d'));
        $query->bindValue(':customName', $ordre->getCustomName());
        $query->bindValue(':id_monture', $ordre->getIdMonture());



        $query->bindValue(":id", $ordre->getId());

        $query->execute();
    }


}