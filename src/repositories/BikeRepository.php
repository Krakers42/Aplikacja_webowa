<?php

require_once 'Repository.php';


class BikeRepository extends Repository {
    public function getBikes():array {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM public.bike_cards ORDER BY id ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}