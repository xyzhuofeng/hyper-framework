<?php

namespace hyper;

/**
 * 数据库连接
 * Class Connection
 * @package hyper
 */
class Connection
{
    /**
     * @var \PDO $pdo pdo连接对象
     */
    private static $pdo;

    /**
     * 获取PDO连接对象
     * @return \PDO
     */
    public static function getInstance()
    {
        if (self::$pdo) {
            return self::$pdo;
        }
        try {
            self::$pdo = new \PDO('mysql:host=' . Config::get('db_host') . ';dbname=' . Config::get('db_name'),
                Config::get('db_username'),
                Config::get('db_password')
            );
            // 始终抛出异常
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // utf8编码
            self::$pdo->exec('set names utf8mb4');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return self::$pdo;
    }
}