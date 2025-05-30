<?php

require_once 'Repository.php';

class GearPartsRepository extends Repository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllGearParts(): array {
        $stmt = $this->db->query("SELECT id, name, description FROM gear_parts ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGearPart(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO gear_parts (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'] ?? ''
        ]);
    }

    public function updateGearPart(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE gear_parts SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':description' => $data['description'] ?? ''
        ]);
    }

    public function deleteGearPart(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM gear_parts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
