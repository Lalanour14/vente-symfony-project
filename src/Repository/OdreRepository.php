<?php

namespace App\Repository;
 
use App\Entity\Odre;


class OdreRepository {


    {

        /**
         * Summary of findAll
         * @return array
         */
        public function findAll(): array
        {
            $list = [];
            $connection = Database::getConnection();
    
            $query = $connection->prepare("SELECT * FROM odre ");
    
            $query->execute();
            foreach ($query->fetchAll() as $line) {
                $list[] = new Odre(new DateTime($line["createdAt"]), $line["customName"],$line["id_monture"],$line["id"]);
    
            }
    
            return $list;
    
        }
        public function findById(int $id): ?Odre
        {
    
            $connection = Database::getConnection();
    
            $query = $connection->prepare("SELECT * FROM odre WHERE id=:id ");
            $query->bindValue(":id", $id);
            $query->execute();
    
            foreach ($query->fetchAll() as $line) {
                $verre = new Odre(new DateTime($line["createdAt"]), $line["customName"],$line["id_monture"],$line["id"]);
    
                return $verre;
            }
            return null;
    
        }
    
        public function persist(Ordre $ordre)
        {
            $connection = Database::getConnection();
    
            $query = $connection->prepare("INSERT INTO (createdAt,customName,id_monture) VALUES (:createdAt,:customName,:id_monture)");
            $query->bindValue(':createAt', $ordre->getCreatedAt());
            $query->bindValue(':customName', $ordre->getCustomName());
            $query->bindValue(':id_monture', $ordre->getId_monture));
    
    
    
            $query->execute();
    
    
            $verre->setId($connection->lastInsertId());
        }
    
        public function delete(int $id)
        {
    
            $connection = Database::getConnection();
    
            $query = $connection->prepare("DELETE FROM ordre WHERE id=:id");
            $query->bindValue(":id", $id);
            $query->execute();
        }
    
        public function update(Odre $odre)
        {
    
            $connection = Database::getConnection();
    
            $query = $connection->prepare("UPDATE odre SET createdAt=:createdAt,customName=:customName,id_monture=:id_monture WHERE id=:id");
            $query->bindValue(':createAt', $ordre->getCreatedAt());
            $query->bindValue(':customName', $ordre->getCustomName());
            $query->bindValue(':id_monture', $ordre->getId_monture));
    
    
    
            $query->bindValue(":id", $odre->getId());
    
            $query->execute();
        }
    
    
    }


}