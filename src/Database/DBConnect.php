<?php

namespace App\Database;

use PDO;

final class DBConnect
{

    /**
     * @var PDO|null
     */
    private static ?PDO $pdo = null;


    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(getenv("DATABASE_DNS"), getenv("DATABASE_USER"), getenv("DATABASE_PASSWORD"));
        }
        return self::$pdo;
    }


}
