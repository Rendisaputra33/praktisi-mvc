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
}