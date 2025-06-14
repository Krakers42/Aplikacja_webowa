<?php

require_once 'Repository.php';

class TripsRepository extends Repository {

    public function getAllTrips(): array {
        $stmt = $this->database->connect()->prepare("
            SELECT id_trip, date, time, distance, elevation, description 
            FROM trips 
            WHERE id_user = :id_user 
            ORDER BY id_trip 
        ");
        $stmt->execute([':id_user' => $_SESSION['user']['id_user']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTrips(array $data): bool {
        $stmt = $this->database->connect()->prepare("
            INSERT INTO trips (id_user, date, time, distance, elevation, description) 
            VALUES (:id_user, :date, :time, :distance, :elevation, :description)");
        return $stmt->execute([
            ':id_user' => $_SESSION['user']['id_user'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':distance' => $data['distance'],
            ':elevation' => $data['elevation'],
            ':description' => $data['description'] ?? ''
        ]);
    }

    public function updateTrip(int $id_trip, array $data): bool {
        $stmt = $this->database->connect()->prepare("
            UPDATE trips 
            SET date = :date, time = :time, distance = :distance, elevation = :elevation, description = :description 
            WHERE id_trip = :id_trip");
        return $stmt->execute([
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':distance' => $data['distance'],
            ':elevation' => $data['elevation'],
            ':description' => $data['description'] ?? '',
            'id_trip' => $id_trip
        ]);
    }

    public function deleteTrip(int $id_trip): bool {
        $stmt = $this->database->connect()->prepare("
            DELETE FROM trips 
            WHERE id_trip = :id_trip");
        return $stmt->execute([':id_trip' => $id_trip]);
    }
}
