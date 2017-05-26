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
     * 运行应用
     * @static
     * @access public
     */
    public static function run()
    {
        try {
            // 请求类可以告知app应该实例化何种方法
            $controller = Request::instance()->controller();
            $action = Request::instance()->action();
            $class = new $controller();
            $class->$action();
        } catch (\Exception $e) {
            // 处理框架所有的异常
            var_dump($e->getMessage());
        }
    }
}
