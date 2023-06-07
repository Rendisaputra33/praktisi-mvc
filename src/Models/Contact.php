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
}