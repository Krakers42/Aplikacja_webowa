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
            $image = $bike['photo'];
            if (is_resource($image)) {
                $image = stream_get_contents($image);
            }

            $bikes[] = new Bike(
                $bike['id_user'],
                $bike['name'],
                $bike['description'],
                $image,
                $bike['image_type'],
            );
        }

        if (!$bikes) {
            return [];
        }

        return $bikes;
    }


    public function addBike(Bike $bike): void{
        $stmt = $this->database->connect()->prepare( '
            INSERT INTO bike_cards (id_user, name, description, image_type, photo)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->bindValue(1, $bike->getUserId(), PDO::PARAM_INT);
        $stmt->bindValue(2, $bike->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(3, $bike->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(4, $bike->getImageType(), PDO::PARAM_STR);
        $stmt->bindValue(5, $bike->getImage(), PDO::PARAM_LOB);

        $stmt->execute();

    }
}