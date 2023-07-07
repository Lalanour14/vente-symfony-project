<?php
namespace App\Repository;

use App\Entity\Monture;

class MontureRepository
{

    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM monture");

        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $list[] = new Monture($line["marque"], $line["model"], $line["basePrice"], $line["picture"], $line["id"]);

        }

        return $list;


    }

    public function findById(int $id): ?Monture
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("SELECT * FROM monture WHERE id=:id ");
        $query->bindValue(":id", $id);
        $query->execute();

        foreach ($query->fetchAll() as $line) {
            $monture = new Monture($line["marque"], $line["model"], $line["basePrice"], $line["picture"], $line["id"]);
            $monture->setPicture($line['picture']);
            return $monture;
        }
        return null;

    }

    public function persist(Monture $monture)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("INSERT INTO monture (marque,model,basePrice,picture) VALUES (:marque,:model,:basePrice,:picture)");
        $query->bindValue(':marque', $monture->getMarque());
        $query->bindValue(':model', $monture->getModel());
        $query->bindValue(':basePrice', $monture->getBasePrice());
        $query->bindValue(':picture', $monture->getPicture());


        $query->execute();


        $monture->setId($connection->lastInsertId());
    }

    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM monture WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }
    public function update(Monture $monture)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("UPDATE monture SET marque=:marque, model=:model, basePrice=:basePrice,  picture=:picture WHERE id=:id");
        $query->bindValue(':marque', $monture->getMarque());
        $query->bindValue(':model', $monture->getModel());
        $query->bindValue(':basePrice', $monture->getBasePrice());
        $query->bindValue(':picture', $monture->getPicture());

        $query->bindValue(":id", $monture->getId());

        $query->execute();
    }


}