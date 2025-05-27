<?php

use models\Bike;

require_once 'Repository.php';
require_once __DIR__.'/../models/Bike.php';

class BikeRepository extends Repository {
    public function getBikesByUser(int $id_user): array
    {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM public.bike_cards WHERE id_user = :id_user'
        );
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $bikesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $bikes = [];

        foreach ($bikesData as $bike) {
            $bikes[] = new Bike(
                $bike['id_user'],
                $bike['name'],
                $bike['description'],
                $bike['photo'],
                $bike['image_type'],
            );
        }
        if (!$bikes) {
            throw new BikeNotFoundException("Bike not found.");
        }

        return $bikes;
    }


    public function addBike(Bike $bike): void{
        $stmt = $this->database->connect()->prepare( '
            INSERT INTO bike_cards (id_user, name, description, image_type, photo)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $bike->getUserId(),
            $bike->getTitle(),
            $bike->getDescription(),
            $bike->getImageType(),
            $bike->getImage()
        ]);

    }
}