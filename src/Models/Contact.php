<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;
use Exception;

class Contact extends Model
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        Database::connect();
        parent::__construct(Database::getConnection(), "contact");
    }

    public function deleteById(int $id): bool
    {
        $statement = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        return $statement->execute([$id]);
    }
    public function create(array $data): bool
    {
        $statement = $this->db->prepare("INSERT INTO $this->table (name, email, message) VALUES (?,?,?)");
        return $statement->execute([
            $data['name'],
            $data['email'],
            $data['message'],
        ]);
    }

    public function update(array $data): bool
    {
        $statement = $this->db->prepare("
            UPDATE $this->table SET name = ?, email = ?, message = ? WHERE id = ?
        ");

        return $statement->execute([
            $data['name'],
            $data['email'],
            $data['message'],
            $data['id']
        ]);
    }
}