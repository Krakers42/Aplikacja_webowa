<?php

require_once 'Repository.php';

class GearPartsRepository extends Repository {

    public function getAllGearParts(): array {
        $stmt = $this->database->connect()->prepare("SELECT id_gear_part, purchase_date, name, value, comment FROM gear_parts ORDER BY id_gear_part WHERE id_user = :id_user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGearPart(array $data): bool {
        $stmt = $this->database->connect()->prepare("INSERT INTO gear_parts (id_gear_part, id_user, purchase_date, name, value, comment) VALUES (:id_gear_part, :id_user, :purchase_date, :name, :value, :comment)");
        return $stmt->execute([
            ':id_gear_part' => $data['id_gear_part'],
            ':id_user' => $data['id_user'],
            ':purchase_date' => $data['purchase_date'],
            ':name' => $data['name'],
            ':value' => $data['value'],
            ':comment' => $data['comment'] ?? ''
        ]);
    }

    public function updateGearPart(int $id_gear_part, array $data): bool {
        $stmt = $this->database->connect()->prepare("UPDATE gear_parts SET purchase_date = :purchase_date, name = :name, value = :value, comment = :comment WHERE id_gear_part = :id_gear_part");
        return $stmt->execute([
            ':purchase_date' => $data['purchase_date'],
            ':name' => $data['name'],
            ':value' => $data['value'],
            ':comment' => $data['comment'] ?? ''
        ]);
    }

    public function deleteGearPart(int $id_gear_part): bool {
        $stmt = $this->database->connect()->prepare("DELETE FROM gear_parts WHERE id_gear_part = :id_gear_part");
        return $stmt->execute([':id_gear_part' => $id_gear_part]);
    }
}
