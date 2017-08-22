<?php

namespace hyper;

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
            // 获取请求类实例
            $request = Request::instance();
            // 请求类可以告知app应该实例化何种方法
            $controller = $request->controller();
            $action = $request->action();
            $class = new $controller();
            $class->$action();
        } catch (\Exception $e) {
            // 处理框架运行过程中所有的异常
            var_dump($e->getMessage());
        }
    }
}
