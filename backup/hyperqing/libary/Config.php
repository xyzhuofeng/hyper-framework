<?php

namespace hyper;

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
     * @throws \Exception
     */
    public static function get($key)
    {
        if (!self::$config) {
            self::$config = require_once CONF_PATH . '/config.php';
        }
        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }
        throw new \Exception('未找到指定配置: ' . $key);
    }
}