<?php

namespace Slash686\McCaddyAskServer;

use PDO;

class Database
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(array $config)
    {
        $dsn = $config['driver'] . ':' . $config['database'];

        $this->connection = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query(string $query, array $parameters)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);

        return $statement;
    }
}