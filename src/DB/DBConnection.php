<?php
/***
 * Singleton pattern for DBConnection
 */

namespace App\DB;

use mysqli;
use Exception;

class DBConnection
{
    private static $instance = null;
    public mysqli $mysqli;

    protected function __construct()
    {
        $hostname = $_ENV['DB_HOSTNAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];

        $this->mysqli = new mysqli($hostname, $username, $password, $database);
    }

    protected function __clone()
    {
        throw new Exception('Cloning not permitted.');
    }

    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton.');
    }

    public static function getInstance(): DBConnection
    {
        if (!self::$instance) {
            self::$instance = new DBConnection();
        }

        return self::$instance;
    }

    public function runSql($sql)
    {
        return $this->mysqli->query($sql);
    }

}