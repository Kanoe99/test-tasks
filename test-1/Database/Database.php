<?php

namespace Database;

require __DIR__ . '/../utils/loadEnv.php';

loadEnv(__DIR__ . '/../.env');

use PDO;

class Database
{
    public $connection;
    public $statement;
    public function __construct(
        $db_type = null,
        $db_host_container = null,
        $db_name = null,
        $db_username = null,
        $db_password = null
    ) {
        [$db_type, $db_host_container, $db_name, $db_username, $db_password] = [
            $db_type ?? getenv('DB_TYPE'),
            $db_host_container ?? getenv('DB_HOST_CONTAINER'),
            $db_name ?? getenv('DB_NAME'),
            $db_username ?? getenv('DB_USERNAME'),
            $db_password ?? getenv('DB_PASSWORD')
        ];

        $dsn = "$db_type:host=$db_host_container;dbname=$db_name;charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, $db_username, $db_password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            exit("Record not found!");
        }

        return $result;
    }
}
