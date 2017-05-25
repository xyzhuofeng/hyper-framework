<?php

namespace hyper;

/**
 * 请求类
 * 单例模式
 * @package hyper
 * @author HyperQing
 */
class Request
{
    /**
     * @var Request 请求对象
     */
    private static $instance = null;
    /**
     * @var string 控制器
     */
    private $controller = '';

    /**
     * @var string 动作方法
     */
    private $action = '';

    /**
     * @var string PATH_INFO信息
     */
    private $path_info = '';

    /**
     * 获取请求类实例
     * @return Request
     */
    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new Request();
        }
        return self::$instance;
    }

    /**
     * 获取/设置控制器
     * @param null $controller
     * @return null|string
     */
    public function controller($controller = null)
    {
        if ($controller) {
            $this->controller = $controller;
        }
        return $this->controller;
    }

    /**
     * 获取/设置动作方法
     * @param null $action
     * @return null|string
     */
    public function action($action = null)
    {
        if ($action) {
            $this->action = $action;
        }
        return $this->action;
    }
}
