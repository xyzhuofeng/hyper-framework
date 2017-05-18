<?php
/**
 * common.php
 * 项目核心库文件
 */

/**
 * 配置类
 * Class Config
 * 单例模式
 */
class Config
{
    /**
     * @var array $config 配置数组
     */
    private static $config;

    /**
     * 获取指定键名的配置
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public static function get($key)
    {
        if (!self::$config) {
            self::$config = require_once __DIR__ . '/config/config.php';
        }
        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }
        throw new Exception('未找到指定配置: ' . $key);
    }
}

/**
 * 数据库驱动
 * Class DBDriver
 * 单例模式
 */
class DBDriver
{
    /**
     * @var PDO $pdo pdo连接对象
     */
    private static $pdo;

    public static function getInstance()
    {
        if (self::$pdo) {
            return self::$pdo;
        }
        try {
            self::$pdo = new PDO('mysql:host=' . Config::get('db_host') . ';dbname=' . Config::get('db_name'),
                Config::get('db_username'),
                Config::get('db_password')
            );
            // 始终抛出异常
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        return self::$pdo;
    }
}

/**
 * 返回成功页面
 * @param string $info
 * @param string $url
 * @param int $wait_time
 */
function success(string $info,string $url = null,int $wait_time = 1)
{
    if ($url == null) {
        $url = $_SERVER['HTTP_REFERER'];
    }
    require __DIR__ . '/success.php';
    exit;
}

/**
 * 返回失败页面
 * @param string $info
 * @param string $url
 * @param int $wait_time
 */
function error(string $info,string $url = null,int $wait_time = 3)
{
    require __DIR__ . '/error.php';
    exit;
}
