<?php


namespace yk\core;


/**
 * Class DB
 * @package yk\core
 */
/**
 * Class DB
 * @package yk\core
 */
class DB
{
    /**
     * @var \PDO
     */
    protected $pdo;
    /**
     * @var DB
     */
    protected static $_instance;

    /**
     * @param string $dsn
     * @param string $login
     * @param string $password
     * @return DB
     */
    public static function configuration(string $dsn, string $login, string $password)
    {
        self::$_instance = new self();
        self::$_instance->pdo = new \PDO($dsn, $login, $password);
        return self::$_instance;
    }

    /**
     * @return DB
     * @throws \Exception
     */
    public static function getInstance()
    {
        if(self::$_instance == null)
            throw new \Exception('Before getInstance you should call configuration method');
        return self::$_instance;
    }

    /**
     * @param string $sql
     * @return mixed
     */
    public function execute(string $sql)
    {
        $statement = $this->pdo->prepare($sql);
        return $statement->execute();
    }

    /**
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * DB constructor.
     */
    protected function __construct() {}

    /**
     *
     */
    protected function __clone() {}

}