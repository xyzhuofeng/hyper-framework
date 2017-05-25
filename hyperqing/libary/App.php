<?php

namespace hyper;

use app\controller\Index;

/**
 * 框架核心App类
 * 负责管理框架生命周期
 * @package hyper
 */
class App
{
    /**
     * 框架运行
     * @static
     * @access public
     */
    public static function run()
    {
        // 有PATH_INFO则解析路由
        if (isset($_SERVER['PATH_INFO'])) {
            // 去除左边多余斜杠
            $path_info = $_SERVER['PATH_INFO'];
            $path_info = ltrim($path_info, '/');
            $dispatch = explode('/', $path_info);
            // [0]为控制器类名,[1]为实例方法
            // 大小写规则:1.控制器类名首字母大写
            // 2.方法无论大小写，通过反射获得真实方法名
            $dispatch[0] = ucfirst($dispatch[0]);
            $action = $dispatch[1];
            // 控制器类需要组装命名空间
            $controller = '\\' . Config::get('app_namespace') . '\\controller\\' . $dispatch[0];
            // 反射获取真实方法名
            $reflection = new \ReflectionMethod($controller, $action);
            Request::instance()->controller($controller);
            Request::instance()->action($action);
            // 实例化控制器类
            $class = new $controller;
            // 调用方法
            $class->$action();
        } else {
            // 直接访问index.php的情况
            // 默认实例化Index\index()
            Request::instance()->controller('Index');
            Request::instance()->action('index');
            $class = new Index();
            $class->index();
        }
    }
}
