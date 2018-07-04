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
     * @var string 请求方法,GET/POST/PUT/DELETE
     */
    private $method = '';
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
     * 构造函数
     * 首次实例化本类时执行，会对本次请求进行完整分析
     * @access protected
     */
    protected function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parsePathInfo();
    }

    /**
     * 解析PATH_INFO
     * @access protected
     */
    protected function parsePathInfo()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            // 记录原始PATH_INFO信息
            $this->path_info = $_SERVER['PATH_INFO'];
        } else {
            // 设置默认控制器和方法
            $this->path_info = '/index/index';
        }
        // 去除左边多余斜杠
        $path_info = ltrim($this->path_info, '/');
        $dispatch = explode('/', $path_info);
        // [0]为控制器类名,[1]为实例方法
        // 大小写规则:1.控制器类名首字母大写
        // 2.方法无论大小写，通过反射获得真实方法名
        $dispatch[0] = ucfirst($dispatch[0]);
        $action = $dispatch[1];
        // 控制器类需要组装命名空间
        $controller = '\\' . Config::get('app_namespace') . '\\controller\\' . $dispatch[0];
        // 反射获取真实方法名
        try {
//            new \ReflectionClass($controller);
            $reflection = new \ReflectionMethod($controller, $action);
        } catch (\ReflectionException $e) {
            throw new AppException(502, '无法加载控制器或方法:' . $controller . $action);
        }
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * 获取/设置控制器
     * @param string $controller
     * @return null|string
     */
    public function controller(string $controller = null)
    {
        if ($controller) {
            $this->controller = $controller;
        }
        return $this->controller;
    }

    /**
     * 获取/设置动作方法
     * @param string $action
     * @return null|string
     */
    public function action(string $action = null)
    {
        if ($action) {
            $this->action = $action;
        }
        return $this->action;
    }

    /**
     * 获取/设置请求方法
     * @param string $method
     * @return string
     */
    public function method(string $method = null)
    {
        if ($method) {
            $this->method = $method;
        }
        return $this->method;
    }
}
