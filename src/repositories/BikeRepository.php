<?php

use models\Bike;

require_once 'Repository.php';
require_once __DIR__.'/../models/Bike.php';

class BikeRepository extends Repository {
    public function getBikes(int $id_bike_card): ?Bike{
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM public.bike_cards WHERE id_bike_card = id_bike_card'
        );
        $stmt->bindParam(':id_bike_card', $id_bike_card, \PDO::PARAM_INT);
        $stmt->execute();

        $bike = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$bike) {
            throw new BikeNotFoundException("Bike not found.");
        }

        return new Bike(
            $bike['name'],
            $bike['description'],
            $bike['image_type'],
            $bike['photo'],
        );
    }

    public function addBike(Bike $bike): void{
        $stmt = $this->database->connect()->prepare( '
            INSERT INTO bike_cards (name, description, image_type, photo)
            VALUES (?, ?, ?, ?, ?)
        ');

        $assignedById = 1;

        $stmt->execute([
            $bike->getTitle(),
            $bike->getDescription(),
            $bike->getImageType(),
            $bike->getImage()
        ]);

    }
}